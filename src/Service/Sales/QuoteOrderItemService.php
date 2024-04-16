<?php

namespace App\Service\Sales;

use App\Service\OrderItemService;
use App\Service\ProductService;
use App\Models\SalesOrderItem;

/**
 * Class QuoteOrderItemService.
 */
class QuoteOrderItemService extends OrderItemService
{
    use \App\Traits\RateTrait;
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
                    $item['file'] = $item['file']->storeAs('sales_order_item', date('YmdHis')."-".$item['file']->getClientOriginalName() , 'public');
                }

                if(isset($item['id']) && $item['id']) {
                    $search = $model->{$key}()->where('id', $item['id'])->first();
                    if(!$search) {
                        $model->{$key}()->attach($item['id']);
                        $search = SalesOrderItem::find($item['id']);
                    }
                    if($search??false) {
                        $result = $search->update($item);
                        unset($all_data[array_search($item['id'],$all_data)]);
                    }
                    // else{
                    //     $result = $model->{$key}()->create($item);
                    // }
                    if(!$result) {
                        throw new ErrorException(__('backend.errors.insertFail'), 500);
                    }
                }else{
                    if($item['type'] == 2) {
                        $product = $ProductService->index(['product_serial' => $item['product_number']], false)->first();
                        if(!$product) {
                            $review_setting = \App\Models\ReviewSetting::where('model',\App\Models\Product::class)->first();
                            if($review_setting) {
                                $review_events_id = $review_setting->review_events_id;
                            }

                            $product = $ProductService->store([
                                'product_serial'    =>  $item['product_number'],
                                'image_serial'      =>  $item['product_number'],
                                'review_events_id'  =>  $review_events_id??0,
                            ]);
                        }
    
                        $item['products_id'] = $product->id;
                    }else{
                        $product = $ProductService->getProduct($item['products_id']);
                        $item['name']       = $product->product_name;
                        $item['standard']   = $product->product_standard;
                        $item['size']       = $product->size;
                    }
                    $result = $model->{$key}()->create($item);
                    if(!$result) {
                        throw new ErrorException(__('backend.errors.insertFail'), 500);
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

}