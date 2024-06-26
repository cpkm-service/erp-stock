<?php

namespace Cpkm\ErpStock\Service\Sales;

use Illuminate\Support\Arr;
use App\Exceptions\ErrorException;
use DataTables;

/**
 * Class SoldOrderService.
 */
class SoldOrderService extends OrderItemService
{
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
    
    protected $items_folder = 'sales_sold_order_items';

    protected $stock_type = 'reduce';

    protected $stock_expected = false;
    /** 
     * 建構子
     * @version 1.0
     * @author Henry
    **/
    public function __construct() {
        $this->SalesSoldOrderRepository      =   app(config('erp-stock.sales_sold_orders.model'));
        $this->StaffRepository      =   app(config('erp-stock.sales_sold_orders.models.staff'));
        $this->SystemSettingRepository = app(\App\Models\SystemSetting::class);
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
        $count = $this->SalesSoldOrderRepository->where('no', 'like', $no."%")->count() + 1;
        return $no.str_pad($count, 4, "0", STR_PAD_LEFT);
    }

    public function getDepartmentId($staff_id) {
        $staff = $this->StaffRepository->where('id', $staff_id)->first();
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
            $createData['make_id'] = auth()->user()->staff?->id;
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
        $model->sourceable->update([
            'sales_order_statuses_id'    =>  1,
        ]);
        $model->items->each(function($item) {
            $item->delete();
            $product_stock_list = $item->product_stock_list;
            if($product_stock_list) {
                $product_stock = $product_stock_list->product_stock;
                if($product_stock) {
                    $product_stock->update([
                        'stock' => $product_stock->stock - $product_stock_list->count,
                        'expected_stock' => $product_stock->expected_stock - $product_stock_list->expected_count,
                    ]);
                }
                $product_stock_list->delete();
            }
        });
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
            $data['file'] = $data['file']->storeAs('sales_sold_order', date('YmdHis')."-".$data['file']->getClientOriginalName() , 'public');
        }
        return $data;
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

    public function select($where = []) {
        return $this->SalesSoldOrderRepository->select(['id', 'project_managements_id', 'no'])->with('project')->where($where)->get()->map(function($item) {
            return [
                'value' =>  $item->id,
                'name'  =>  "{$item->project?->name} ({$item->no})"
            ];
        })->toArray();
    }

}