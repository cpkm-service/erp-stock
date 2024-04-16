<?php

namespace Cpkm\ErpStock\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldOrderItem extends Model
{
    use HasFactory, \App\Traits\ObserverTrait, \App\Traits\QueryTrait;

    protected $fillable = [
        'count',
        'remark',
        'sales_purchase_order_items_id',
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
            'sales_purchase_order_items_id',
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
        'sales_purchase_order_items_id',
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

    public function sales_purchase_order_item() {
        return $this->belongsTo(SalesPurchaseOrderItem::class, 'sales_purchase_order_items_id');
    }
}
