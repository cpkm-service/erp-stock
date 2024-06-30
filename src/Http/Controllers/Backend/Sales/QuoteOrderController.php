<?php

namespace Cpkm\ErpStock\Http\Controllers\Backend\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\StaffService;
use App\Service\CustomerService;
use App\Service\DepartmentService;
use App\Service\ProductService;
use App\Service\CompanyService;
use App\Service\CurrencyService;
use App\Service\SystemSettingsService;
use App\Service\DepotService;
use App\Http\Requests\Backend\SalesQuoteOrder\StoreRequest;
use App\Http\Requests\Backend\SalesQuoteOrder\UpdateRequest;

class QuoteOrderController extends Controller
{
    protected $form = [
    ];

    use \Cpkm\ErpStock\Traits\OrderTrait;

    public $show = false;
    public function __construct(
        public StaffService $StaffService,
        public CustomerService $CustomerService,
        public DepartmentService $DepartmentService,
        public ProductService $ProductService,
        public CompanyService $CompanyService,
        public CurrencyService $CurrencyService,
        public SystemSettingsService $SystemSettingsService,
        public DepotService $DepotService,
    ) {
        $this->form = config('erp-stock.sales_quote_orders.form');
        $this->fields = config('erp-stock.sales_quote_orders.form.fields');
        $this->QuoteOrderService = app(config('erp-stock.sales_quote_orders.service'));
        $this->init();
        $this->fields['sourceable_type']['options'] = [
            [
                'value' =>  \Cpkm\ErpStock\Models\Sales\QuoteOrder::class,
                'name'  =>  '報價單',
            ]
        ];
        $this->SystemSettingsService = app(SystemSettingsService::class);
        $this->fields['customers_id']['options'] = $this->CustomerService->select(1);
        $this->form['back'] =   route('backend.sales.quote_order.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->expectsJson()) {
            if(request()->action == 'sourceable_type') {
                return response()->json([   
                    "data"  =>  $this->QuoteOrderService->select([
                        'sales_quote_order_statuses_id'    =>  1,
                    ])
                ]);
            }else if(request()->action == 'sourceable_id') {
                return response()->json([   
                    "data"  =>  $this->QuoteOrderService->getSalesQuoteOrder(request()->id),
                ]);
            }else if(request()->action) {
                return $this->getAjaxData();
            }
            return response()->json([
                "data"  =>  $this->QuoteOrderService->index([])
            ]);
        }
        return view('erp-stock::backend.sales.quote_order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->form['action']   =   route('backend.sales.quote_order.store');
        $this->form['title']    =   '新增報價單';
        $this->fields['make_id']['value'] = auth()->user()->staff?->id;
        $data['form']   =   $this->form;
        $data['tax_percentage'] =   $this->SystemSettingsService->getSetting('tax_percentage')??0;
        $data['decimal_point'] =   $this->SystemSettingsService->getSetting('decimal_point')??0;
        \View::share('fields',$this->fields);
        return view('erp-stock::backend.sales.quote_order.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->QuoteOrderService->store($request->all());
        return redirect()->route('backend.sales.quote_order.index');
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
                if($this->show) {
                    $this->fields[$field]['disabled']  =   true;
                }
                $this->fields[$field]['value']  =   $value;
            }else if($field == 'sourceable'){
                $this->fields['sourceable_id']['options'] = $this->QuoteOrderService->select();
                $this->fields['sourceable_type']['disabled'] = true;
                $this->fields['sourceable_id']['disabled'] = true;
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
                $this->fields['customer_contacts_id']['value'] = $detail['customer_contacts_id'];
            }else if(isset($this->fields[$field])) {
                $this->fields[$field]['value']  =   $value;
                if($this->show) {
                    $this->fields[$field]['disabled']  =   true;
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['detail'] = $this->QuoteOrderService->getSalesQuoteOrder($id);
        $this->form['title']    =   '報價單詳情';
        $this->show = true;
        $this->formDataHandle($data['detail']->toArray());
        $data['form']   =   $this->form;
        $data['table']  =   'sales_quote_orders';
        $data['show']   =   $this->show;
        $data['tax_percentage'] =   $this->SystemSettingsService->getSetting('tax_percentage')??0;
        $data['decimal_point'] =   $this->SystemSettingsService->getSetting('decimal_point')??0;
        unset($this->fields['items']['parameters']['product_number']);
        \View::share('fields',$this->fields);
        return view('erp-stock::backend.sales.quote_order.form',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['detail'] = $this->QuoteOrderService->getSalesQuoteOrder($id);
        if($data['detail']->close) {
            return redirect()->route('backend.sales.quote_order.show',['quote_order'=>$id]);
        }
        $this->form['title']    =   '編輯報價單';
        $this->form['action']   =   route('backend.sales.quote_order.update',['quote_order'=>$id]);
        $this->form['method']   =   "PUT";
        $this->formDataHandle($data['detail']->toArray());
        $data['form']   =   $this->form;
        $data['tax_percentage'] =   $this->SystemSettingsService->getSetting('tax_percentage')??0;
        $data['decimal_point'] =   $this->SystemSettingsService->getSetting('decimal_point')??0;
        \View::share('fields',$this->fields);
        return view('erp-stock::backend.sales.quote_order.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->action == 'close') {
            \DB::transaction(function() use ($id) {
                $this->QuoteOrderService->close($id);
            });
            return response()->json(['message' => __('update').__('success')]);
        }else{
            $this->QuoteOrderService->update($request->all(),$id);
        }
        return redirect()->route('backend.sales.quote_order.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->QuoteOrderService->delete($id);
        return response()->json(['message' => __('delete').__('success')]);
    }
}
