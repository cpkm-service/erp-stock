<?php

namespace Cpkm\ErpStock\Models\Restock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestockOrderItem extends Model
{
    use HasFactory, \App\Traits\ObserverTrait, \App\Traits\QueryTrait;

    protected $fillable = [
        'count',
        'remark',
        'purchase_order_items_id',
        'acceptance_order_items_id',
        'main_amount',
        'main_tax',
        'main_total_amount',
        'amount',
        'tax',
        'total_amount',
    ];

    public static $audit = [
        'table' => RestockOrder::class,
        //改存欄位 預設id
        'table_id' => 'sourceable_id',

        'only' => [
            'count',
            'remark',
            'purchase_order_items_id',
            'acceptance_order_items_id',
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
        'purchase_order_items_id',
        'acceptance_order_items_id',
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

    public function purchase_order_item() {
        return $this->belongsTo(PurchaseOrderItem::class, 'purchase_order_items_id');
    }

    public function acceptance_order_item() {
        return $this->belongsTo(AcceptanceOrderItem::class, 'acceptance_order_items_id');
    }
}
