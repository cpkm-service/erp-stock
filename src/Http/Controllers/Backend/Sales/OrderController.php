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
use App\Service\DepotService;
use App\Service\SystemSettingsService;
use App\Http\Requests\Backend\SalesQuoteOrder\StoreRequest;
use App\Http\Requests\Backend\SalesQuoteOrder\UpdateRequest;

class OrderController extends Controller
{
    use \Cpkm\ErpStock\Traits\OrderTrait;
    protected $form = [
    ];

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
        $this->form = config('erp-stock.sales_orders.form');
        $this->fields = config('erp-stock.sales_orders.form.fields');
        $this->OrderService = app(config('erp-stock.sales_orders.service'));
        $this->QuoteOrderService = app(config('erp-stock.sales_quote_orders.service'));
        $this->init();
        $this->fields['sourceable_type']['options'] = [
            [
                'value' =>  \Cpkm\ErpStock\Models\Sales\QuoteOrder::class,
                'name'  =>  '報價單',
            ]
        ];
        $this->fields['customers_id']['options'] = $this->CustomerService->select(1);
        $this->form['back'] =   route('backend.sales.order.index');
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
                "data"  =>  $this->OrderService->index([])
            ]);
        }
        return view('erp-stock::backend.sales.order.index');
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
        $this->form['action']   =   route('backend.sales.order.store');
        $this->form['title']    =   '新增訂購單';
        $this->fields['make_id']['value'] = auth()->user()->staff?->id;
        $data['form']   =   $this->form;
        $data['tax_percentage'] =   $this->SystemSettingsService->getSetting('tax_percentage')??0;
        $data['decimal_point'] =   $this->SystemSettingsService->getSetting('decimal_point')??0;
        $this->fields['items']['parameters']['purchase_standard']['width'] = '0px';
        \View::share('fields',$this->fields);
        return view('erp-stock::backend.sales.order.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->OrderService->store($request->all());
        return redirect()->route('backend.sales.order.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['detail'] = $this->OrderService->getSalesOrder($id);
        $this->form['title']    =   '訂購單詳情';
        $this->show = true;
        $this->formDataHandle($data['detail']->toArray());
        $data['form']   =   $this->form;
        $data['table']  =   'sales_orders';
        $data['show']   =   $this->show;
        $data['tax_percentage'] =   $this->SystemSettingsService->getSetting('tax_percentage')??0;
        $data['decimal_point'] =   $this->SystemSettingsService->getSetting('decimal_point')??0;
        \View::share('fields',$this->fields);
        return view('erp-stock::backend.sales.order.form',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['detail'] = $this->OrderService->getSalesOrder($id);
        $this->form['title']    =   '編輯訂購單';
        $this->form['action']   =   route('backend.sales.order.update',['order'=>$id]);
        $this->form['method']   =   "PUT";
        $this->formDataHandle($data['detail']->toArray());
        $data['form']   =   $this->form;
        $data['tax_percentage'] =   $this->SystemSettingsService->getSetting('tax_percentage')??0;
        $data['decimal_point'] =   $this->SystemSettingsService->getSetting('decimal_point')??0;
        \View::share('fields',$this->fields);
        return view('erp-stock::backend.sales.order.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        if($request->action == 'close') {
            $this->OrderService->close($id);
            return response()->json(['message' => __('update').__('success')]);
        }else{
            $this->OrderService->update($request->all(),$id);
        }
        return redirect()->route('backend.sales.order.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->OrderService->delete($id);
        return response()->json(['message' => __('delete').__('success')]);
    }
}
