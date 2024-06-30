<?php

namespace Cpkm\ErpStock\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldReturnOrder extends Model
{
    protected $table = 'sales_sold_return_orders';

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
        'sales_sold_return_order_statuses_id',
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
            'sales_sold_return_order_statuses_id',
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
        'sourceable_id',
        'sourceable_type',
        'sales_sold_return_order_statuses_id',
        'customer_staff_id',
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
        'customer_staff',
        'project',
    ];

    public function items()
    {
        return $this->morphMany(SoldReturnOrderItem::class, 'sourceable');
    }

    public function project() {
        return $this->hasOne(\App\Models\ProjectManagement::class, 'id', 'project_managements_id');
    }

    /**
     * 人員
     *
     * @return void
     */
    public function staff() {
        return $this->hasOne(\App\Models\Staff::class, 'id', 'staff_id');
    }

    public function customer_staff() {
        return $this->hasOne(\App\Models\Staff::class, 'id', 'customer_staff_id');
    }
    
    /**
     * 客戶
     *
     * @return void
     */
    public function customer() {
        return $this->hasOne(\App\Models\Customer::class, 'id', 'customers_id');
    }
    
    /**
     * 部門
     *
     * @return void
     */
    public function department() {
        return $this->hasOne(\App\Models\Department::class, 'id', 'departments_id');
    }

    public function contact() {
        return $this->hasOne(\App\Models\CustomerContact::class, 'id', 'customer_contacts_id');
    }

    public function sourceable() {
        return $this->morphTo();
    }

    public function status() {
        return $this->hasOne(SoldReturnOrderStatus::class, 'id', 'sales_sold_return_order_statuses_id');
    }

    public function getCloseAttribute() {
        return in_array($this->sales_sold_return_order_statuses_id, [2,3]);
    }
}
