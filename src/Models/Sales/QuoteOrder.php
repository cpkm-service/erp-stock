<?php

namespace Cpkm\ErpStock\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteOrder extends Model
{
    protected $table = 'sales_quote_orders';

    protected static $prefix = 'erp-stock::';

    use HasFactory, \Cpkm\Admin\Traits\ObserverTrait, \Cpkm\Admin\Traits\QueryTrait, \Cpkm\ErpStock\Traits\ModelTrait;

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
        'sourceable_id',
        'sourceable_type',
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
            ]
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
        'sourceable_id',
        'sourceable_type',
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
        'currency',
    ];
    
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
