<?php

namespace Cpkm\ErpStock\Service\Sales;

use App\Models\SalesQuoteOrder;
use App\Models\SalesQuoteOrderItem;
use App\Models\Staff;
use Illuminate\Support\Arr;
use App\Exceptions\ErrorException;
use DataTables;
use App\Service\ProductService;
use App\Models\SystemSetting;

/**
 * Class SoldReturnOrderService.
 */
class SoldReturnOrderService extends OrderItemService
{
    /** 
     * @access protected
     * @var SalesSoldReturnOrderRepository
     * @version 1.0
     * @author Henry
    **/
    protected $SalesSoldReturnOrderRepository;
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
    public function __construct(Staff $Staff, SystemSetting $SystemSetting, public SalesQuoteOrder $SalesQuoteOrder, SalesQuoteOrderItem $SalesQuoteOrderItem) {
        $this->SalesSoldReturnOrderRepository      =   app(config('erp-stock.sales_sold_return_orders.model'));
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
        $where = Arr::only($data,["name","status", 'customers_id', 'date', 'sales_sold_order_statuses_id']);
        return DataTables::of($this->SalesSoldReturnOrderRepository->listQuery($where))->make();
    }

    public function getSalesSoldReturnOrder($id) {
        return $this->SalesSoldReturnOrderRepository->getDetail($id);
    }

    /**
     * 產生單據號
     *
     * @return void
     */

