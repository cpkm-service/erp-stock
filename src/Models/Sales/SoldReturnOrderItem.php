<?php

namespace Cpkm\ErpStock\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldReturnOrderItem extends Model
{
    protected $table = 'sales_sold_return_order_items';

    use HasFactory, \Cpkm\Admin\Traits\ObserverTrait, \Cpkm\Admin\Traits\QueryTrait;

    protected $fillable = [
        'count',
        'remark',
        'sales_sold_order_items_id',
        'main_amount',
        'main_tax',
        'main_total_amount',
        'amount',
        'tax',
        'total_amount',
    ];

    public static $audit = [
        'table' => SalesSoldOrder::class,
        //改存欄位 預設id
        'table_id' => 'sourceable_id',

        'only' => [
            'count',
            'remark',
            'sales_sold_order_items_id',
            'amount',
            'tax',
            'total_amount',
            'main_amount',
            'main_tax',
            'main_total_amount',
        ],
    ];

    public $detail = [
        'id',
        'count',
        'remark',
        'sales_sold_order_items_id',
        'amount',
        'tax',
        'total_amount',
        'main_amount',
        'main_tax',
        'main_total_amount',
    ];

    protected $casts = [
    ];

    public function sourceable() {
        return $this->morphTo();
    }

    public function sales_sold_order_item() {
        return $this->belongsTo(SalesSoldOrderItem::class, 'sales_sold_order_items_id');
    }
}
