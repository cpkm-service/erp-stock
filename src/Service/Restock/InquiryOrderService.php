<?php

namespace Cpkm\ErpStock\Service\Restock;

use App\Models\InquiryOrder;
use App\Models\InquiryOrderItem;
use App\Models\Staff;
use Illuminate\Support\Arr;
use App\Exceptions\ErrorException;
use DataTables;
use App\Service\ProductService;
use App\Models\ReviewSetting;
use App\Models\SystemSetting;
use App\Libraries\Rate;
use App\Models\Currency;

/**
 * Class InquiryOrderService.
 */
class InquiryOrderService extends OrderItemService
{
    use \App\Traits\RateTrait;
    /** 
     * @access protected
     * @var InquiryOrderRepository
     * @version 1.0
     * @author Henry
    **/
    protected $InquiryOrderRepository;
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
    public function __construct(InquiryOrder $InquiryOrder, Staff $Staff, SystemSetting $SystemSetting, InquiryOrderItem $InquiryOrderItem) {
        $this->InquiryOrderRepository      =   $InquiryOrder;
        $this->StaffRepository      =   $Staff;
        $this->SystemSettingRepository = $SystemSetting;
        $this->InquiryOrderItemRepository = $InquiryOrderItem;
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
        return DataTables::of($this->InquiryOrderRepository->listQuery($where))->make();
    }

    public function getInquiryOrder($id) {
        return $this->InquiryOrderRepository->getDetail($id);
    }

    /**
     * 產生單據號
     *
     * @return void
     */
    public function makeNo($date) {
        $no = (new \Carbon\Carbon($date))->format('Ymd');
        $count = InquiryOrder::where('no', 'like', $no."%")->count() + 1;
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
            $createData =  Arr::only($data, $this->InquiryOrderRepository->getDetailFields());
            $createData['no']   =   $this->makeNo($createData['date']);
            
            $model     =   $this->InquiryOrderRepository->create($createData);
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
            $updateData = Arr::only($data, $this->InquiryOrderRepository->getDetailFields());
            $model =  $this->getInquiryOrder($id);
            if($model->close) {
                throw new ErrorException(__('backend.errors.updateFail'), 500);
            }
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
        $model =  $this->getInquiryOrder($id);
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
        if($data['factory_contact_id']??false) {
            $customer_contact = \App\Models\CustomerContact::find($data['factory_contact_id']);
            $data['factory_address']   =   $customer_contact->address;
            $data['factory_phone']     =   $customer_contact->phone;
        }
        if($data['staff_id']??false) {
            $data['departments_id']   =   $this->getDepartmentId($data['staff_id']);
        }
        if(isset($data['file']) && $data['file'] && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
            $data['file'] = $data['file']->storeAs('inquiry_order', date('YmdHis')."-".$data['file']->getClientOriginalName() , 'public');
        }
        $data['make_id'] = auth()->user()->staff?->id;
        return $data;
    }

    public function select($where = []) {
        return $this->InquiryOrderRepository->select(['id', 'name', 'no'])->where($where)->get()->map(function($item) {
            return [
                'value' =>  $item->id,
                'name'  =>  "{$item->name} ({$item->no})"
            ];
        })->toArray();
    }

    public function close($id) {
        $model =  $this->getInquiryOrder($id);
        if($model->inquiry_order_statuses_id != 1) {
            return $model;
        }
        $updateData['inquiry_order_statuses_id'] = 3;
        if($model->purchase_order) {
            $updateData['inquiry_order_statuses_id'] = 2;
        }
        $result = $model->update($updateData);
        if(!$result){
            throw new ErrorException(__('backend.errors.updateFail'), 500);
        }
        return $model;
    }

}