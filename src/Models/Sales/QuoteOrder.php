<?php

namespace Cpkm\ErpStock\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteOrder extends Model
{
    protected $table = 'sales_quote_orders';

    use HasFactory, \Cpkm\Admin\Traits\ObserverTrait, \Cpkm\Admin\Traits\QueryTrait;

    protected $fillable = [
        'date',
        'no',
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
        'project_managements_id',
        'make_id',
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
            'make_id',
            'no',
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
            'project_managements_id',
        ],
    ];

    public $detail = [
        'id',
        'date',
        'no',
        'make_id',
        'delivery_date',
        'quote_start_date',
        'quote_end_date',
        'staff_id',
        'departments_id',
        'customers_id',
        'customer_contacts_id',
        'currencies_id',
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
        'project_managements_id',
    ];

    public $with = [
        'staff',
        'customer',
        'department',
        'items',
        'contact',
        'status',
        'project',
        'sourceable',
    ];
    
    /**
     * 來源單
     *
     * @return void
     */
    public function sourceable() {
        return $this->morphTo();
    }
    
    /**
     * 報價單項目
     *
     * @return void
     */
    public function items()
    {
        return $this->morphMany(QuoteOrderItem::class, 'sourceable');
    }
    
    /**
     * 人員
     *
     * @return void
     */
    public function staff() {
        return $this->hasOne(\App\Models\Staff::class, 'id', 'staff_id');
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
    
    /**
     * 專案
     *
     * @return void
     */
    public function project() {
        return $this->hasOne(\App\Models\ProjectManagement::class, 'id', 'project_managements_id');
    }
    
    /**
     * 聯絡人
     *
     * @return void
     */
    public function contact() {
        return $this->hasOne(\App\Models\CustomerContact::class, 'id', 'customer_contacts_id');
    }
    
    /**
     * 關聯單
     *
     * @return void
     */
    public function order() {
        return $this->morphMany(Order::class, 'sourceable');
    }
    
    /**
     * 報價單狀態
     *
     * @return void
     */
    public function status() {
        return $this->hasOne(QuoteOrderStatus::class, 'id', 'sales_quote_order_statuses_id');
    }

    public function getCloseAttribute() {
        return in_array($this->sales_quote_order_statuses_id, [2,3]);
    }
}
