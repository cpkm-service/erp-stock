<?php

namespace Cpkm\ErpStock\Service\Restock;

use App\Service\ProductService;
use App\Models\OrderItem;
use App\Models\Currency;
use App\Libraries\Rate;

/**
 * Class OrderItemService.
 */
class OrderItemService
{ 

    protected $items_folder = 'pre_purchase_order_items';
    /**
     * 設定項目
     *
     * @param  mixed $model
     * @param  mixed $data
     * @return void
     */
    // public function setItems($model, $data) {
    //     $ProductService = app(ProductService::class);
    //     $key = 'items';
    //     $all_data = $model->{$key}->pluck('id')->toArray();
    //     if($data[$key]??false) {
    //         foreach ($data[$key] as $sort => $item) {
    //             if(isset($item['id']) && $item['id']) {
    //                 $search = $model->{$key}()->where('id', $item['id'])->first();
    //                 if(!$search) {
    //                     $model->{$key}()->attach($item['id']);
    //                     $search = OrderItem::find($item['id']);
    //                 }
    //                 if($search??false) {
    //                     $result = $search->update($item);
    //                     unset($all_data[array_search($item['id'],$all_data)]);
    //                 }
    //                 // else{
    //                 //     $result = $model->{$key}()->create($item);
    //                 // }
    //                 if(!$result) {
    //                     throw new ErrorException(__('backend.errors.insertFail'), 500);
    //                 }
    //             }else{
    //                 $item = $this->dataHandle($item);
    //                 $product = $ProductService->getProduct($item['products_id']);
    //                 $item['name']       = $product->product_name;
    //                 $item['standard']   = $product->product_standard;
    //                 $item['size']       = $product->size;
    //                 $item['check']      = $product->test;
    //                 $item['stock']      = $product->stocks->map(function($stock){
    //                     return [
    //                         'count' =>  $stock->lists->sum('count'),
    //                     ];
    //                 })->sum('count');
    //                 if($product->category) {
    //                     $sample = $product->category->sample->first();
    //                     if($sample) {
    //                         $sample_item = $sample->items()->first();
    //                         if($sample_item) {
    //                             $item['sample_count']       = $sample_item->sampling;
    //                             $item['sample_standard']    = $sample_item->only([
    //                                 'main_MA',
    //                                 'main_AC',
    //                                 'main_RE',
    //                                 'second_MI',
    //                                 'second_AC',
    //                                 'second_RE'
    //                             ]);
    //                         }
    //                     }
    //                 }
    //                 $result = $model->{$key}()->create($item);
    //                 if(!$result) {
    //                     throw new ErrorException(__('backend.errors.insertFail'), 500);
    //                 }
    //             }
    //         }
    //     }
    //     foreach ($all_data as $id) {
    //         $model->{$key}()->where([
    //             'id' => $id,
    //         ])->delete();
    //     }
    // }

    public function setItems($model, $data) {
        $ProductService = app(ProductService::class);
        $key = 'items';
        $all_data = $model->{$key}->pluck('id')->toArray();
        if($data[$key]??false) {
            foreach ($data[$key] as $sort => $item) {

                if(isset($item['file']) && $item['file'] && $item['file'] instanceof \Illuminate\Http\UploadedFile) {
                    $item['file'] = $item['file']->storeAs($this->items_folder, date('YmdHis')."-".$item['file']->getClientOriginalName() , 'public');
                }

                $product = $ProductService->getProduct($item['products_id']);
                $newProduct = true;
                if(isset($item['id'])) {
                    $search = $model->{$key}()->where([
                        'id' => $item['id']
                    ])->first();
                    if($search->products_id == $item['products_id']) {
                        $newProduct = false;
                    }
                }

                if($newProduct) {
                    $item['name']       = $product->product_name;
                    $item['standard']   = $product->product_standard;
                    $item['size']       = $product->size;
                    $item['check']      = $product->test;
                    $item['stock']      = $product->stocks->map(function($stock){
                        return [
                            'count' =>  $stock->lists->sum('count'),
                        ];
                    })->sum('count');
                }
                
                if($search??false) {
                    $search->update($item);
                    unset($all_data[array_search($item['id'],$all_data)]);
                }else{
                    $search = $model->{$key}()->create($item);
                }
                // $ProductService->setProduct($product)->setDepot($search->depots_id)->handleDepotStock('add', $search, true);
            }
        }
        foreach ($all_data as $id) {
            $model->{$key}()->where([
                'id' => $id,
            ])->delete();
        }
    }

    /**
     * 計算金額
     *
     * @return void
     */
    public function calculateAmount($data) {
        $main_amount = 0;
        $main_tax = 0;
        $main_total_amount = 0;
        $invoice_type = $data['invoice_types_id'];
        $decimal_point = $this->SystemSettingRepository->getSetting('decimal_point');
        $currency = Currency::find($data['currencies_id']);
        $exchange = $currency?->exchange??0;
        $data['exchange'] = $exchange;
        foreach ($data['items'] as $key => $item) {
            $rate = app(Rate::class);
            $calculate = $rate->setCurrency($currency)->setInvoiceType($invoice_type)->calculateAmount($item['unit_amount'], $item['count']??$item['quote_count']);
            $data['items'][$key] = array_merge($data['items'][$key], $calculate);
            //總金額加總
            $main_amount = (float)$this->calculateCeil(bcadd($main_amount, $calculate['amount'], $this->point), $currency->price_float);
            $main_tax = (float)$this->calculateCeil(bcadd($main_tax, $calculate['tax'], $this->point), $currency->price_float);
            $main_total_amount = (float)$this->calculateCeil(bcadd($main_total_amount, $calculate['total_amount'], $this->point), $currency->price_float);

            //$item['file'] 檢查是否為檔案格式

            if(isset($item['file']) && $item['file'] instanceof \Illuminate\Http\UploadedFile) {
                $data['items'][$key]['file'] = $item['file']->storeAs('sales_quote_order', date('YmdHis')."-".$item['file']->getClientOriginalName() , 'public');
            }
        }
        $data['amount'] =   $main_amount;
        $data['tax']    =   $main_tax;
        $data['total_amount']   =   $main_total_amount;
        //本位幣計算
        $data['main_amount']        =   $this->calculateCeil(bcmul($main_amount, $exchange, $this->point), $decimal_point);
        $data['main_tax']           =   $this->calculateCeil(bcmul($main_tax, $exchange, $this->point), $decimal_point);
        $data['main_total_amount']  =   $this->calculateCeil(bcmul($main_total_amount, $exchange, $this->point), $decimal_point);
        return $data;
    }
}