<?php

namespace Cpkm\ErpStock\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldReturnOrderItem extends Model
{
    protected $table = 'sales_sold_return_order_items';

    protected static $prefix = 'erp-stock::';

    use HasFactory, \Cpkm\Admin\Traits\ObserverTrait, \Cpkm\Admin\Traits\QueryTrait;

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
        'sales_sold_order_items_id',
    ];

    public static $audit = [
        'table' => SoldReturnOrder::class,
        //改存欄位 預設id
        'table_id' => 'sourceable_id',

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
            'sales_sold_order_items_id',
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
        'sales_sold_order_items_id',
    ];

    protected $casts = [
    ];

    public function product() {
        return $this->hasOne(\App\Models\Product::class, 'id', 'products_id');
    }

    public function sourceable() {
        return $this->morphTo();
    }

    public function sales_sold_order_item() {
        return $this->belongsTo(SoldOrderItem::class, 'sales_sold_order_items_id');
    }
}
