<?php

namespace Cpkm\ErpStock\Service\Sales;

use App\Models\SalesOrder;
use App\Models\SalesQuoteOrder;
use App\Models\SalesQuoteOrderItem;
use App\Models\Staff;
use Illuminate\Support\Arr;
use App\Exceptions\ErrorException;
use DataTables;
use App\Models\SystemSetting;
use App\Models\SalesOrderItem;
use App\Service\ProductService;

/**
 * Class OrderService.
 */
class OrderService extends OrderItemService
{
    /** 
     * @access protected
     * @var SalesOrderRepository
     * @version 1.0
     * @author Henry
    **/
    protected $SalesOrderRepository;
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
    
    protected $items_folder = 'sales_order_items';

    protected $stock_type = 'reduce';

    protected $stock_expected = true;
    
    /** 
     * 建構子
     * @version 1.0
     * @author Henry
    **/
    public function __construct(Staff $Staff, SystemSetting $SystemSetting, public SalesQuoteOrder $SalesQuoteOrder, SalesQuoteOrderItem $SalesQuoteOrderItem) {
        $this->SalesOrderRepository      =   app(config('erp-stock.sales_orders.model'));
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
        return DataTables::of($this->SalesOrderRepository->listQuery($where))->make();
    }

    public function getSalesOrder($id) {
        return $this->SalesOrderRepository->getDetail($id);
    }

    /**
     * 產生單據號
     *
     * @return void
     */
    public function makeNo($date) {
        $no = (new \Carbon\Carbon($date))->format('Ymd');
        $count = SalesOrder::where('no', 'like', $no."%")->count() + 1;
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
            $createData =  Arr::only($data, $this->SalesOrderRepository->getDetailFields());
            $createData['no']   =   $this->makeNo($createData['date']);
            $createData['make_id'] = auth()->user()->staff?->id;
            $model     =   $this->SalesOrderRepository->create($createData);
            if(!$model){
                throw new ErrorException(__('backend.errors.insertFail'), 500);
            }
            $this->setItems($model, $data);
            $quote_order = $model->sourceable;
            if($quote_order) {
                $quote_order->update([
                    'sales_quote_order_statuses_id'    =>  2,
                ]);
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
            $updateData = Arr::only($data, $this->SalesOrderRepository->getDetailFields());
            $model =  $this->getSalesOrder($id);
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
        return \DB::transaction(function() use ($id){
            $model =  $this->getSalesOrder($id);
            $model->sourceable->update([
                'sales_quote_order_statuses_id'    =>  1,
            ]);
            $model->items->each(function($item) {
                $item->delete();
                $product_stock_list = $item->product_stock_list;
                if($product_stock_list) {
                    $product_stock = $product_stock_list->product_stock;
                    if($product_stock) {
                        $product_stock->update([
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
        });
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

    public function select($where = []) {
        return $this->SalesOrderRepository->select(['id', 'project_managements_id', 'no'])->with('project')->where($where)->get()->map(function($item) {
            return [
                'value' =>  $item->id,
                'name'  =>  "{$item->project?->name} ({$item->no})"
            ];
        })->toArray();
    }

}