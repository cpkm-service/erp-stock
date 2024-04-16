<?php

namespace Cpkm\ErpStock\Http\Controllers\Backend\Restock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cpkm\ErpStock\Service\Restock\PrePurchaseOrderService;
use Cpkm\Admin\Service\SystemSettingsService;
use App\Http\Requests\Backend\SalesQuoteOrder\StoreRequest;
use App\Http\Requests\Backend\SalesQuoteOrder\UpdateRequest;

class PrePurchaseOrderController extends Controller
{
    use \Cpkm\ErpStock\Traits\OrderTrait;

    protected $form = [];
    protected $fields = [];

    public $show = false;
    public function __construct(
        public PrePurchaseOrderService $PrePurchaseOrderService,
        public SystemSettingsService $SystemSettingsService,
    ) {

        $this->form = config('erp-stock.pre_purchase_order.form');
        $this->fields = config('erp-stock.pre_purchase_order.form.fields');
        $this->CustomerService = app(config('erp-stock.pre_purchase_order.customer'));
        $this->ProductService = app(config('erp-stock.pre_purchase_order.product'));
        $this->StaffService = app(config('erp-stock.pre_purchase_order.staff'));

        $this->fields['companies_id']['value'] = $this->SystemSettingsService->getSetting('company');
        
        $this->fields['items[][factory_id]']['options'] = $this->CustomerService->select(2);
        $this->form['back'] =   route('backend.restock.pre_purchase_order.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->expectsJson()) {
            if(request()->action) {
                return $this->getAjaxData();
            }
            return response()->json([
                "data"  =>  $this->PrePurchaseOrderService->index(request()->extraParam??[]),
            ]);
        }
        $data['fields'] = $this->fields;
        return view('erp-stock::backend.restock.pre_purchase_order.index', $data);
    }

    public function formDataHandle($detail) {
        foreach($detail as $field => $value) {
            if(in_array($field, ['items'])) {
                foreach ($this->fields[$field]['parameters'] as $key => $item) {
                    if(isset($this->fields[$item['field']])) {
                        if($this->show) {
                            $this->fields[$item['field']]['disabled']  =   true;
                        }
                    }
                }
                $this->fields[$field]['value']  =   $value;
            }else if($field == 'sourceable'){
                // $this->fields['source_no']['value']  =   $value['no'];
                // $source_name = '';
                // switch ($detail['sourceable_type']) {
                //     case \App\Models\SalesQuoteOrder::class:
                //         $source_name = '報價單';
                //         break;
                // }
                // $this->fields['source_type']['value']  =   $source_name;
                if($this->show) {
                    $this->fields['source_no']['disabled']  =   true;
                    $this->fields['source_type']['disabled']  =   true;
                }
            }else if($field == 'customers_id'){
                $this->fields[$field]['value']  =   $value;
                if($this->show) {
                    $this->fields[$field]['disabled']  =   true;
                }
                $customer = $this->CustomerService->getCustomer($value);
                $this->fields['customer_contacts_id']['options'] =  $customer->customer_contacts->map(function($item){
                    return [
                        'value' =>  $item->id,
                        'name'  =>  $item->name,
                    ];
                })->toArray();
            }else if(in_array($field, ['contact'])){
                $this->fields['phone']['value'] = $value['mobile']??'';
            }else if(isset($this->fields[$field])) {
                $this->fields[$field]['value']  =   $value;
                if($this->show) {
                    $this->fields[$field]['disabled']  =   true;
                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->form['action']   =   route('backend.restock.pre_purchase_order.store');
        $this->form['title']    =   '新增請購單';
        $this->fields['make_id']['value']   =   auth()->user()->staff?->id;
        $data['form']   =   $this->form;
        $data['tax_percentage'] =   $this->SystemSettingsService->getSetting('tax_percentage')??0;
        $data['decimal_point'] =   $this->SystemSettingsService->getSetting('decimal_point')??0;
        \View::share('fields',$this->fields);
        return view('erp-stock::backend.restock.pre_purchase_order.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->PrePurchaseOrderService->store($request->all());
        return redirect()->route('backend.restock.pre_purchase_order.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['detail'] = $this->PrePurchaseOrderService->getPrePurchaseOrder($id);
        $this->form['title']    =   '請購單詳情';
        $this->show = true;
        $this->formDataHandle($data['detail']->toArray());
        $data['form']   =   $this->form;
        $data['table']  =   'pre_purchase_order';
        $data['show']   =   $this->show;
        $data['tax_percentage'] =   $this->SystemSettingsService->getSetting('tax_percentage')??0;
        $data['decimal_point'] =   $this->SystemSettingsService->getSetting('decimal_point')??0;
        \View::share('fields',$this->fields);
        return view('erp-stock::backend.restock.pre_purchase_order.form',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['detail'] = $this->PrePurchaseOrderService->getPrePurchaseOrder($id);
        if($data['detail']->close) {
            return redirect()->route('backend.pre_purchase_order.show', ['subscription_order' => $id]);
        }
        $this->form['title']    =   '編輯請購單';
        $this->form['action']   =   route('backend.pre_purchase_order.update',['subscription_order'=>$id]);
        $this->form['method']   =   "PUT";
        $this->formDataHandle($data['detail']->toArray());
        $data['form']   =   $this->form;
        $data['tax_percentage'] =   $this->SystemSettingsService->getSetting('tax_percentage')??0;
        $data['decimal_point'] =   $this->SystemSettingsService->getSetting('decimal_point')??0;
        return view('backend.pre_purchase_order.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->action == 'close') {
            $this->PrePurchaseOrderService->close($id);
            return response()->json(['message' => __('update').__('success')]);
        }else{
            $this->PrePurchaseOrderService->update($request->all(),$id);
        }
        return redirect()->route('backend.pre_purchase_order.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->PrePurchaseOrderService->delete($id);
        return response()->json(['message' => __('delete').__('success')]);
    }
}
