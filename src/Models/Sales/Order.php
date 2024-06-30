<?php

namespace Cpkm\ErpStock\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'sales_orders';

    protected static $prefix = 'erp-stock::';

    use HasFactory, \Cpkm\Admin\Traits\ObserverTrait, \Cpkm\Admin\Traits\QueryTrait, \Cpkm\ErpStock\Traits\ModelTrait;

    protected $fillable = [
        'date',
        'no',
        'companies_id',
        'customers_id',
        'customer_contacts_id',
        'name',
        'delivery_date',
        'invoice_types_id',
        'invoice_methods_id',
        'invoice_categories_id',
        'currencies_id',
        'exchange',
        'staff_id',
        'departments_id',
        'make_id',
        'amount',
        'tax',
        'total_amount',
        'file',
        'main_amount',
        'main_tax',
        'main_total_amount',
        'remark',
        'sales_order_statuses_id',
        'sourceable_id',
        'sourceable_type',
        'customer_staff_id',
        'customer_address',
        'customer_phone',
        'project_managements_id',
    ];

    protected $casts = [
        'amount'        =>  'float',
        'tax'           =>  'float',
        'total_amount'  =>  'float',
    ];

    public static $audit = [
        'only' => [
            'date',
            'no',
            'companies_id',
            'customers_id',
            'customer_contacts_id',
            'name',
            'delivery_date',
            'invoice_types_id',
            'invoice_methods_id',
            'invoice_categories_id',
            'currencies_id',
            'exchange',
            'staff_id',
            'departments_id',
            'make_id',
            'amount',
            'tax',
            'total_amount',
            'file',
            'main_amount',
            'main_tax',
            'main_total_amount',
            'remark',
            'sales_order_statuses_id',
            'customer_staff_id',
            'customer_address',
            'customer_phone',
            'project_managements_id',
        ],
        'translation' => [
            'companies_id'  =>  [
                'relation'  =>  'company',
                'format'    =>  '{name}',
            ],
            'project_managements_id' => [
                'relation' => 'project',
                'format' => '{name}',
            ],
            'sales_quote_order_statuses_id' => [
                'relation' => 'status',
                'format' => '{name}',
            ],
            'departments_id' => [
                'relation' => 'department',
                'format' => '{name}',
            ],
            'customers_id' => [
                'relation' => 'customer',
                'format' => '{name}',
            ],
            'customer_contacts_id' => [
                'relation' => 'contact',
                'format' => '{name}',
            ],
            'staff_id' => [
                'relation' => 'staff',
                'format' => '{name}',
            ],
            'make_id' => [
                'relation' => 'staff',
                'format' => '{name}',
            ],
            'currencies_id' => [
                'relation' => 'currency',
                'format' => '{name}',
            ],
            'invoice_types_id'  =>  [
                'relation'  =>  'invoice_type',
                'format'    =>  '{name}',
            ],
            'invoice_methods_id'    =>  [
                'relation'  =>  'invoice_method',
                'format'    =>  '{name}',
            ],
            'invoice_categories_id' =>  [
                'relation'  =>  'invoice_category',
                'format'    =>  '{name}',
            ],
        ],
    ];

    protected $appends = [
        'close'
    ];

    public $detail = [
        'id',
        'date',
        'no',
        'companies_id',
        'customers_id',
        'customer_contacts_id',
        'delivery_date',
        'invoice_types_id',
        'invoice_methods_id',
        'invoice_categories_id',
        'currencies_id',
        'exchange',
        'staff_id',
        'departments_id',
        'make_id',
        'amount',
        'tax',
        'total_amount',
        'file',
        'main_amount',
        'main_tax',
        'main_total_amount',
        'remark',
        'sourceable_id',
        'sourceable_type',
        'sales_order_statuses_id',
        'customer_address',
        'customer_phone',
        'project_managements_id',
        
    ];

    public $withs = [
        'staff',
        'customer',
        'department',
        'items',
        'contact',
        'sourceable',
        'status',
        'project',
    ];

    public function items()
    {
        return $this->morphMany(OrderItem::class, 'sourceable');
    }
    
    public function sourceable() {
        return $this->morphTo();
    }

    public function sold_order() {
        return $this->morphMany(SoldOrder::class, 'sourceable');
    }

    public function status() {
        return $this->hasOne(OrderStatus::class, 'id', 'sales_order_statuses_id');
    }

    public function getCloseAttribute() {
        return in_array($this->sales_order_statuses_id, [2,3]);
    }

}
