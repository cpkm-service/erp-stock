<?php

namespace Cpkm\ErpStock\Service\Sales;

/**
 * Class OrderItemService.
 */
class OrderItemService
{
    protected $stock_type;

    protected $stock_expected;
    
    public function getSalesOrderItem($id) {
        $this->SalesOrderItemRepository = app(\Cpkm\ErpStock\Models\Sales\OrderItem::class);
        return $this->SalesOrderItemRepository->getDetail($id);
    }
    
    /**
     * 設定項目
     *
     * @param  mixed $model
     * @param  mixed $data
     * @return void
     */
    public function setItems($model, $data) {
        $ProductService = app(\App\Service\ProductService::class);
        $review_setting = \App\Models\ReviewSetting::where('model',\App\Models\Product::class)->first();
        if($review_setting) {
            $review_events_id = $review_setting->review_events_id;
        }
        $key = 'items';
        $all_data = $model->{$key}->pluck('id')->toArray();
        
        if($data[$key]??false) {
            foreach ($data[$key] as $sort => $item) {
                if(($item['type']??false) == 2) {
                    $product = $ProductService->index(['product_serial' => $item['product_number']], false)->first();
                    if(!$product) {
                        $product = $ProductService->store([
                            'customers_id'      =>  null,
                            'product_serial'    =>  $item['product_number'],
                            'image_serial'      =>  $item['product_number'],
                            'review_events_id'  =>  $review_events_id??0,
                        ]);
                    }
                    
                    $item['products_id'] = $product->id;
                }else {
                    $product = $ProductService->getProduct($item['products_id']);
                    $item['name']       = $product->product_name;
                    $item['standard']   = $product->product_standard;
                    $item['size']       = $product->size;
                }
                if(isset($item['file']) && $item['file'] && $item['file'] instanceof \Illuminate\Http\UploadedFile) {
                    $item['file'] = $item['file']->storeAs($this->items_folder, date('YmdHis')."-".$item['file']->getClientOriginalName() , 'public');
                }

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
                    $search = $model->{$key}()->create($item);
                }
                if($this->stock_type) {
                    $ProductService->setProduct($product)->setDepot($product?->depots_id)->handleDepotStock($this->stock_type, $search, $this->stock_expected);
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
     * 計算金額
     *
     * @return void
     */
    public function calculateAmount($data) {
        
        $main_amount = 0;
        $main_tax = 0;
        $main_total_amount = 0;
        $invoice_type = $data['invoice_types_id'];
        $tax_percentage = $this->SystemSettingRepository->getSetting('tax_percentage');
        $decimal_point = $this->SystemSettingRepository->getSetting('decimal_point');
        // $main_currency = $this->SystemSettingRepository->getSetting('main_currency');
        $currency = \App\Models\Currency::find($data['currencies_id']);
        $exchange = $currency?->exchange??0;
        $data['exchange'] = $exchange;
        foreach ($data['items'] as $key => $item) {
            $amount = (float)bcmul($item['count'], $item['unit_amount'] , $decimal_point);
            $tax = (float)bcmul($amount, ($tax_percentage / 100), $decimal_point);
            //免稅
            if($invoice_type == 3) {
                $tax = 0;
            //含稅
            }else if($invoice_type == 2){
                $amount = (float)bcsub($amount, $tax, $decimal_point);
            }
            $total_amount = (float)bcadd($amount, $tax, $decimal_point);
            
            $data['items'][$key]['amount']          = $amount;
            $data['items'][$key]['tax']             = $tax;
            $data['items'][$key]['total_amount']    = $total_amount;
            //本位幣計算
            $data['items'][$key]['main_amount']         = bcmul($amount, $exchange, $decimal_point);
            $data['items'][$key]['main_tax']            = bcmul($tax, $exchange, $decimal_point);
            $data['items'][$key]['main_total_amount']   = bcmul($total_amount, $exchange, $decimal_point);
            //總金額加總
            $main_amount = (float)bcadd($main_amount, $amount, $decimal_point);
            $main_tax = (float)bcadd($main_tax, $tax, $decimal_point);
            $main_total_amount = (float)bcadd($main_total_amount, $total_amount, $decimal_point);

            if(isset($item['file']) && $item['file']) {
                $data['items'][$key]['file'] = $item['file']->storeAs('sales_quote_order', date('YmdHis')."-".$item['file']->getClientOriginalName() , 'public');
            }
        }
        $data['amount'] =   $main_amount;
        $data['tax']    =   $main_tax;
        $data['total_amount']   =   $main_total_amount;
        //本位幣計算
        $data['main_amount']        =   bcmul($main_amount, $exchange, $decimal_point);
        $data['main_tax']           =   bcmul($main_tax, $exchange, $decimal_point);
        $data['main_total_amount']  =   bcmul($main_total_amount, $exchange, $decimal_point);
        return $data;
    }

}