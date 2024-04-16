<?php

namespace Cpkm\ErpStock\Service\Restock;

use Cpkm\ErpStock\Models\Restock\PrePurchaseOrder;
use Illuminate\Support\Arr;
use App\Exceptions\ErrorException;
use DataTables;
use Cpkm\Admin\Models\SystemSetting;

/**
 * Class PrePurchaseOrderService.
 */
class PrePurchaseOrderService extends OrderItemService
{
    /** 
     * @access protected
     * @var PrePurchaseOrderRepository
     * @version 1.0
     * @author Henry
    **/
    protected $PrePurchaseOrderRepository;

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
    public function __construct(PrePurchaseOrder $PrePurchaseOrder, SystemSetting $SystemSetting) {
        $this->PrePurchaseOrderRepository   =   app(config('erp-stock.pre_purchase_order.model'));
        $this->StaffService = app(config('erp-stock.pre_purchase_order.staff'));
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
        $where = Arr::only($data,["name","status", 'subscription_order_types_id', 'date', 'pre_purchase_order_statuses_id']);
        return DataTables::of($this->PrePurchaseOrderRepository->listQuery($where))->make();
    }

    public function getPrePurchaseOrder($id) {
        return $this->PrePurchaseOrderRepository->getDetail($id);
    }

    /**
     * 產生單據號
     *
     * @return void
     */
    public function makeNo($date) {
        $no = (new \Carbon\Carbon($date))->format('Ymd');
        $count = PrePurchaseOrder::where('no', 'like', $no."%")->count() + 1;
        return $no.str_pad($count, 4, "0", STR_PAD_LEFT);
    }

    public function getDepartmentId($staff_id) {
        $staff = $this->StaffService->getStaff($staff_id);
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
            $createData =  Arr::only($data, $this->PrePurchaseOrderRepository->getDetailFields());
            $createData['no']   =   $this->makeNo($createData['date']);
            $createData['make_id']  =   auth()->user()->staff?->id;
            $model     =   $this->PrePurchaseOrderRepository->create($createData);
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
            $data = $this->dataHandle($data);
            $updateData = Arr::only($data, $this->PrePurchaseOrderRepository->getDetailFields());
            $model =  $this->getPrePurchaseOrder($id);
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
        $model =  $this->getPrePurchaseOrder($id);
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
        if($data['staff_id']??false) {
            $data['departments_id']   =   $this->getDepartmentId($data['staff_id']);
        }
        if(isset($data['file']) && $data['file'] && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
            $data['file'] = $data['file']->storeAs('pre_purchase_order', date('YmdHis')."-".$data['file']->getClientOriginalName() , 'public');
        }
        return $data;
    }

    public function select($where = []) {
        return $this->PrePurchaseOrderRepository->select(['id', 'name', 'no'])->where($where)->get()->map(function($item) {
            return [
                'value' =>  $item->id,
                'name'  =>  "{$item->name} ({$item->no})"
            ];
        })->toArray();
    }

    public function close($id) {
        $model =  $this->getPrePurchaseOrder($id);
        if($model->pre_purchase_order_statuses_id != 1) {
            return $model;
        }
        $updateData['pre_purchase_order_statuses_id'] = 3;
        if($model->inquiry_order || $model->purchase_order) {
            $updateData['pre_purchase_order_statuses_id'] = 2;
        }
        $result = $model->update($updateData);
        if(!$result){
            throw new ErrorException(__('backend.errors.updateFail'), 500);
        }
        return $model;
    }

}