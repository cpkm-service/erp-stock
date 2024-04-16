<?php

namespace Cpkm\ErpStock\Models\Restock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestockReturnOrderItem extends Model
{
    use HasFactory, \App\Traits\ObserverTrait, \App\Traits\QueryTrait;

    protected $fillable = [
        'count',
        'remark',
        'restock_order_items_id',
        'main_amount',
        'main_tax',
        'main_total_amount',
        'amount',
        'tax',
        'total_amount',
    ];

    public static $audit = [
        'table' => RestockReturnOrder::class,
        //改存欄位 預設id
        'table_id' => 'sourceable_id',

        'only' => [
            'count',
            'remark',
            'restock_order_items_id',
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
        'restock_order_items_id',
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

    public function restock_order_item() {
        return $this->belongsTo(RestockOrderItem::class, 'restock_order_items_id');
    }

}
