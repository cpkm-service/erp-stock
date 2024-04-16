<?php

namespace App\Service\Sales;

use App\Models\SalesOrderItemCategory;
use Illuminate\Support\Arr;
use App\Exceptions\ErrorException;
use DataTables;

/**
 * Class OrderItemCategoryService.
 */
class OrderItemCategoryService
{
    /** 
     * @access protected
     * @var SalesOrderItemCategoryRepository
     * @version 1.0
     * @author Henry
    **/
    protected $SalesOrderItemCategoryRepository;

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
    public function __construct(SalesOrderItemCategory $SalesOrderItemCategory) {
        $this->SalesOrderItemCategoryRepository      =   $SalesOrderItemCategory;
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
        return DataTables::of($this->SalesOrderItemCategoryRepository->listQuery($where))->make();
    }
    
    
    /**
     * 取得訂購參數資料
     *
     * @param  mixed $id
     * @return void
     */
    public function getSalesItemCategory($id) {
        return $this->SalesOrderItemCategoryRepository->find($id);
    }

    public function getConfigSettings() {
        return $this->SalesOrderItemCategoryRepository->with(['config'=>function($query) {
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
                if($model->insert) {
                    if($search??false) {
                        $search->update($item);
                        unset($all_data[array_search($item['id'],$all_data)]);
                    }else{
                        $search = $model->{$key}()->create($item);
                    }
                }
                $this->setOptions($search, $item);
            }
        }
        if($model->insert) {
            foreach ($all_data as $id) {
                $model->{$key}()->where([
                    'id' => $id,
                ])->delete();
            }
        }
    }

    public function setOptions($model, $data) {
        $key = 'options';
        $all_data = $model->{$key}->pluck('id')->toArray();
        if($data[$key]??false) {
            foreach ($data[$key] as $sort => $item) {
                foreach ($item as $value) {
                    $createData = Arr::only($value, ['name', 'id', 'sales_order_item_option_settings_id']);
                    if(isset($createData['id'])) {
                        $search = $model->{$key}()->where([
                            'id' => $createData['id']
                        ])->first();
                    }else{
                        $search = false;
                    }
                    if($search??false) {
                        $search->update($createData);
                        unset($all_data[array_search($createData['id'],$all_data)]);
                    }else{
                        $search = $model->{$key}()->create($createData);
                    }
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
            $model =  $this->getSalesItemCategory($id);
            $this->setItems($model, $data);
            return $model;
        });
    }

    public function category_select($id) {
        $category = $this->getSalesItemCategory($id);
        return $category->items->map(function($item) {
            return [
                'value' =>  $item->id,
                'name'  =>  $item->name,
            ];
        });
    }

}