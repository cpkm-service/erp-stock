<?php

namespace Cpkm\ErpStock\Models\Restock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrePurchaseOrder extends Model
{
    use HasFactory, \Cpkm\Admin\Traits\ObserverTrait, \Cpkm\Admin\Traits\QueryTrait;

    protected $fillable = [
        'date',
        'no',
        'companies_id',
        'name',
        'staff_id',
        'departments_id',
        'make_id',
        'remark',
        'pre_purchase_order_statuses_id',
        'file',
    ];

    protected $casts = [
    ];

    public static $audit = [
        'only' => [
            'date',
            'no',
            'companies_id',
            'name',
            'staff_id',
            'departments_id',
            'make_id',
            'remark',
            'pre_purchase_order_statuses_id',
            'file',
        ],
        'translation' => [
            'pre_purchase_order_statuses_id' => [
                'relation' => 'status',
                'format' => 'name',
            ],
        ],
        'many' => [
            'items' => 'name',
        ],
    ];

    public $detail = [
        'id',
        'date',
        'no',
        'companies_id',
        'name',
        'staff_id',
        'departments_id',
        'make_id',
        'remark',
        'pre_purchase_order_statuses_id',
        'file',
    ];

    public $with = [
        'staff',
        'department',
        'items',
        'status',
    ];

    public function items()
    {
        return $this->morphMany(PrePurchaseOrderItem::class, 'sourceable');
    }

    /**
     * 人員
     *
     * @return void
     */
    public function staff() {
        return $this->hasOne(config('erp-stock.pre_purchase_order.models.staff'), 'id', 'staff_id');
    }

    /**
     * 部門
     *
     * @return void
     */
    public function department() {
        return $this->hasOne(config('erp-stock.pre_purchase_order.models.department'), 'id', 'departments_id');
    }

    public function sourceable() {
        return $this->morphTo();
    }

    public function inquiry_order() {
        return $this->morphOne(InquiryOrder::class, 'sourceable');
    }

    public function purchase_order() {
        return $this->morphOne(PurchaseOrder::class, 'sourceable');
    }

    public function status() {
        return $this->hasOne(PrePurchaseOrderStatus::class, 'id', 'pre_purchase_order_statuses_id');
    }

    public function getCloseAttribute() {
        return in_array($this->pre_purchase_order_statuses_id, [2,3]) || ($this->inquiry_order || $this->purchase_order);
    }

}
