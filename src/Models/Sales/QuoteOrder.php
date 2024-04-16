<?php

namespace Cpkm\ErpStock\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteOrder extends Model
{
    use HasFactory, \App\Traits\ObserverTrait, \App\Traits\QueryTrait;

    protected $fillable = [
        'date',
        'no',
        'source_no',
        'delivery_date',
        'quote_start_date',
        'quote_end_date',
        'staff_id',
        'departments_id',
        'customers_id',
        'customer_contacts_id',
        'currencies_id',
        'name',
        'invoice_types_id',
        'amount',
        'tax',
        'total_amount',
        'file',
        'main_amount',
        'main_tax',
        'main_total_amount',
        'companies_id',
        'remark',
        'exchange',
        'sales_quote_order_statuses_id',
        'customer_address',
        'customer_phone',
    ];

    protected $casts = [
        'amount'        =>  'float',
        'tax'           =>  'float',
        'total_amount'  =>  'float'
    ];

    protected $appends = [
        'close'
    ];

    public static $audit = [
        'only' => [
            'date',
            'no',
            'source_no',
            'delivery_date',
            'quote_start_date',
            'quote_end_date',
            'staff_id',
            'departments_id',
            'customers_id',
            'customer_contacts_id',
            'currencies_id',
            'name',
            'invoice_types_id',
            'amount',
            'tax',
            'total_amount',
            'file',
            'main_amount',
            'main_tax',
            'main_total_amount',
            'companies_id',
            'remark',
            'exchange',
            'sales_quote_order_statuses_id',
            'customer_address',
            'customer_phone',
        ],
    ];

    public $detail = [
        'id',
        'date',
        'no',
        'source_no',
        'delivery_date',
        'quote_start_date',
        'quote_end_date',
        'staff_id',
        'departments_id',
        'customers_id',
        'customer_contacts_id',
        'currencies_id',
        'name',
        'invoice_types_id',
        'amount',
        'tax',
        'total_amount',
        'file',
        'main_amount',
        'main_tax',
        'main_total_amount',
        'companies_id',
        'remark',
        'exchange',
        'sales_quote_order_statuses_id',
        'customer_address',
        'customer_phone',
    ];

    public $with = [
        'staff',
        'customer',
        'department',
        'items',
        'contact',
        'status',
    ];

    public function items()
    {
        return $this->morphToMany(SalesOrderItem::class, 'sales_order_itemable')->with(['product' => function($query){
            $query->select(['id', 'product_name', 'size', 'product_standard', 'product_serial']);
        }]);
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

    public function order() {
        return $this->morphMany(SalesOrder::class, 'sourceable');
    }

    public function status() {
        return $this->hasOne(SalesQuoteOrderStatus::class, 'id', 'sales_quote_order_statuses_id');
    }

    public function getCloseAttribute() {
        return in_array($this->sales_quote_order_statuses_id, [2,3]);
    }
}
