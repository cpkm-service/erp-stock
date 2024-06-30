<?php

namespace Cpkm\ErpStock\Traits;

trait ModelTrait
{
    /**
     * 來源單
     *
     * @return void
     */
    public function sourceable() {
        return $this->morphTo();
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
     * 專案項目
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
     * 幣別
     *
     * @return void
     */
    public function currency() {
        return $this->hasOne(\App\Models\Currency::class, 'id', 'currencies_id');
    }
    
    /**
     * 扣稅類別
     *
     * @return void
     */
    public function invoice_type() {
        return $this->hasOne(\App\Models\InvoiceType::class, 'id', 'invoice_types_id');
    }
    
    /**
     * 發票方式
     *
     * @return void
     */
    public function invoice_method() {
        return $this->hasOne(\App\Models\InvoiceMethod::class, 'id', 'invoice_methods_id');
    }
    
    /**
     * 發票類別
     *
     * @return void
     */
    public function invoice_category() {
        return $this->hasOne(\App\Models\InvoiceCategory::class, 'id', 'invoice_categories_id');
    }
    
    /**
     * 公司別
     *
     * @return void
     */
    public function company() {
        return $this->hasOne(\App\Models\Company::class, 'id', 'companies_id');
    }
}
