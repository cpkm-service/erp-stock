<?php

namespace Cpkm\ErpStock\Http\Controllers\Backend\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Sales\QuoteOrderService;
use App\Service\StaffService;
use App\Service\CustomerService;
use App\Service\DepartmentService;
use App\Service\ProductService;
use App\Service\CompanyService;
use App\Service\CurrencyService;
use App\Models\InvoiceType;
use App\Service\SystemSettingsService;
use App\Http\Requests\Backend\SalesQuoteOrder\StoreRequest;
use App\Http\Requests\Backend\SalesQuoteOrder\UpdateRequest;

class QuoteOrderController extends Controller
{
    protected $form = [
        'name'      =>  'sales_standard_config',
        'action'    =>  '',
        'back'      =>  '',
        'method'    =>  "POST",
        'title'     =>  '',
        'fields'    =>  [
            //日期
            'date'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'date',
                'text'          =>  'backend.sales_quote_orders.date',
                'placeholder'   =>  'backend.sales_quote_orders.date',
                'required'      =>  true,
            ],
            //單號
            'no'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'no',
                'text'          =>  'backend.sales_quote_orders.no',
                'placeholder'   =>  'backend.sales_quote_orders.no',
                'required'      =>  false,
                'disabled'      =>  true,
            ],
            //來源單號
            'source_no'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'source_no',
                'text'          =>  'backend.sales_quote_orders.source_no',
                'placeholder'   =>  'backend.sales_quote_orders.source_no',
                'required'      =>  false,
                'readonly'     =>  true,
            ],
            //公司別
            'companies_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'companies_id',
                'text'          =>  'backend.sales_quote_orders.companies_id',
                'placeholder'   =>  'backend.sales_quote_orders.companies_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //預定交貨日
            'delivery_date'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'delivery_date',
                'text'          =>  'backend.sales_quote_orders.delivery_date',
                'placeholder'   =>  'backend.sales_quote_orders.delivery_date',
                'required'      =>  false,
            ],
            //報價起始日
            'quote_start_date'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'quote_start_date',
                'text'          =>  'backend.sales_quote_orders.quote_start_date',
                'placeholder'   =>  'backend.sales_quote_orders.quote_start_date',
                'required'      =>  true,
            ],
            //報價失效日
            'quote_end_date'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'quote_end_date',
                'text'          =>  'backend.sales_quote_orders.quote_end_date',
                'placeholder'   =>  'backend.sales_quote_orders.quote_end_date',
                'required'      =>  false,
            ],
            //人員
            'staff_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'staff_id',
                'text'          =>  'backend.sales_quote_orders.staff_id',
                'placeholder'   =>  'backend.sales_quote_orders.staff_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //部門
            'departments_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'departments_id',
                'text'          =>  'backend.sales_quote_orders.departments_id',
                'placeholder'   =>  'backend.sales_quote_orders.departments_id',
                'required'      =>  false,
                'disabled'      =>  true,
                'options'       =>  [
                ]
            ],
            //客戶
            'customers_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'customers_id',
                'text'          =>  'backend.sales_quote_orders.customers_id',
                'placeholder'   =>  'backend.sales_quote_orders.customers_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //聯絡人
            'customer_contacts_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'customer_contacts_id',
                'text'          =>  'backend.sales_quote_orders.customer_contacts_id',
                'placeholder'   =>  'backend.sales_quote_orders.customer_contacts_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            'customer_phone'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'customer_phone',
                'text'          =>  'backend.sales_quote_orders.customer_phone',
                'placeholder'   =>  'backend.sales_quote_orders.customer_phone',
                'required'      =>  false,
                'disabled'      =>  true,
            ],
            'customer_address'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'customer_address',
                'text'          =>  'backend.sales_quote_orders.customer_address',
                'placeholder'   =>  'backend.sales_quote_orders.customer_address',
                'required'      =>  false,
                'disabled'      =>  true,
            ],
            //專案名稱
            'name'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'name',
                'text'          =>  'backend.sales_quote_orders.name',
                'placeholder'   =>  'backend.sales_quote_orders.name',
                'required'      =>  true,
            ],
            //幣別
            'currencies_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'currencies_id',
                'text'          =>  'backend.sales_quote_orders.currencies_id',
                'placeholder'   =>  'backend.sales_quote_orders.currencies_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //發票
            'invoice_types_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'invoice_types_id',
                'text'          =>  'backend.sales_quote_orders.invoice_types_id',
                'placeholder'   =>  'backend.sales_quote_orders.invoice_types_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],

            //未稅金額
            'amount'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'amount',
                'text'          =>  'backend.sales_quote_orders.amount',
                'placeholder'   =>  'backend.sales_quote_orders.amount',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //稅金
            'tax'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'tax',
                'text'          =>  'backend.sales_quote_orders.tax',
                'placeholder'   =>  'backend.sales_quote_orders.tax',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //總額
            'total_amount'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'total_amount',
                'text'          =>  'backend.sales_quote_orders.total_amount',
                'placeholder'   =>  'backend.sales_quote_orders.total_amount',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //未稅金額(本未必)
            'main_amount'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'main_amount',
                'text'          =>  'backend.sales_quote_orders.main_amount',
                'placeholder'   =>  'backend.sales_quote_orders.main_amount',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //稅金(本位幣)
            'main_tax'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'main_tax',
                'text'          =>  'backend.sales_quote_orders.main_tax',
                'placeholder'   =>  'backend.sales_quote_orders.main_tax',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //總額(本位幣)
            'main_total_amount'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'main_total_amount',
                'text'          =>  'backend.sales_quote_orders.main_total_amount',
                'placeholder'   =>  'backend.sales_quote_orders.main_total_amount',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //附加檔案
            'file'   =>  [
                'tag'           =>  'input',
                'type'          =>  'file',
                'name'          =>  'file',
                'text'          =>  'backend.sales_quote_orders.file',
                'placeholder'   =>  'backend.sales_quote_orders.file',
                'required'      =>  false,
            ],
            //備註
            'remark'   =>  [
                'tag'           =>  'textarea',
                'name'          =>  'remark',
                'text'          =>  'backend.sales_quote_orders.remark',
                'placeholder'   =>  'backend.sales_quote_orders.remark',
                'required'      =>  false,
            ],
            /*-------------------------表身---------------------- */
            'items' =>  [
                //產品編號
                'products_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'items[$i][products_id]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.products_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                ],
                //取號類型
                'type'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][type]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.type',
                    'value'         =>  1,
                    'required'      =>  false,
                ],
                //品名
                'name'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][name]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.name',
                    'required'      =>  false,
                    'disabled'      =>  true,
                ],
                //規格
                'standard'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][standard]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.standard',
                    'required'      =>  false,
                    'disabled'      =>  true,
                ],
                //尺寸
                'size'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][size]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.size',
                    'required'      =>  false,
                    'disabled'      =>  true,
                ],
                //數量
                'quote_count'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][quote_count]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.count',
                    'value'         =>  0,
                    'required'      =>  true,
                ],
                //單位
                'unit'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][unit]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.unit',
                    'required'      =>  false,
                ],
                //單價
                'unit_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][unit_amount]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.unit_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                ],
                //未稅金額
                'amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][amount]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                ],
                //稅金
                'tax'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][tax]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                ],
                //總額
                'total_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][total_amount]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                ],
                //未稅金額(本未必)
                'main_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_amount]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.main_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                ],
                //稅金(本位幣)
                'main_tax'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_tax]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.main_tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                ],
                //總額(本位幣)
                'main_total_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_total_amount]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.main_total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                ],
                //內部描述
                'description'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][description]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.description',
                    'required'      =>  false,
                ],
                //備註
                'remark'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][remark]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.remark',
                    'required'      =>  false,
                ],
                //訂購單號                
                'sales_purchase_orders_id'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][sales_purchase_orders_id]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.*.sales_purchase_orders_id',
                    'value'         =>  '',
                    'required'      =>  false,
                    'disabled'      =>  true,
                ],
                //附加檔案
                'file'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'file',
                    'name'          =>  'items[$i][file]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_quote_orders.sales_quote_order_items.file',
                    'required'      =>  false,
                ],
            ],
        ],
    ];

    public $show = false;
    public function __construct() {
        $this->QuoteOrderService = app(QuoteOrderService::class);
        $this->StaffService = app(StaffService::class);
        $this->CustomerService = app(CustomerService::class);
        $this->DepartmentService = app(DepartmentService::class);
        $this->ProductService = app(ProductService::class);
        $this->CompanyService = app(CompanyService::class);
        $this->CurrencyService = app(CurrencyService::class);
        $this->SystemSettingsService = app(SystemSettingsService::class);
        $this->form['fields']['staff_id']['options'] = $this->StaffService->select();
        $this->form['fields']['customers_id']['options'] = $this->CustomerService->select();
        $this->form['fields']['departments_id']['options'] = $this->DepartmentService->select();
        $this->form['fields']['companies_id']['options'] = $this->CompanyService->select();
        $this->form['fields']['companies_id']['value'] = $this->SystemSettingsService->getSetting('company');
        $this->form['fields']['currencies_id']['options'] = $this->CurrencyService->select();
        $this->form['fields']['items']['products_id']['options'] = $this->ProductService->select();
        $this->form['fields']['invoice_types_id']['options'] = InvoiceType::all()->map(function($item){
            return [
                'value' =>  $item->id,
                'name'  =>  $item->name,
            ];
        })->toArray();
        $this->form['back'] =   route('backend.sales.quote_order.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->expectsJson()) {
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
                        'unit',
                        'least_count',
                    ])
                ]);
            }else if(request()->action == 'customer') {
                $customer = $this->CustomerService->getCustomer(request()->id);
                $bank = $customer->customer_banks->first();
                return response()->json([   
                    "data"  =>  [
                        'contacts'  =>  $customer->customer_contacts->map(function($item){
                            return $item->only([
                                'name',
                                'mobile',
                                'id',
                                'address'
                            ]);
                        }),
                        'banks' =>  [
                            'invoice_tax_method'    => $bank?->invoice_tax_method
                        ],
                        'currencies_id' =>  $customer->currency_id,
                    ]
                ]);
            }
            return response()->json([
                "data"  =>  $this->QuoteOrderService->index([])
            ]);
        }
        return view('backend.sales.quote_order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(request()->quote_order) {
            $data['detail'] = $this->QuoteOrderService->getSalesQuoteOrder(request()->quote_order);
            $this->formDataHandle($data['detail']->toArray());
            $this->form['fields']['source_no']['value'] = $data['detail']->no;
            $this->form['fields']['no']['value'] =   '';
        }
        $this->form['action']   =   route('backend.sales.quote_order.store');
        $this->form['title']    =   '新增報價單';
        $this->form['fields']['staff_id']['value'] =  auth()->user()->staff?->id;
        $this->form['fields']['departments_id']['value'] =  auth()->user()->staff?->department?->id;
        $data['form']   =   $this->form;
        $data['tax_percentage'] =   $this->SystemSettingsService->getSetting('tax_percentage')??0;
        $data['decimal_point'] =   $this->SystemSettingsService->getSetting('decimal_point')??0;
        return view('backend.sales.quote_order.form', $data);
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
        foreach($detail as $field => $detail) {
            if(in_array($field, ['items'])) {
                foreach ($this->form['fields'][$field] as $key => $item) {
                    if(isset($this->form['fields'][$field][$key])) {
                        if($this->show) {
                            $this->form['fields'][$field][$key]['disabled']  =   true;
                        }
                    }
                }
            }else if($field == 'customers_id'){
                $this->form['fields'][$field]['value']  =   $detail;
                if($this->show) {
                    $this->form['fields'][$field]['disabled']  =   true;
                }
                $customer = $this->CustomerService->getCustomer($detail);
                $this->form['fields']['customer_contacts_id']['options'] =  $customer->customer_contacts->map(function($item){
                    return [
                        'value' =>  $item->id,
                        'name'  =>  $item->name,
                    ];
                })->toArray();
            }else if(in_array($field, ['contact'])){
                $this->form['fields']['phone']['value'] = $detail['mobile']??'';
            }else if(isset($this->form['fields'][$field])) {
                $this->form['fields'][$field]['value']  =   $detail;
                if($this->show) {
                    $this->form['fields'][$field]['disabled']  =   true;
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
        return view('backend.sales.quote_order.form',$data);
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
        return view('backend.sales.quote_order.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->QuoteOrderService->update($request->all(),$id);
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
