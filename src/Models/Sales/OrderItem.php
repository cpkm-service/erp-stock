<?php

namespace Cpkm\ErpStock\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'sales_order_items';

    protected static $prefix = 'erp-stock::';

    use HasFactory, \Cpkm\Admin\Traits\ObserverTrait, \Cpkm\Admin\Traits\QueryTrait;

    protected $appends = [
        'yet_count',
        'income_count',
        'purchase_standard',
    ];

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
        'sales_quote_order_items_id',
    ];

    public static $audit = [
        'table' => SalesOrder::class,
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
        'sourceable_type',
        'sourceable_id',
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
        'sales_quote_order_items_id',
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
        return $this->hasOne(\App\Models\Product::class, 'id', 'products_id');
    }

    public function order() {
        return $this->morphedByMany(SalesOrder::class, 'sales_order_itemable');
    }

    public function sold_order_items() {
        return $this->hasMany(SoldOrderItem::class, 'sales_order_items_id', 'id');
    }

    public function sales_sold_order_items() {
        return $this->hasMany(SoldOrderItem::class, 'sales_order_items_id', 'id');
    }

    public function getYetCountAttribute() {
        return $this->count - $this->sold_order_items->sum('count');
    }

    public function getIncomeCountAttribute() {
        return $this->sold_order_items->sum('count');
    }

    public function getPurchaseStandardAttribute() {
        return route('backend.sales.order_item_standard.create',['item' => $this->id]);
    }

    public function product_stock_list() {
        return $this->morphOne(\App\Models\ProductStockList::class, 'sourceable');
    }
}
