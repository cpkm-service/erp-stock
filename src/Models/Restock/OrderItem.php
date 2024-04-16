<?php

namespace Cpkm\ErpStock\Models\Restock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class OrderItem extends Model
{
    use HasFactory, \App\Traits\ObserverTrait, \App\Traits\QueryTrait;

    protected $fillable = [
        'products_id',
        'name',
        'standard',
        'size',
        'subscription_count',
        'stock',
        'unit',
        'need_date',
        'count',
        'factory_id',
        'description',
        'remark',
        'file',
        'depots_id',
        'check',
        'unit_amount',
        'amount',
        'tax',
        'total_amount',
        'main_amount',
        'main_tax',
        'main_total_amount',
        'sample_count',
        'sample_standard',
    ];

    protected $casts = [
        'unit_amount'   =>  'float',
        'amount'        =>  'float',
        'tax'           =>  'float',
        'total_amount'  =>  'float',
        'sample_standard'   =>  AsCollection::class,
    ];

    protected $appends = [
        'allow_standard',
        'receive_material_count',
    ];

    public static $audit = [
        'only' => [
            'products_id',
            'name',
            'standard',
            'size',
            'subscription_count',
            'stock',
            'unit',
            'need_date',
            'count',
            'factory_id',
            'description',
            'remark',
            'file',
            'depots_id',
            'check',
            'unit_amount',
            'amount',
            'tax',
            'total_amount',
            'main_amount',
            'main_tax',
            'main_total_amount',
            'sample_count',
            'sample_standard',
        ],
        'translation' => [
            'products_id' => [
                'relation' => 'product',
                'format' => '{product_serial}',
            ],
        ],
    ];

    protected $detail = [
        'id',
        'products_id',
        'name',
        'standard',
        'size',
        'subscription_count',
        'stock',
        'unit',
        'need_date',
        'count',
        'factory_id',
        'description',
        'remark',
        'file',
        'depots_id',
        'check',
        'unit_amount',
        'amount',
        'tax',
        'total_amount',
        'main_amount',
        'main_tax',
        'main_total_amount',
        'sample_count',
        'sample_standard',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

    public function factory()
    {
        return $this->belongsTo(Factory::class, 'factory_id');
    }

    public function depots()
    {
        return $this->belongsTo(Depot::class, 'depots_id');
    }

    public function subscription_order() {
        return $this->morphedByMany(SubscriptionOrder::class, 'order_itemable');
    }

    public function inquiry_order() {
        return $this->morphedByMany(InquiryOrder::class, 'order_itemable');
    }

    public function purchase_order() {
        return $this->morphedByMany(PurchaseOrder::class, 'order_itemable');
    }

    public function receive_material_orders() {
        return $this->morphMany(ReceiveMaterialOrderItem::class, 'sourceable');
    }

    public function restocks() {
        return $this->hasMany(RestockOrderItem::class, 'order_items_id');
    }

    public function receive_material_order_item() {
        return $this->morphOne(ReceiveMaterialOrderItem::class, 'sourceable');
    }

    public function getAllowStandardAttribute() {
        if($this->sample_standard) {
            return $this->sample_standard->map(function($value, $key){
                return __('backend.samplings.sampling_items.*.'.$key)." : ".$value;
            })->join(' , ');
        }
        return '';
    }

    public function getReceiveMaterialCountAttribute() {
        return $this->receive_material_orders->sum('count');
    }

    public function purchase_order_items() {
        return $this->hasMany(PurchaseOrderItem::class, 'order_items_id', 'id');
    }

}
