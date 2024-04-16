<?php

namespace Cpkm\ErpStock\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory, \App\Traits\ObserverTrait, \App\Traits\QueryTrait;

    protected $fillable = [
        'type',
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
        'delivery_date',
        'quote_count',
    ];

    public static $audit = [
        // 'table' => SalesQuoteOrder::class,
        // //改存欄位 預設id
        // 'table_id' => 'sourceable_id',

        'only' => [
            'type',
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
            'delivery_date',
            'quote_count',
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
        'type',
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
        'delivery_date',
        'quote_count',
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

    public function order() {
        return $this->morphedByMany(SalesOrder::class, 'sales_order_itemable');
    }

    public function sold_order_items() {
        return $this->hasMany(SalesSoldOrderItem::class, 'sales_order_items_id', 'id');
    }

    public function purchase_order_items() {
        return $this->hasMany(SalesPurchaseOrderItem::class, 'sales_order_items_id', 'id');
    }
}