    public function makeNo($date) {
        $no = (new \Carbon\Carbon($date))->format('Ymd');
        $maxNo = SalesSoldReturnOrder::where('no', 'like', $no . "%")->max('no');
    
        if ($maxNo) {
            $maxSequence = intval(substr($maxNo, -4));
            $newSequence = $maxSequence + 1;
        } else {
            $newSequence = 1;
        }
    
        return $no . str_pad($newSequence, 4, "0", STR_PAD_LEFT);
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
            $createData =  Arr::only($data, $this->SalesSoldReturnOrderRepository->getDetailFields());
            $createData['no']   =   $this->makeNo($createData['date']);
            $createData['make_id']  =   auth()->user()->staff?->id;
            $createData['departments_id']   =   empty($data['customer_staff_id']) ? NULL : $this->getDepartmentId($data['customer_staff_id']);
            $model     =   $this->SalesSoldReturnOrderRepository->create($createData);
            if(!$model){
                throw new ErrorException(__('backend.errors.insertFail'), 500);
            }
            $this->setItems($model, $data);
            $sales_sold_order = $model->sourceable;
            if($sales_sold_order) {
                $finish = $this->checkPurchaseOrderFinish($sales_sold_order);
                if($finish) {
                    $sales_sold_order->update(['sales_sold_order_statuses_id' => 2]);
                }
            }
            
            return $model;
        });
    }

    public function checkPurchaseOrderFinish($sales_sold_order) {
        return $sales_sold_order->items->filter(function($item) {
            return $item->count == $item->sales_sold_return_order_items->sum('count');
        })->count() == $sales_sold_order->items->count();
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
            $updateData = Arr::only($data, $this->SalesSoldReturnOrderRepository->getDetailFields());
            $updataData['departments_id']   =   empty($data['customer_staff_id']) ? NULL : $this->getDepartmentId($data['customer_staff_id']);
            $model =  $this->getSalesSoldReturnOrder($id);
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
        $model =  $this->getSalesSoldReturnOrder($id);
        $model->delete();
        if(!$model){
            throw new ErrorException(__('backend.errors.deleteFail'), 500);
        }
        $model->items->each(function($item) {
            $item->delete();
        });
        return $model;
    }
    
    /**
     * 資料處理
     *
     * @param  mixed $data
     * @return void
     */
    public function dataHandle($data) {
        if(!empty($data['customer_contacts_id']) && !empty(\App\Models\CustomerContact::find($data['customer_contacts_id']))) {
            $customer_contact = \App\Models\CustomerContact::find($data['customer_contacts_id']);
            $data['customer_address']   =   $customer_contact->address;
            $data['customer_phone']     =   $customer_contact->mobile;
        }else{
            $data['customer_address']   =   NULL;
            $data['customer_phone']     =   NULL;
        }        
        $data['departments_id']   =   empty($data['customer_staff_id']) ? NULL : $this->getDepartmentId($data['customer_staff_id']);
        if(isset($data['file']) && $data['file'] && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
            $data['file'] = $data['file']->storeAs('sales_sold_return_order', date('YmdHis')."-".$data['file']->getClientOriginalName() , 'public');
        }
        return $data;
    }

    public function setItems($model, $data) {
        $ProductService = app(ProductService::class);
        $key = 'items';
        $all_data = $model->{$key}->pluck('id')->toArray();
        
        if($data[$key]??false) {
            foreach ($data[$key] as $sort => $item) {
                if(isset($item['file']) && $item['file'] && $item['file'] instanceof \Illuminate\Http\UploadedFile) {
                    $item['file'] = $item['file']->storeAs('sales_sold_return_order_item', date('YmdHis')."-".$item['file']->getClientOriginalName() , 'public');
                }
                
                if(!$item['sales_sold_order_items_id']) {
                    $product = $ProductService->getProduct($item['products_id']);
                    $item['name']       = $product->name;
                    $item['standard']   = $product->product_standard;
                    $item['unit']       = $product->unit;
                    $item['transfer_unit']  =   $product->transfer_unit;
                    $item['transfer_count']  =   $product->transfer_count;
                    $purchase_order_item = \App\Models\SalesPurchaseOrderItem::create($item);
                    if(!$purchase_order_item) {
                        throw new ErrorException(__('backend.errors.insertFail'), 500);
                    }
                    $item['sales_purchase_order_items_id'] = $purchase_order_item->id;
                    $sold_order_item = \App\Models\SalesSoldOrderItem::create($item);
                    if(!$sold_order_item) {
                        throw new ErrorException(__('backend.errors.insertFail'), 500);
                    }
                    $item['sales_sold_order_items_id'] = $sold_order_item->id;
                }

                $search = null;
                if(isset($item['id']) && !empty($item['id'])) {
                    $search = $model->{$key}()->where(['id' => $item['id']])->first();
                }

                if ($search) {
                    $item['sales_purchase_order_items_id'] = $search->sales_sold_order_items_id;
                    $search->update($item);
                    if (!empty($search->sales_sold_order_items_id)) {
                        \App\Models\SalesSoldOrderItem::where('id', $search->sales_sold_order_items_id)
                            ->update([
                                'count' => $item['count'],
                                'amount' => $item['amount'],
                                'tax' => $item['tax'],
                                'total_amount' => $item['total_amount'],
                                'remark' => $item['remark'],
                                'main_amount' => $item['main_amount'],
                                'main_tax' => $item['main_tax'],
                                'main_total_amount' => $item['main_total_amount'],
                            ]);
                    }

                    $sales_purchase_order_item = \App\Models\SalesSoldOrderItem::where('id', $search->sales_sold_order_items_id)->first();
                    if (!empty($sales_purchase_order_item->sales_purchase_order_items_id)) {
                        \App\Models\SalesPurchaseOrderItem::where('id', $sales_purchase_order_item->sales_purchase_order_items_id)
                            ->update([
                                'unit_amount' => $item['unit_amount'],
                                'count' => $item['count'],
                                'amount' => $item['amount'],
                                'tax' => $item['tax'],
                                'total_amount' => $item['total_amount'],
                                'delivery_date' => $item['delivery_date'],
                                'description' => $item['description'],
                                'remark' => $item['remark'],
                                'main_amount' => $item['main_amount'],
                                'main_tax' => $item['main_tax'],
                                'main_total_amount' => $item['main_total_amount'],
                            ]);
                    }

                    unset($all_data[array_search($item['id'], $all_data)]);
                } else {
                    $newItem = $model->{$key}()->create($item);
                    $item['id'] = $newItem->id;
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
        $model =  $this->getSalesSoldReturnOrder($id);
        if($model->sales_sold_return_order_statuses_id != 1) {
            $updateData['sales_sold_return_order_statuses_id'] = 1;
        }else{
            $updateData['sales_sold_return_order_statuses_id'] = 2;
        }
        $result = $model->update($updateData);
        if(!$result){
            throw new ErrorException(__('backend.errors.updateFail'), 500);
        }
        return $model;
    }

}