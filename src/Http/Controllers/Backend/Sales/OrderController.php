<?php

namespace Cpkm\ErpStock\Http\Controllers\Backend\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Sales\OrderService;
use App\Service\Sales\QuoteOrderService;
use App\Service\StaffService;
use App\Service\CustomerService;
use App\Service\DepartmentService;
use App\Service\ProductService;
use App\Service\CompanyService;
use App\Service\CurrencyService;
use App\Models\InvoiceType;
use App\Models\InvoiceMethod;
use App\Models\InvoiceCategory;
use App\Service\SystemSettingsService;
use App\Http\Requests\Backend\SalesQuoteOrder\StoreRequest;
use App\Http\Requests\Backend\SalesQuoteOrder\UpdateRequest;

class OrderController extends Controller
{
    protected $form = [
        'name'      =>  'sales_order',
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
                'text'          =>  'backend.sales_orders.date',
                'placeholder'   =>  'backend.sales_orders.date',
                'required'      =>  true,
            ],
            //單號
            'no'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'no',
                'text'          =>  'backend.sales_orders.no',
                'placeholder'   =>  'backend.sales_orders.no',
                'required'      =>  false,
                'disabled'      =>  true,
            ],
            //來源單號
            'sourceable_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'sourceable_id',
                'text'          =>  'backend.sales_orders.sourceable_id',
                'placeholder'   =>  'backend.sales_orders.sourceable_id',
                'required'      =>  false,
                'disabled'      =>  false,
                'options'       =>  [
                ]
            ],
            //來源類別
            'sourceable_type'   =>  [
                'tag'           =>  'select',
                'name'          =>  'sourceable_type',
                'text'          =>  'backend.sales_orders.sourceable_type',
                'placeholder'   =>  'backend.sales_orders.sourceable_type',
                'required'      =>  false,
                'disabled'      =>  false,
                'options'       =>  [
                ]
            ],
            //公司別
            'companies_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'companies_id',
                'text'          =>  'backend.sales_orders.companies_id',
                'placeholder'   =>  'backend.sales_orders.companies_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //預定交貨日
            'delivery_date'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'delivery_date',
                'text'          =>  'backend.sales_orders.delivery_date',
                'placeholder'   =>  'backend.sales_orders.delivery_date',
                'required'      =>  false,
            ],
            //人員
            'staff_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'staff_id',
                'text'          =>  'backend.sales_orders.staff_id',
                'placeholder'   =>  'backend.sales_orders.staff_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //人員
            'make_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'make_id',
                'text'          =>  'backend.sales_orders.make_id',
                'placeholder'   =>  'backend.sales_orders.make_id',
                'required'      =>  true,
                'disabled'      =>  true,
                'options'       =>  [
                ]
            ],
            //部門
            'departments_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'departments_id',
                'text'          =>  'backend.sales_orders.departments_id',
                'placeholder'   =>  'backend.sales_orders.departments_id',
                'required'      =>  false,
                'disabled'      =>  true,
                'options'       =>  [
                ]
            ],
            //客戶
            'customers_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'customers_id',
                'text'          =>  'backend.sales_orders.customers_id',
                'placeholder'   =>  'backend.sales_orders.customers_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //聯絡人
            'customer_contacts_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'customer_contacts_id',
                'text'          =>  'backend.sales_orders.customer_contacts_id',
                'placeholder'   =>  'backend.sales_orders.customer_contacts_id',
                'required'      =>  false,
                'options'       =>  [
                ]
            ],
            'customer_staff_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'customer_staff_id',
                'text'          =>  'backend.sales_orders.customer_staff_id',
                'placeholder'   =>  'backend.sales_orders.customer_staff_id',
                'required'      =>  false,
                'options'       =>  [
                ]
            ],
            //連絡電話
            'customer_phone'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'customer_phone',
                'text'          =>  'backend.sales_orders.customer_phone',
                'placeholder'   =>  'backend.sales_orders.customer_phone',
                'required'      =>  false,
                'disabled'      =>  true,
            ],
            'customer_address'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'customer_address',
                'text'          =>  'backend.sales_orders.customer_address',
                'placeholder'   =>  'backend.sales_orders.customer_address',
                'required'      =>  false,
                'disabled'      =>  true,
            ],
            //專案名稱
            'name'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'name',
                'text'          =>  'backend.sales_orders.name',
                'placeholder'   =>  'backend.sales_orders.name',
                'required'      =>  true,
            ],
            //幣別
            'currencies_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'currencies_id',
                'text'          =>  'backend.sales_orders.currencies_id',
                'placeholder'   =>  'backend.sales_orders.currencies_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //發票
            'invoice_types_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'invoice_types_id',
                'text'          =>  'backend.sales_orders.invoice_types_id',
                'placeholder'   =>  'backend.sales_orders.invoice_types_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //發票
            'invoice_methods_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'invoice_methods_id',
                'text'          =>  'backend.sales_orders.invoice_methods_id',
                'placeholder'   =>  'backend.sales_orders.invoice_methods_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //發票
            'invoice_categories_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'invoice_categories_id',
                'text'          =>  'backend.sales_orders.invoice_categories_id',
                'placeholder'   =>  'backend.sales_orders.invoice_categories_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //匯率
            'exchange'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'exchange',
                'text'          =>  'backend.sales_orders.exchange',
                'placeholder'   =>  'backend.sales_orders.exchange',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //未稅金額
            'amount'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'amount',
                'text'          =>  'backend.sales_orders.amount',
                'placeholder'   =>  'backend.sales_orders.amount',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //稅金
            'tax'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'tax',
                'text'          =>  'backend.sales_orders.tax',
                'placeholder'   =>  'backend.sales_orders.tax',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //總額
            'total_amount'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'total_amount',
                'text'          =>  'backend.sales_orders.total_amount',
                'placeholder'   =>  'backend.sales_orders.total_amount',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //未稅金額(本未必)
            'main_amount'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'main_amount',
                'text'          =>  'backend.sales_orders.main_amount',
                'placeholder'   =>  'backend.sales_orders.main_amount',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //稅金(本位幣)
            'main_tax'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'main_tax',
                'text'          =>  'backend.sales_orders.main_tax',
                'placeholder'   =>  'backend.sales_orders.main_tax',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //總額(本位幣)
            'main_total_amount'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'main_total_amount',
                'text'          =>  'backend.sales_orders.main_total_amount',
                'placeholder'   =>  'backend.sales_orders.main_total_amount',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //附加檔案
            'file'   =>  [
                'tag'           =>  'input',
                'type'          =>  'file',
                'name'          =>  'file',
                'text'          =>  'backend.sales_orders.file',
                'placeholder'   =>  'backend.sales_orders.file',
                'required'      =>  false,
            ],
            //備註
            'remark'   =>  [
                'tag'           =>  'textarea',
                'name'          =>  'remark',
                'text'          =>  'backend.sales_orders.remark',
                'placeholder'   =>  'backend.sales_orders.remark',
                'required'      =>  false,
            ],
            /*-------------------------表身---------------------- */
            'items' =>  [
                //產品編號
                'products_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'items[$i][products_id]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.products_id',
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
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.type',
                    'value'         =>  1,
                    'required'      =>  false,
                ],
                //品名
                'name'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][name]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.name',
                    'required'      =>  false,
                    'disabled'      =>  true,
                ],
                //規格
                'standard'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][standard]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.standard',
                    'required'      =>  false,
                    'disabled'      =>  true,
                ],
                //尺寸
                'size'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][size]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.size',
                    'required'      =>  false,
                    'disabled'      =>  true,
                ],
                //數量
                'count'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][count]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.count',
                    'value'         =>  0,
                    'required'      =>  true,
                ],
                //單位
                'unit'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][unit]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.unit',
                    'required'      =>  false,
                ],
                //單價
                'unit_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][unit_amount]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.unit_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                ],
                //未稅金額
                'amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][amount]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.amount',
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
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.tax',
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
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.total_amount',
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
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.main_amount',
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
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.main_tax',
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
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.main_total_amount',
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
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.description',
                    'required'      =>  false,
                ],
                //備註
                'remark'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][remark]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.*.remark',
                    'required'      =>  false,
                ],
                //附加檔案
                'file'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'file',
                    'name'          =>  'items[$i][file]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.file',
                    'required'      =>  false,
                ],
                'delivery_date'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'items[$i][delivery_date]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.sales_orders.sales_order_items.delivery_date',
                    'required'      =>  false,
                ],
            ],
        ],
    ];

    public $show = false;
    public function __construct(
        public OrderService $OrderService,
        public StaffService $StaffService,
        public CustomerService $CustomerService,
        public DepartmentService $DepartmentService,
        public ProductService $ProductService,
        public CompanyService $CompanyService,
        public CurrencyService $CurrencyService,
        public SystemSettingsService $SystemSettingsService,
        public QuoteOrderService $QuoteOrderService,
    ) {
        $this->form['fields']['staff_id']['options'] = $this->form['fields']['make_id']['options'] = $this->form['fields']['customer_staff_id']['options'] = $this->StaffService->select();
        $this->form['fields']['customers_id']['options'] = $this->CustomerService->select();
        $this->form['fields']['departments_id']['options'] = $this->DepartmentService->select();
        $this->form['fields']['companies_id']['options'] = $this->CompanyService->select();
        $this->form['fields']['companies_id']['value'] = $this->SystemSettingsService->getSetting('company');
        $this->form['fields']['currencies_id']['options'] = $this->CurrencyService->select();
        $this->form['fields']['items']['products_id']['options'] = $this->ProductService->select();
        $this->form['fields']['sourceable_type']['options'] = [
            [
                'value' =>  \App\Models\SalesQuoteOrder::class,
                'name'  =>  '報價單',
            ]
        ];
        $this->form['fields']['invoice_types_id']['options'] = InvoiceType::all()->map(function($item){
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
        $this->form['back'] =   route('backend.sales.order.index');
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
            }else if(request()->action == 'sourceable_type') {
                return response()->json([   
                    "data"  =>  $this->QuoteOrderService->select([
                        'sales_quote_order_statuses_id'    =>  1,
                    ])
                ]);
            }else if(request()->action == 'sourceable_id') {
                return response()->json([   
                    "data"  =>  $this->QuoteOrderService->getSalesQuoteOrder(request()->id),
                ]);
            }else if(request()->action == 'product') {
                $staff = $this->ProductService->getProduct(request()->id);
                return response()->json([
                    "data"  =>  [
                        'product_name'      =>  $staff->product_name,
                        'product_standard'  =>  $staff->product_standard,
                        'size'              =>  $staff->size,
                    ]
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
                            'invoice_tax_method'    => $bank->invoice_tax_method
                        ],
                        'currencies_id' =>  $customer->currency_id,
                        'exchange'  =>  (float)$customer->currency->exchange,
                        'staff_id' =>  $customer->staff_id,
                    ]
                ]);
            }
            return response()->json([
                "data"  =>  $this->OrderService->index([])
            ]);
        }
        return view('backend.sales.order.index');
    }

    public function formDataHandle($detail) {
        foreach($detail as $field => $value) {
            if(in_array($field, ['items'])) {
                foreach ($this->form['fields'][$field] as $key => $item) {
                    if(isset($this->form['fields'][$field][$key])) {
                        if($this->show) {
                            $this->form['fields'][$field][$key]['disabled']  =   true;
                        }
                    }
                }
            }else if($field == 'sourceable'){
                if($value) {
                    $this->form['fields']['source_no']['value']  =   $value['no'];
                    $source_name = '';
                    switch ($detail['sourceable_type']) {
                        case \App\Models\SalesQuoteOrder::class:
                            $source_name = '報價單';
                            break;
                    }
                    $this->form['fields']['source_type']['value']  =   $source_name;
                    if($this->show) {
                        $this->form['fields']['source_no']['disabled']  =   true;
                        $this->form['fields']['source_type']['disabled']  =   true;
                    }
                }
            }else if($field == 'customers_id'){
                $this->form['fields'][$field]['value']  =   $value;
                if($this->show) {
                    $this->form['fields'][$field]['disabled']  =   true;
                }
                $customer = $this->CustomerService->getCustomer($value);
                $this->form['fields']['customer_contacts_id']['options'] =  $customer->customer_contacts->map(function($item){
                    return [
                        'value' =>  $item->id,
                        'name'  =>  $item->name,
                    ];
                })->toArray();
            }else if(in_array($field, ['contact'])){
                $this->form['fields']['phone']['value'] = $value['mobile']??'';
            }else if(isset($this->form['fields'][$field])) {
                $this->form['fields'][$field]['value']  =   $value;
                if($this->show) {
                    $this->form['fields'][$field]['disabled']  =   true;
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
        $this->form['fields']['make_id']['value'] = auth()->user()->staff?->id;
        $data['form']   =   $this->form;
        $data['tax_percentage'] =   $this->SystemSettingsService->getSetting('tax_percentage')??0;
        $data['decimal_point'] =   $this->SystemSettingsService->getSetting('decimal_point')??0;
        return view('backend.sales.order.form', $data);
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
        return view('backend.sales.order.form',$data);
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
        return view('backend.sales.order.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->OrderService->update($request->all(),$id);
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
