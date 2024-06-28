<?php

namespace Cpkm\ErpStock\Service\Sales;

use App\Models\Staff;
use Illuminate\Support\Arr;
use App\Exceptions\ErrorException;
use DataTables;
use App\Service\ProductService;
use App\Models\ReviewSetting;
use App\Models\SystemSetting;

/**
 * Class QuoteOrderService.
 */
class QuoteOrderService extends OrderItemService
{
    /** 
     * @access protected
     * @var SalesQuoteOrderRepository
     * @version 1.0
     * @author Henry
    **/
    protected $SalesQuoteOrderRepository;
    /** 
     * @access protected
     * @var SystemSettingRepository
     * @version 1.0
     * @author Henry
    **/
    protected $SystemSettingRepository;

    protected $items_folder = 'sales_quote_order_items';
    
    /** 
     * 建構子
     * @version 1.0
     * @author Henry
    **/
    public function __construct(Staff $Staff, SystemSetting $SystemSetting) {
        $this->SalesQuoteOrderRepository      =   app(config('erp-stock.sales_quote_orders.model'));
        $this->StaffRepository      =   $Staff;
        $this->SystemSettingRepository = $SystemSetting;
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
        return DataTables::of($this->SalesQuoteOrderRepository->listQuery($where))->make();
    }

    public function getSalesQuoteOrder($id) {
        return $this->SalesQuoteOrderRepository->getDetail($id);
    }

    /**
     * 產生單據號
     *
     * @return void
     */
    public function makeNo($date) {
        $no = (new \Carbon\Carbon($date))->format('Ymd');
        $count = $this->SalesQuoteOrderRepository->where('no', 'like', $no."%")->count() + 1;
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
            $createData =  Arr::only($data, $this->SalesQuoteOrderRepository->getDetailFields());
            $createData['no']   =   $this->makeNo($createData['date']);
            $model     =   $this->SalesQuoteOrderRepository->create($createData);
            if(!$model){
                throw new ErrorException(__('backend.errors.insertFail'), 500);
            }
            $this->setItems($model, $data);
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
            $updateData = Arr::only($data, $this->SalesQuoteOrderRepository->getDetailFields());
            $model =  $this->getSalesQuoteOrder($id);
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
        $model =  $this->getSalesQuoteOrder($id);
        if($model->close) {
            throw new ErrorException('該報價憑單已結案', 500, []);
        }
        $model->delete();
        if(!$model){
            throw new ErrorException(__('backend.errors.deleteFail'), 500, []);
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
            $data['file'] = $data['file']->storeAs('sales_quote_order', date('YmdHis')."-".$data['file']->getClientOriginalName() , 'public');
        }
        return $data;
    }

    public function select($where = []) {
        return $this->SalesQuoteOrderRepository->select(['id', 'no', 'project_managements_id'])->with(['project'])->where($where)->get()->map(function($item) {
            return [
                'value' =>  $item->id,
                'name'  =>  "{$item->project?->name} ({$item->no})"
            ];
        })->toArray();
    }

}