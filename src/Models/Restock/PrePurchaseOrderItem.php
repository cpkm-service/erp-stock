<?php

namespace Cpkm\ErpStock\Models\Restock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrePurchaseOrderItem extends Model
{
    use HasFactory, \App\Traits\ObserverTrait, \App\Traits\QueryTrait;

    protected $fillable = [
        'products_id',
        'name',
        'standard',
        'size',
        'count',
        'unit',
        'need_date',
        'pre_count',
        'factory_id',
        'description',
        'remark',
        'file',
        'stock',
    ];

    public static $audit = [
        'table' => PrePurchaseOrder::class,
        //改存欄位 預設id
        'table_id' => 'sourceable_id',

        'only' => [
            'products_id',
            'name',
            'standard',
            'size',
            'count',
            'unit',
            'need_date',
            'pre_count',
            'factory_id',
            'description',
            'remark',
            'file',
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
        'products_id',
        'name',
        'standard',
        'size',
        'count',
        'unit',
        'need_date',
        'pre_count',
        'factory_id',
        'description',
        'remark',
        'file',
        'stock',
    ];

    protected $casts = [
    ];

    public function sourceable() {
        return $this->morphTo();
    }

    public function product() {
        return $this->hasOne(config('erp-stock.pre_purchase_order.models.product'), 'id', 'products_id');
    }

    public function purchase_order_items() {
        return $this->hasMany(PurchaseOrderItem::class, 'order_items_id', 'id');
    }
}
