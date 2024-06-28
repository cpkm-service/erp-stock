<?php

namespace Cpkm\ErpStock\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldOrderItem extends Model
{
    protected $table = 'sales_sold_order_items';

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
        'sales_order_items_id',
    ];

    public static $audit = [
        'table' => SoldOrder::class,
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
            'sales_order_items_id',
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
        'sales_order_items_id',
    ];

    protected $casts = [
    ];

    public function sourceable() {
        return $this->morphTo();
    }

    public function sales_order_items() {
        return $this->hasMany(SalesOrderItem::class, 'sales_order_items_id', 'id');
    }

    public function sales_sold_return_order_items() {
        return $this->hasMany(SoldReturnOrderItem::class, 'sales_sold_order_items_id', 'id');
    }

}
