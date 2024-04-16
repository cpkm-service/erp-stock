<?php

namespace Cpkm\ErpStock\Traits;

use App\Models\InvoiceType;
use App\Models\InvoiceMethod;
use App\Models\InvoiceCategory;
trait OrderTrait
{
    public function getAjaxData() {
        if(request()->action == 'staff') {
            $staff = $this->StaffService->getStaff(request()->id);
            return response()->json([
                "data"  =>  $staff->department_id
            ]);
        }else if(request()->action == 'product') {
            $product = $this->ProductService->getProduct(request()->id);
            return response()->json([
                "data"  =>  $product->only([
                    'product_name',
                    'product_standard',
                    'size',
                    'stock',
                    'unit',
                    'least_count',
                    'customers_id',
                ])
            ]);
        }else if(request()->action == 'currency') {
            $currency = $this->CurrencyService->getCurrency(request()->id);
            return response()->json([
                "data"  =>  [
                    'exchange'      =>  (float)$currency->exchange,
                ]
            ]);
        }else if(request()->action == 'factory' || request()->action == 'customer') {
            $customer = $this->CustomerService->getCustomer(request()->id);
            $bank = $customer->customer_banks->first();
            return response()->json([   
                "data"  =>  [
                    'contacts'  =>  $customer->customer_contacts->map(function($item){
                        return [
                            'name'  =>  $item->name,
                            'mobile'=>  $item->mobile,
                            'address'   =>  $item->address,
                            'id'    =>  $item->id,
                        ];
                    }),
                    'banks' =>  [
                        'invoice_tax_method'    => $bank?->invoice_tax_method,
                        'invoice_method'    => $bank?->invoice_method,
                        'payment_method'    => $bank?->payment_method,
                        'pamynet_day'       => $bank?->pamynet_day,
                    ],
                    'currencies_id' =>  $customer->currency_id,
                    'exchange'  =>  (float)$customer->currency->exchange,
                    'staff_id' =>  $customer->staff_id,
                ]
            ]);
        }
    }

    public function init() {
        $this->form['fields']['staff_id']['options'] = $this->StaffService->select();
        $this->form['fields']['customer_staff_id']['options']  = $this->form['fields']['staff_id']['options'];
        $this->form['fields']['factory_staff_id']['options'] = $this->form['fields']['make_id']['options'] = $this->form['fields']['staff_id']['options'];
        $this->form['fields']['factory_id']['options'] = $this->CustomerService->select(2);
        $this->form['fields']['customers_id']['options'] = $this->CustomerService->select();
        $this->form['fields']['departments_id']['options'] = $this->DepartmentService->select();
        $this->form['fields']['companies_id']['options'] = $this->CompanyService->select();
        $this->form['fields']['companies_id']['value'] = $this->SystemSettingsService->getSetting('company');
        $this->form['fields']['currencies_id']['options'] = $this->CurrencyService->select();
        $this->form['fields']['items']['products_id']['options'] = $this->ProductService->select();
        $this->form['fields']['items']['depots_id']['options'] = $this->DepotService->select();
        $this->form['fields']['factory_payment_method']['options'] = collect(__('payment_method'))->map(function($item, $key) {
            return [
                'value' =>  $key,
                'name'  =>  $item,
            ];
        })->toArray();
        $this->form['fields']['invoice_types_id']['options'] = $this->form['fields']['items']['invoice_types_id']['options'] = InvoiceType::all()->map(function($item){
            return [
                'value' =>  $item->id,
                'name'  =>  $item->name,
            ];
        })->toArray();
        $this->form['fields']['invoice_methods_id']['options'] = InvoiceMethod::all()->map(function($item){
            return [
                'value' =>  $item->id,
                'name'  =>  $item->name,
            ];
        })->toArray();
        $this->form['fields']['invoice_categories_id']['options'] = InvoiceCategory::all()->map(function($item){
            return [
                'value' =>  $item->id,
                'name'  =>  $item->name,
            ];
        })->toArray();
    }
}
