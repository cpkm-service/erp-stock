<?php

namespace Cpkm\ErpStock\Models\Restock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory, \App\Traits\ObserverTrait, \App\Traits\QueryTrait;

    protected $fillable = [
        'count',
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
        'need_date',
        'order_items_id',
        'stock',
    ];

    public static $audit = [
        // 'table' => PurchaseOrder::class,
        // //改存欄位 預設id
        // 'table_id' => 'sourceable_id',

        'only' => [
            'count',
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
            'need_date',
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
        'count',
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
        'need_date',
        'order_items_id',
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

    public function order_item() {
        return $this->belongsTo(OrderItem::class, 'order_items_id', 'id');
    }

    public function restock_order_items() {
        return $this->hasMany(RestockOrderItem::class, 'purchase_order_items_id', 'id');
    }
}
