<?php

namespace App\Service\Sales;

use App\Models\SalesStandardType;
use App\Models\SalesStandardConfig;
use Illuminate\Support\Arr;
use App\Exceptions\ErrorException;
use DataTables;

/**
 * Class StandardService.
 */
class StandardService
{
    /** 
     * @access protected
     * @var SalesStandardTypeRepository
     * @version 1.0
     * @author Henry
    **/
    protected $SalesStandardTypeRepository;

    /** 
     * @access protected
     * @var SalesStandardConfigRepository
     * @version 1.0
     * @author Henry
    **/
    protected $SalesStandardConfigRepository;
    
    /** 
     * 建構子
     * @version 1.0
     * @author Henry
    **/
    public function __construct(SalesStandardType $SalesStandardType, SalesStandardConfig $SalesStandardConfig) {
        $this->SalesStandardTypeRepository      =   $SalesStandardType;
        $this->SalesStandardConfigRepository    =   $SalesStandardConfig;
    }
    
    /**
     * 取得訂購參數分類
     *
     * @return void
     */
    public function getStandardTypes() {
        return $this->SalesStandardTypeRepository->all();
    }
    
    /**
     * 取得訂購參數資料
     *
     * @param  mixed $id
     * @return void
     */
    public function getStandardConfigDetail($id) {
        return $this->SalesStandardConfigRepository->find($id);
    }

    public function getConfigSettings() {
        return $this->SalesStandardTypeRepository->with(['config'=>function($query) {
            return $query->with(['items' => function($query) {
                return $query->select(['id', 'name', 'code', 'sales_standard_configs_id']);
            }]);
        }])->get()->keyBy('id');
    }

    /**
     * 設定訂購參數資料選項
     * @param object $model
     * @param array $data
     * @return object
     * @version 1.0
     * @author Henry
     */
    public function setItems($model, $data) {
        $key = 'items';
        $all_data = $model->{$key}->pluck('id')->toArray();
        if($data[$key]??false) {
            foreach ($data[$key] as $sort => $item) {
                // $item['sort'] = $sort;
                if(isset($item['id'])) {
                    $search = $model->{$key}()->where([
                        'id' => $item['id']
                    ])->first();
                }else{
                    $search = false;
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
            $updateData = Arr::only($data, $this->SalesStandardConfigRepository->getDetailFields());
            if(!isset($updateData['status'])) {
                $updateData['status'] = 0;
                $updateData['stop_date']    =   date("Y-m-d");
            }else{
                $updateData['stop_date']    =   NULL;
            }
            $model =  $this->getStandardConfigDetail($id);
            $result = $model->update($updateData);
            if(!$result){
                throw new ErrorException(__('backend.errors.updateFail'), 500);
            }
            $this->setItems($model, $data);
            return $model;
        });
    }

}