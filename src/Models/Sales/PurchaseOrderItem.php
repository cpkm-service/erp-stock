<?php

namespace Cpkm\ErpStock\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory, \App\Traits\ObserverTrait, \App\Traits\QueryTrait;

    protected $fillable = [
        'count',
        'remark',
        'sales_order_items_id',
        'main_amount',
        'main_tax',
        'main_total_amount',
        'amount',
        'tax',
        'total_amount',
        'delivery_date',
    ];

    public static $audit = [
        // 'table' => SalesQuoteOrder::class,
        // //改存欄位 預設id
        // 'table_id' => 'sourceable_id',

        'only' => [
            'count',
            'remark',
            'sales_order_items_id',
            'amount',
            'tax',
            'total_amount',
            'main_amount',
            'main_tax',
            'main_total_amount',
            'delivery_date',
        ],
    ];

    public $detail = [
        'id',
        'count',
        'remark',
        'sales_order_items_id',
        'amount',
        'tax',
        'total_amount',
        'main_amount',
        'main_tax',
        'main_total_amount',
        'delivery_date',
        'sourceable_id',
        'sourceable_type'
    ];

    protected $casts = [
    ];

    public function sourceable() {
        return $this->morphTo();
    }

    public function sales_order_item() {
        return $this->belongsTo(SalesOrderItem::class, 'sales_order_items_id');
    }

    public function sales_purchase_order_item() {
        return $this->belongsTo(SalesPurchaseOrderItem::class, 'sales_purchase_order_items_id');
    }

    public function sales_sold_order_items() {
        return $this->hasMany(SalesSoldOrderItem::class, 'sales_purchase_order_items_id');
    }
}
