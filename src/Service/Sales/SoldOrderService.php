<?php

namespace App\Service\Sales;

use App\Models\SalesSoldOrder;
use App\Models\SalesQuoteOrder;
use App\Models\SalesQuoteOrderItem;
use App\Models\Staff;
use Illuminate\Support\Arr;
use App\Exceptions\ErrorException;
use DataTables;
use App\Service\ProductService;
use App\Models\SystemSetting;

/**
 * Class SoldOrderService.
 */
class SoldOrderService extends QuoteOrderItemService
{
    /** 
     * @access protected
     * @var SalesSoldOrderRepository
     * @version 1.0
     * @author Henry
    **/
    protected $SalesSoldOrderRepository;
    /** 
     * @access protected
     * @var SalesQuoteOrderRepository
     * @version 1.0
     * @author Henry
    **/
    protected $SalesQuoteOrderRepository;
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
    public function __construct(SalesSoldOrder $SalesSoldOrder, Staff $Staff, SystemSetting $SystemSetting, public SalesQuoteOrder $SalesQuoteOrder, SalesQuoteOrderItem $SalesQuoteOrderItem) {
        $this->SalesSoldOrderRepository      =   $SalesSoldOrder;
        $this->SalesQuoteOrderRepository      =   $SalesQuoteOrder;
        $this->StaffRepository      =   $Staff;
        $this->SystemSettingRepository = $SystemSetting;
        $this->SalesQuoteOrderItemRepository = $SalesQuoteOrderItem;
    }

    /**
     * 報價單列表
     * @param array $data
     * @version 1.0
     * @author Henry
     * @return \DataTables
     */
    public function index($data) {
        $where = Arr::only($data,["name","status"]);
        return DataTables::of($this->SalesSoldOrderRepository->listQuery($where))->make();
    }

    public function getSalesSoldOrder($id) {
        return $this->SalesSoldOrderRepository->getDetail($id);
    }

    /**
     * 產生單據號
     *
     * @return void
     */
    public function makeNo($date) {
        $no = (new \Carbon\Carbon($date))->format('Ymd');
        $count = SalesSoldOrder::where('no', 'like', $no."%")->count() + 1;
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
            $createData =  Arr::only($data, $this->SalesSoldOrderRepository->getDetailFields());
            $createData['no']   =   $this->makeNo($createData['date']);
            $model     =   $this->SalesSoldOrderRepository->create($createData);
            if(!$model){
                throw new ErrorException(__('backend.errors.insertFail'), 500);
            }
            $this->setItems($model, $data);
            $sales_order = $model->sourceable;
            if($sales_order) {
                $finish = $this->checkPurchaseOrderFinish($sales_order);
                if($finish) {
                    $sales_order->update(['sales_order_statuses_id' => 2]);
                }
            }
            
            return $model;
        });
    }

    public function checkPurchaseOrderFinish($sales_order) {
        return $sales_order->items->filter(function($item) {
            return $item->count == $item->sales_sold_order_items->sum('count');
        })->count() == $sales_order->items->count();
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
            $updateData = Arr::only($data, $this->SalesSoldOrderRepository->getDetailFields());
            $model =  $this->getSalesSoldOrder($id);
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
        $model =  $this->getSalesSoldOrder($id);
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
        $customer_contact = \App\Models\CustomerContact::find($data['customer_contacts_id']);
        $data['customer_address']   =   $customer_contact->address;
        $data['customer_phone']     =   $customer_contact->phone;
        $data['departments_id']   =   $this->getDepartmentId($data['staff_id']);
        if(isset($data['file']) && $data['file'] && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
            $data['file'] = $data['file']->storeAs('sales_order', date('YmdHis')."-".$data['file']->getClientOriginalName() , 'public');
        }
        return $data;
    }

    public function setItems($model, $data) {
        $ProductService = app(ProductService::class);
        $key = 'items';
        $all_data = $model->{$key}->pluck('id')->toArray();
        if($data[$key]??false) {
            foreach ($data[$key] as $sort => $item) {
                if(!$item['sales_purchase_order_items_id']) {
                    $product = $ProductService->getProduct($item['products_id']);
                    $item['name']       = $product->product_name;
                    $item['standard']   = $product->product_standard;
                    $item['size']       = $product->size;
                    $order_item = \App\Models\SalesOrderItem::create($item);
                    if(!$order_item) {
                        throw new ErrorException(__('backend.errors.insertFail'), 500);
                    }
                    $item['sales_order_items_id'] = $order_item->id;
                    $purchase_order_item = \App\Models\SalesPurchaseOrderItem::create($item);
                    if(!$purchase_order_item) {
                        throw new ErrorException(__('backend.errors.insertFail'), 500);
                    }
                    $item['sales_purchase_order_items_id'] = $purchase_order_item->id;
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

    public function close($id) {
        $model =  $this->getSalesSoldOrder($id);
        if($model->sales_sold_order_statuses_id != 1) {
            return $model;
        }
        $updateData['sales_sold_order_statuses_id'] = 2;
        $result = $model->update($updateData);
        if(!$result){
            throw new ErrorException(__('backend.errors.updateFail'), 500);
        }
        return $model;
    }

}