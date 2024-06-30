<?php

namespace Cpkm\ErpStock\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteOrderItem extends Model
{
    protected $table = 'sales_quote_order_items';

    protected static $prefix = 'erp-stock::';
    
    use HasFactory, \Cpkm\Admin\Traits\ObserverTrait, \Cpkm\Admin\Traits\QueryTrait;

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
        'table' => QuoteOrder::class,
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
        return $this->hasOne(\App\Models\Product::class, 'id', 'products_id');
    }

    public function sales_order_items() {
        return $this->hasMany(OrderItem::class, 'sales_quote_order_items_id', 'id');
    }

    public function product_stock_list() {
        return $this->morphOne(\App\Models\ProductStockList::class, 'sourceable');
    }
}
