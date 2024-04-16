<?php

namespace Cpkm\ErpStock\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, \App\Traits\ObserverTrait, \App\Traits\QueryTrait;

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
        'sales_order_statuses_id',
        'customer_staff_id',
        'customer_address',
        'customer_phone',
    ];

    public $withs = [
        'staff',
        'customer',
        'department',
        'items',
        'contact',
        'sourceable',
        'status',
    ];

    public function items()
    {
        return $this->morphMany(SalesPurchaseOrderItem::class, 'sourceable')->with(['sales_order_item']);
    }

    /**
     * 人員
     *
     * @return void
     */
    public function staff() {
        return $this->hasOne(Staff::class, 'id', 'staff_id');
    }
    
    /**
     * 客戶
     *
     * @return void
     */
    public function customer() {
        return $this->hasOne(Customer::class, 'id', 'customers_id');
    }
    
    /**
     * 部門
     *
     * @return void
     */
    public function department() {
        return $this->hasOne(Department::class, 'id', 'departments_id');
    }

    public function contact() {
        return $this->hasOne(CustomerContact::class, 'id', 'customer_contacts_id');
    }

    public function sourceable() {
        return $this->morphTo();
    }

    public function status() {
        return $this->hasOne(SalesOrderStatus::class, 'id', 'sales_order_statuses_id');
    }

    public function getCloseAttribute() {
        return in_array($this->sales_order_statuses_id, [2,3]);
    }

}
