<?php

namespace Cpkm\ErpStock\Models\Restock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory, \App\Traits\ObserverTrait, \App\Traits\QueryTrait;

    protected $fillable = [
        'date',
        'no',
        'companies_id',
        'factory_id',
        'factory_contact_id',
        'factory_staff_id',
        'factory_payment_method',
        'factory_payment_day',
        'factory_address',
        'factory_phone',
        'name',
        'invoice_types_id',
        'invoice_methods_id',
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
        'sourceable_type',
        'sourceable_id',
        'purchase_order_statuses_id',
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
            'factory_id',
            'factory_contact_id',
            'factory_staff_id',
            'factory_payment_method',
            'factory_payment_day',
            'factory_address',
            'factory_phone',
            'name',
            'invoice_types_id',
            'invoice_methods_id',
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
            'sourceable_type',
            'sourceable_id',
            'purchase_order_statuses_id',
        ],
    ];

    public $detail = [
        'id',
        'date',
        'no',
        'companies_id',
        'factory_id',
        'factory_contact_id',
        'factory_staff_id',
        'factory_payment_method',
        'factory_payment_day',
        'factory_address',
        'factory_phone',
        'name',
        'invoice_types_id',
        'invoice_methods_id',
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
        'sourceable_type',
        'sourceable_id',
        'purchase_order_statuses_id',
    ];

    public $with = [
        'staff',
        'factory',
        'department',
        'items',
        'contact',
        'sourceable',
        'status',
    ];

    public function items()
    {
        return $this->morphMany(PurchaseOrderItem::class, 'sourceable')->with(['order_item']);
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
    public function factory() {
        return $this->hasOne(Customer::class, 'id', 'factory_id');
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
        return $this->hasOne(CustomerContact::class, 'id', 'factory_contact_id');
    }

    public function sourceable() {
        return $this->morphTo();
    }

    public function status() {
        return $this->hasOne(PurchaseOrderStatus::class, 'id', 'purchase_order_statuses_id');
    }

    public function getCanReceiveMaterialOrderAttribute() {
        return $this->items->filter(function($item){
            return $item->order_item->check;
        })->count() > 0;
    }

    public function getCanRestockOrderAttribute() {
        return $this->items->filter(function($item){
            return !$item->order_item->check;
        })->count() > 0;
    }

    public function getCloseAttribute() {
        return in_array($this->purchase_order_statuses_id, [2,3]) || $this->items->filter(function($item){
            return $item->restocks->count() > 0;
        })->count() > 0;
    }
}
