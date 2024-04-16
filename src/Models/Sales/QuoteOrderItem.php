<?php

namespace Cpkm\ErpStock\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteOrderItem extends Model
{
    use HasFactory, \App\Traits\ObserverTrait;

    protected $fillable = [
        'type',
        'no',
        'products_id',
        'count',
        'unit',
        'remark',
        'description',
        'sales_purchase_orders_id',
        'amount',
        'tax',
        'total_amount',
        'file',
        'main_amount',
        'main_tax',
        'main_total_amount',
        'unit_amount',
        'file',
        'name',
        'standard',
        'size',
    ];

    public static $audit = [
        'table' => SalesQuoteOrder::class,
        //改存欄位 預設id
        'table_id' => 'sourceable_id',

        'only' => [
            'type',
            'no',
            'products_id',
            'count',
            'unit',
            'remark',
            'description',
            'sales_purchase_orders_id',
            'amount',
            'tax',
            'total_amount',
            'file',
            'main_amount',
            'main_tax',
            'main_total_amount',
            'unit_amount',
            'file',
            'name',
            'standard',
            'size',
        ],
        'translation' => [
            'products_id' => [
                'relation' => 'product',
                'format' => '{product_serial}',
            ],
        ],
    ];

    public $detail = [
        'type',
        'no',
        'products_id',
        'count',
        'unit',
        'remark',
        'description',
        'sales_purchase_orders_id',
        'amount',
        'tax',
        'total_amount',
        'file',
        'main_amount',
        'main_tax',
        'main_total_amount',
        'unit_amount',
        'file',
        'name',
        'standard',
        'size',
    ];

    protected $casts = [
        'unit_amount'   =>  'float',
        'amount'        =>  'float',
        'tax'           =>  'float',
        'total_amount'  =>  'float'
    ];

    public function sourceable() {
        return $this->morphTo();
    }

    public function product() {
        return $this->hasOne(Product::class, 'id', 'products_id');
    }
}
