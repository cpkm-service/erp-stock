<?php

namespace Cpkm\ErpStock\Service\Restock;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
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
 * Class PurchaseOrderService.
 */
class PurchaseOrderService extends OrderItemService
{
    use \App\Traits\RateTrait;
    /** 
     * @access protected
     * @var PurchaseOrderRepository
     * @version 1.0
     * @author Henry
    **/
    protected $PurchaseOrderRepository;
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
    public function __construct(PurchaseOrder $PurchaseOrder, Staff $Staff, SystemSetting $SystemSetting, PurchaseOrderItem $PurchaseOrderItem) {
        $this->PurchaseOrderRepository      =   $PurchaseOrder;
        $this->StaffRepository      =   $Staff;
        $this->SystemSettingRepository = $SystemSetting;
        $this->PurchaseOrderItemRepository = $PurchaseOrderItem;
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
        return DataTables::of($this->PurchaseOrderRepository->listQuery($where))->make();
    }

    public function getPurchaseOrder($id) {
        return $this->PurchaseOrderRepository->getDetail($id);
    }

    /**
     * 產生單據號
     *
     * @return void
     */
    public function makeNo($date) {
        $no = (new \Carbon\Carbon($date))->format('Ymd');
        $count = PurchaseOrder::where('no', 'like', $no."%")->count() + 1;
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
            $data = $this->calculateAmount($this->dataHandle($data));
            $createData =  Arr::only($data, $this->PurchaseOrderRepository->getDetailFields());
            $createData['no']   =   $this->makeNo($createData['date']);
            $model     =   $this->PurchaseOrderRepository->create($createData);
            if(!$model){
                throw new ErrorException(__('backend.errors.insertFail'), 500);
            }
            $this->setItems($model, $data);
            $source = $model->sourceable;
            if($source) {
                $result = $source->update(['inquiry_order_statuses_id' => 2]);
                if(!$result){
                    throw new ErrorException(__('backend.errors.insertFail'), 500);
                }
                if($source::class == \App\Models\InquiryOrder::class) {
                    $source = $source->sourceable;
                    if($source) {
                        $result = $source->update(['subscription_order_statuses_id' => 2]);
                        if(!$result){
                            throw new ErrorException(__('backend.errors.insertFail'), 500);
                        }
                    }
                    
                }
            }
            return $model;
        });
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
            $data = $this->calculateAmount($this->dataHandle($data));
            $updateData = Arr::only($data, $this->PurchaseOrderRepository->getDetailFields());
            $model =  $this->getPurchaseOrder($id);
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
        $model =  $this->getPurchaseOrder($id);
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
            $data['file'] = $data['file']->storeAs('purchase_order', date('YmdHis')."-".$data['file']->getClientOriginalName() , 'public');
        }
        $data['make_id'] = auth()->user()->staff?->id;
        return $data;
    }

    public function select($where = []) {
        return $this->PurchaseOrderRepository->select(['id', 'name', 'no'])->where($where)->get()->map(function($item) {
            return [
                'value' =>  $item->id,
                'name'  =>  "{$item->name} ({$item->no})"
            ];
        })->toArray();
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
                    $item['file'] = $item['file']->storeAs('restock_order_items', date('YmdHis')."-".$item['file']->getClientOriginalName() , 'public');
                }

                if(!$item['order_items_id']) {
                    $product = $ProductService->getProduct($item['products_id']);
                    $item['name']       = $product->product_name;
                    $item['standard']   = $product->product_standard;
                    $item['size']       = $product->size;
                    $order_item = \App\Models\OrderItem::create($item);
                    $item['order_items_id'] = $order_item->id;
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

}