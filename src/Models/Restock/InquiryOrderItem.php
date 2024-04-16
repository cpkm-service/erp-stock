<?php

namespace Cpkm\ErpStock\Models\Restock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryOrderItem extends Model
{
    use HasFactory, \App\Traits\ObserverTrait, \App\Traits\QueryTrait;

    protected $fillable = [
        'products_id',
        'count',
        'unit',
        'remark',
        'description',
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
        'need_date',
        'check',
        'subscription_order_items_id',
        'stock',
    ];

    public static $audit = [
        'table' => SalesQuoteOrder::class,
        //改存欄位 預設id
        'table_id' => 'sourceable_id',

        'only' => [
            'products_id',
            'count',
            'unit',
            'remark',
            'description',
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
            'need_date',
            'check',
            'stock',
        ],
        'translation' => [
            'products_id' => [
                'relation' => 'product',
                'format' => '{product_serial}',
            ],
        ],
    ];

    public $detail = [
        'id',
        'products_id',
        'count',
        'unit',
        'remark',
        'description',
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
        'need_date',
        'check',
        'subscription_order_items_id',
        'stock',
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
