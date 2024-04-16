<?php

namespace Cpkm\ErpStock\Service\Restock;

use App\Models\RestockReturnOrder;
use App\Models\RestockReturnOrderItem;
use App\Models\Staff;
use Illuminate\Support\Arr;
use App\Exceptions\ErrorException;
use DataTables;
use App\Service\ProductService;
use App\Models\ReviewSetting;
use App\Models\SystemSetting;
use App\Models\Currency;
use App\Libraries\Rate;

/**
 * Class RestockReturnOrderService.
 */
class RestockReturnOrderService extends OrderItemService
{
    
    use \App\Traits\RateTrait;

    /** 
     * @access protected
     * @var RestockReturnOrderRepository
     * @version 1.0
     * @author Henry
    **/
    protected $RestockReturnOrderRepository;
    /** 
     * @access protected
     * @var StaffRepository
     * @version 1.0
     * @author Henry
    **/
    protected $StaffRepository;
    /** 
     * @access protected
     * @var SystemSettingRepository
     * @version 1.0
     * @author Henry
    **/
    protected $SystemSettingRepository;
    
    /** 
     * 建構子
     * @version 1.0
     * @author Henry
    **/
    public function __construct(RestockReturnOrder $RestockReturnOrder, Staff $Staff, SystemSetting $SystemSetting, RestockReturnOrderItem $RestockReturnOrderItem) {
        $this->RestockReturnOrderRepository      =   $RestockReturnOrder;
        $this->StaffRepository      =   $Staff;
        $this->SystemSettingRepository = $SystemSetting;
        $this->RestockReturnOrderItemRepository = $RestockReturnOrderItem;
    }

    /**
     * 報價單列表
     * @param array $data
     * @version 1.0
     * @author Henry
     * @return \DataTables
     */
    public function index($data) {
        $where = Arr::only($data,["name","status", 'factory_id', 'date', 'inquiry_order_statuses_id']);
        return DataTables::of($this->RestockReturnOrderRepository->listQuery($where))->make();
    }

    public function getRestockReturnOrder($id) {
        return $this->RestockReturnOrderRepository->getDetail($id);
    }

    /**
     * 產生單據號
     *
     * @return void
     */
    public function makeNo($date) {
        $no = (new \Carbon\Carbon($date))->format('Ymd');
        $count = RestockReturnOrder::where('no', 'like', $no."%")->count() + 1;
        return $no.str_pad($count, 4, "0", STR_PAD_LEFT);
    }

    public function getDepartmentId($staff_id) {
        $staff = Staff::where('id', $staff_id)->first();
        return $staff->department_id;
    }

    /**
     * 建立報價單
     * @param array $data
     * @return object $model
     * @throws \App\Exceptions\Universal\ErrorException
     * @version 1.0
     * @author Henry
     */
    public function store(array $data) {
        return \DB::transaction(function() use ($data){
            $data = $this->dataHandle($data);
            $createData =  Arr::only($data, $this->RestockReturnOrderRepository->getDetailFields());
            $createData['no']   =   $this->makeNo($createData['date']);
            $model     =   $this->RestockReturnOrderRepository->create($createData);
            if(!$model){
                throw new ErrorException(__('backend.errors.insertFail'), 500);
            }
            $this->setItems($model, $data);
            $source = $model->sourceable;
            if($source && $source::class == \App\Models\AcceptanceOrder::class) {
                $result = $source->update(['acceptance_order_statuses_id' => 2]);
                if(!$result){
                    throw new ErrorException(__('backend.errors.insertFail'), 500);
                }
                $purchase_order = $source->sourceable->sourceable;
                $finish = $this->checkPurchaseOrderFinish($purchase_order);
                if($finish) {
                    $purchase_order->update(['purchase_order_statuses_id' => 2]);
                }
            }
            return $model;
        });
    }

    public function checkPurchaseOrderFinish($purchase_order) {
        return $purchase_order->items->filter(function($item) {
            return $item->count == $item->restock_order_items->sum('count');
        })->count() == $purchase_order->items->count();
    }

    /**
     * 更新訂購參數資料
     * @param array $updateData
     * @param string $id
     * @return object $model
     * @throws \App\Exceptions\Universal\ErrorException
     * @version 1.0
     * @author Henry
     */
    public function update(array $data, string $id) {
        return \DB::transaction(function() use ($data, $id){
            $data = $this->dataHandle($data);
            $updateData = Arr::only($data, $this->RestockReturnOrderRepository->getDetailFields());
            $model =  $this->getRestockReturnOrder($id);
            $result = $model->update($updateData);
            if(!$result){
                throw new ErrorException(__('backend.errors.updateFail'), 500);
            }
            $this->setItems($model, $data);
            return $model;
        });
    }

    /**
     * 刪除訂購參數資料
     * @param string $id
     * @return object $model
     * @throws \App\Exceptions\Universal\ErrorException
     * @version 1.0
     * @author Henry
     */
    public function delete(string $id) {
        $model =  $this->getRestockReturnOrder($id);
        $model->delete();
        if(!$model){
            throw new ErrorException(__('backend.errors.deleteFail'), 500);
        }
        return $model;
    }
    
    /**
     * 資料處理
     *
     * @param  mixed $data
     * @return void
     */
    public function dataHandle($data) {
        $customer_contact = \App\Models\CustomerContact::find($data['factory_contact_id']);
        $data['factory_address']   =   $customer_contact->address;
        $data['factory_phone']     =   $customer_contact->phone;
        $data['departments_id']   =   $this->getDepartmentId($data['staff_id']);
        if(isset($data['file']) && $data['file'] && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
            $data['file'] = $data['file']->storeAs('restock_return_orders', date('YmdHis')."-".$data['file']->getClientOriginalName() , 'public');
        }
        $data['make_id'] = auth()->user()->staff?->id;
        return $this->calculateAmount($data) ;
    }

    /**
     * 設定項目
     *
     * @param  mixed $model
     * @param  mixed $data
     * @return void
     */
    public function setItems($model, $data) {
        $ProductService = app(ProductService::class);
        $key = 'items';
        $all_data = $model->{$key}->pluck('id')->toArray();
        if($data[$key]??false) {
            foreach ($data[$key] as $sort => $item) {
                if(isset($item['file']) && $item['file'] && $item['file'] instanceof \Illuminate\Http\UploadedFile) {
                    $item['file'] = $item['file']->storeAs('restock_return_order_items', date('YmdHis')."-".$item['file']->getClientOriginalName() , 'public');
                }

                if(!$item['restock_order_items_id']) {
                    $product = $ProductService->getProduct($item['products_id']);
                    $item['name']       = $product->product_name;
                    $item['standard']   = $product->product_standard;
                    $item['size']       = $product->size;
                    $order_item = \App\Models\OrderItem::create($item);
                    if($order_item) {
                        $item['order_items_id'] = $order_item->id;
                        $purchase_order_item = \App\Models\PurchaseOrderItem::create($item);
                        if($purchase_order_item) {
                            $item['purchase_order_items_id'] = $purchase_order_item->id;
                            $restock_order_item = \App\Models\RestockOrderItem::create($item);
                            $item['restock_order_items_id'] = $restock_order_item->id;
                        }
                    }
                    
                }
                if(isset($item['id'])) {
                    $search = $model->{$key}()->where([
                        'id' => $item['id']
                    ])->first();
                }
                if($search??false) {
                    $search->update($item);
                    unset($all_data[array_search($item['id'],$all_data)]);
                }else{
                    $model->{$key}()->create($item);
                }
            }
        }
        foreach ($all_data as $id) {
            $model->{$key}()->where([
                'id' => $id,
            ])->delete();
        }
    }

    public function select() {
        return $this->RestockReturnOrderRepository->select(['id', 'name', 'no'])->get()->map(function($item) {
            return [
                'value' =>  $item->id,
                'name'  =>  "{$item->name} ({$item->no})"
            ];
        })->toArray();
    }

    public function close($id) {
        return \DB::transaction(function() use($id) {
            $model =  $this->getRestockReturnOrder($id);
            if($model->restock_order_statuses_id != 1) {
                return $model;
            }
            $updateData['restock_order_statuses_id'] = 2;
            $result = $model->update($updateData);
            if(!$result){
                throw new ErrorException(__('backend.errors.updateFail'), 500);
            }
            $service = app(\App\Service\ProductService::class);
            foreach ($model->items as $item) {
                $service->setProduct($item->order_item->product);
                $stock = $service->getStock();
                $stock->lists()->create([
                    'sourceable_type'   =>  $item::class,
                    'sourceable_id'    =>  $item->id,
                    'count' =>  $item->count,
                ]);
            }
            return $model;
        });
    }

}
