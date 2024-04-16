<?php

namespace Cpkm\ErpStock\Http\Controllers\Backend\Restock;

use App\Http\Controllers\Backend\StaffController;
use Illuminate\Http\Request;
use App\Service\InquiryOrderService;
use App\Service\SubscriptionOrderService;
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
use App\Service\PurchaseOrderService;
use App\Http\Requests\Backend\SalesQuoteOrder\StoreRequest;
use App\Http\Requests\Backend\SalesQuoteOrder\UpdateRequest;

class PurchaseOrderController extends StaffController
{
    protected $form = [
        'name'      =>  'purchase_order',
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
                'text'          =>  'backend.purchase_orders.date',
                'placeholder'   =>  'backend.purchase_orders.date',
                'required'      =>  true,
            ],
            //單號
            'no'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'no',
                'text'          =>  'backend.purchase_orders.no',
                'placeholder'   =>  'backend.purchase_orders.no',
                'required'      =>  false,
                'disabled'      =>  true,
            ],
            //公司別
            'companies_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'companies_id',
                'text'          =>  'backend.purchase_orders.companies_id',
                'placeholder'   =>  'backend.purchase_orders.companies_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            'purchase_order_statuses_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'purchase_order_statuses_id',
                'text'          =>  'backend.purchase_orders.purchase_order_statuses_id',
                'placeholder'   =>  'backend.purchase_orders.purchase_order_statuses_id',
                'required'      =>  false,
                'options'       =>  [
                ]
            ],
            //廠商
            'factory_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'factory_id',
                'text'          =>  'backend.purchase_orders.factory_id',
                'placeholder'   =>  'backend.purchase_orders.factory_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //來源單號
            'sourceable_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'sourceable_id',
                'text'          =>  'backend.purchase_orders.sourceable_id',
                'placeholder'   =>  'backend.purchase_orders.sourceable_id',
                'required'      =>  false,
                'disabled'      =>  false,
                'options'       =>  [
                ]
            ],
            //來源類別
            'sourceable_type'   =>  [
                'tag'           =>  'select',
                'name'          =>  'sourceable_type',
                'text'          =>  'backend.purchase_orders.sourceable_type',
                'placeholder'   =>  'backend.purchase_orders.sourceable_type',
                'required'      =>  false,
                'disabled'      =>  false,
                'options'       =>  [
                ]
            ],
            //人員
            'staff_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'staff_id',
                'text'          =>  'backend.purchase_orders.staff_id',
                'placeholder'   =>  'backend.purchase_orders.staff_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //部門
            'departments_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'departments_id',
                'text'          =>  'backend.purchase_orders.departments_id',
                'placeholder'   =>  'backend.purchase_orders.departments_id',
                'required'      =>  false,
                'disabled'      =>  true,
                'options'       =>  [
                ]
            ],
            
            //聯絡人
            'factory_contact_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'factory_contact_id',
                'text'          =>  'backend.purchase_orders.factory_contact_id',
                'placeholder'   =>  'backend.purchase_orders.factory_contact_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            'factory_staff_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'factory_staff_id',
                'text'          =>  'backend.purchase_orders.factory_staff_id',
                'placeholder'   =>  'backend.purchase_orders.factory_staff_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //連絡電話
            'factory_phone'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'factory_phone',
                'text'          =>  'backend.purchase_orders.factory_phone',
                'placeholder'   =>  'backend.purchase_orders.factory_phone',
                'required'      =>  false,
                'disabled'      =>  true,
            ],
            'factory_address'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'factory_address',
                'text'          =>  'backend.purchase_orders.factory_address',
                'placeholder'   =>  'backend.purchase_orders.factory_address',
                'required'      =>  false,
                'disabled'      =>  true,
            ],
            //專案名稱
            'name'   =>  [
                'tag'           =>  'input',
                'type'          =>  'text',
                'name'          =>  'name',
                'text'          =>  'backend.purchase_orders.name',
                'placeholder'   =>  'backend.purchase_orders.name',
                'required'      =>  true,
            ],
            //幣別
            'currencies_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'currencies_id',
                'text'          =>  'backend.purchase_orders.currencies_id',
                'placeholder'   =>  'backend.purchase_orders.currencies_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //發票
            'invoice_types_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'invoice_types_id',
                'text'          =>  'backend.purchase_orders.invoice_types_id',
                'placeholder'   =>  'backend.purchase_orders.invoice_types_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //發票
            'invoice_methods_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'invoice_methods_id',
                'text'          =>  'backend.purchase_orders.invoice_methods_id',
                'placeholder'   =>  'backend.purchase_orders.invoice_methods_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            'factory_payment_method'   =>  [
                'tag'           =>  'select',
                'name'          =>  'factory_payment_method',
                'text'          =>  'backend.purchase_orders.factory_payment_method',
                'placeholder'   =>  'backend.purchase_orders.factory_payment_method',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            'factory_payment_day'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'factory_payment_day',
                'text'          =>  'backend.purchase_orders.factory_payment_day',
                'placeholder'   =>  'backend.purchase_orders.factory_payment_day',
                'value'         =>  0,
                'required'      =>  true,
                'readonly'      =>  true,
            ],
            //發票
            'invoice_categories_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'invoice_categories_id',
                'text'          =>  'backend.purchase_orders.invoice_categories_id',
                'placeholder'   =>  'backend.purchase_orders.invoice_categories_id',
                'required'      =>  true,
                'options'       =>  [
                ]
            ],
            //匯率
            'exchange'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'exchange',
                'text'          =>  'backend.purchase_orders.exchange',
                'placeholder'   =>  'backend.purchase_orders.exchange',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //未稅金額
            'amount'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'amount',
                'text'          =>  'backend.purchase_orders.amount',
                'placeholder'   =>  'backend.purchase_orders.amount',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //稅金
            'tax'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'tax',
                'text'          =>  'backend.purchase_orders.tax',
                'placeholder'   =>  'backend.purchase_orders.tax',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //總額
            'total_amount'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'total_amount',
                'text'          =>  'backend.purchase_orders.total_amount',
                'placeholder'   =>  'backend.purchase_orders.total_amount',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //未稅金額(本未必)
            'main_amount'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'main_amount',
                'text'          =>  'backend.purchase_orders.main_amount',
                'placeholder'   =>  'backend.purchase_orders.main_amount',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //稅金(本位幣)
            'main_tax'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'main_tax',
                'text'          =>  'backend.purchase_orders.main_tax',
                'placeholder'   =>  'backend.purchase_orders.main_tax',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //總額(本位幣)
            'main_total_amount'   =>  [
                'tag'           =>  'input',
                'type'          =>  'number',
                'name'          =>  'main_total_amount',
                'text'          =>  'backend.purchase_orders.main_total_amount',
                'placeholder'   =>  'backend.purchase_orders.main_total_amount',
                'value'         =>  0,
                'required'      =>  true,
                'disabled'      =>  true,
            ],
            //製單人員
            'make_id'   =>  [
                'tag'           =>  'select',
                'name'          =>  'make_id',
                'text'          =>  'backend.subscription_orders.make_id',
                'placeholder'   =>  'backend.subscription_orders.make_id',
                'required'      =>  true,
                'disabled'      =>  true,
                'options'       =>  [
                ]
            ],
            //附加檔案
            'file'   =>  [
                'tag'           =>  'input',
                'type'          =>  'file',
                'name'          =>  'file',
                'text'          =>  'backend.purchase_orders.file',
                'placeholder'   =>  'backend.purchase_orders.file',
                'required'      =>  false,
            ],
            //備註
            'remark'   =>  [
                'tag'           =>  'textarea',
                'name'          =>  'remark',
                'text'          =>  'backend.purchase_orders.remark',
                'placeholder'   =>  'backend.purchase_orders.remark',
                'required'      =>  false,
            ],
            /*-------------------------表身---------------------- */
            'items' =>  [
                //產品編號
                'products_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'items[$i][products_id]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.products_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                ],
                //品名
                'name'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][name]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.name',
                    'required'      =>  false,
                    'disabled'      =>  true,
                ],
                //規格
                'standard'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][standard]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.standard',
                    'required'      =>  false,
                    'disabled'      =>  true,
                ],
                //尺寸
                'size'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][size]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.size',
                    'required'      =>  false,
                    'disabled'      =>  true,
                ],
                //數量
                'count'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][count]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.count',
                    'value'         =>  0,
                    'required'      =>  true,
                ],
                //單位
                'unit'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][unit]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.unit',
                    'required'      =>  false,
                ],
                //單價
                'unit_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][unit_amount]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.unit_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                ],
                //未稅金額
                'amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][amount]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.amount',
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
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.tax',
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
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.total_amount',
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
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.main_amount',
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
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.main_tax',
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
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.main_total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                ],
                'need_date'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'items[$i][need_date]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.need_date',
                    'required'      =>  false,
                ],
                //內部描述
                'description'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][description]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.description',
                    'required'      =>  false,
                ],
                //備註
                'remark'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][remark]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.remark',
                    'required'      =>  false,
                ],
                //訂購單號                
                'sales_purchase_orders_id'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][sales_purchase_orders_id]',
                    'text'          =>  '',
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.*.sales_purchase_orders_id',
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
                    'placeholder'   =>  'backend.purchase_orders.purchase_order_items.file',
                    'required'      =>  false,
                ],
            ],
        ],
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
        public InquiryOrderService $InquiryOrderService,
        public SubscriptionOrderService $SubscriptionOrderService,
        public PurchaseOrderService $PurchaseOrderService,
    ) {
        $this->form['fields']['staff_id']['options'] = $this->StaffService->select();
        $this->form['fields']['factory_staff_id']['options'] = $this->form['fields']['make_id']['options'] = $this->form['fields']['staff_id']['options'];
        $this->form['fields']['factory_id']['options'] = $this->CustomerService->select(2);
        $this->form['fields']['departments_id']['options'] = $this->DepartmentService->select();
        $this->form['fields']['companies_id']['options'] = $this->CompanyService->select();
        $this->form['fields']['companies_id']['value'] = $this->SystemSettingsService->getSetting('company');
        $this->form['fields']['currencies_id']['options'] = $this->CurrencyService->select();
        $this->form['fields']['items']['products_id']['options'] = $this->ProductService->select();
        $this->form['fields']['sourceable_type']['options'] = [
            [
                'value' =>  \App\Models\SubscriptionOrder::class,
                'name'  =>  '請購單',
            ],
            [
                'value' =>  \App\Models\InquiryOrder::class,
                'name'  =>  '詢價單',
            ],
        ];
        $this->form['fields']['factory_payment_method']['options'] = collect(__('payment_method'))->map(function($item, $key) {
            return [
                'value' =>  $key,
                'name'  =>  $item,
            ];
        })->toArray();
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
        $this->form['back'] =   route('backend.purchase_orders.index');
        
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
                    "data"  =>  [
                        'product_name'      =>  $product->product_name,
                        'product_standard'  =>  $product->product_standard,
                        'size'              =>  $product->size,
                        'stock'             =>  $product->stocks->map(function($stock){
                            return [
                                'count' =>  $stock->lists->sum('count'),
                            ];
                        })->sum('count'),
                        'test'              =>  $product->test,
                    ]
                ]);
            }else if(request()->action == 'sourceable_type') {
                return response()->json([   
                    "data"  =>  (request()->type == \App\Models\SubscriptionOrder::class)?$this->SubscriptionOrderService->select([
                        'subscription_order_statuses_id'    =>  1,
                    ]):$this->InquiryOrderService->select([
                        'inquiry_order_statuses_id'    =>  1,
                    ])
                ]);
            }else if(request()->action == 'sourceable_id') {
                return response()->json([   
                    "data"  =>  (request()->type == \App\Models\SubscriptionOrder::class)?$this->SubscriptionOrderService->getSubscriptionOrder(request()->id):$this->InquiryOrderService->getInquiryOrder(request()->id),
                ]);
            }else if(request()->action == 'factory') {
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
            return response()->json([
                "data"  =>  $this->PurchaseOrderService->index(request()->extraParam??[])
            ]);
        }
        $data['fields'] = $this->form['fields'];
        return view('backend.purchase_orders.index', $data);
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
                $this->form['fields']['sourceable_id']['options']  =   $this->SubscriptionOrderService->select();
                switch ($detail['sourceable_type']) {
                    case \App\Models\SubscriptionOrder::class:
                        break;
                }
                // $this->form['fields']['sourceable_type']['value']  =   $source_name;
                $this->form['fields']['sourceable_id']['disabled']  =   true;
                $this->form['fields']['sourceable_type']['disabled']  =   true;
            }else if($field == 'factory_id'){
                $this->form['fields'][$field]['value']  =   $value;
                if($this->show) {
                    $this->form['fields'][$field]['disabled']  =   true;
                }
                $customer = $this->CustomerService->getCustomer($value);
                $this->form['fields']['factory_contact_id']['options'] =  $customer->customer_contacts->map(function($item){
                    return [
                        'value' =>  $item->id,
                        'name'  =>  $item->name,
                    ];
                })->toArray();
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
        $this->form['action']   =   route('backend.purchase_orders.store');
        $this->form['title']    =   '新增採購單';
        $this->form['fields']['make_id']['value']   =   auth()->user()->staff?->id;
        $data['form']   =   $this->form;
        $data['tax_percentage'] =   $this->SystemSettingsService->getSetting('tax_percentage')??0;
        $data['decimal_point'] =   $this->SystemSettingsService->getSetting('decimal_point')??0;
        return view('backend.purchase_orders.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->PurchaseOrderService->store($request->all());
        return redirect()->route('backend.purchase_orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['detail'] = $this->PurchaseOrderService->getPurchaseOrder($id);
        $this->form['title']    =   '採購單詳情';
        $this->show = true;
        $this->formDataHandle($data['detail']->toArray());
        $data['form']   =   $this->form;
        $data['table']  =   'purchase_orders';
        $data['show']   =   $this->show;
        return view('backend.purchase_orders.form',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['detail'] = $this->PurchaseOrderService->getPurchaseOrder($id);
        if($data['detail']->close) {
            return redirect()->route('backend.purchase_orders.show', ['purchase_order' => $id]);
        }
        $this->form['title']    =   '編輯採購單';
        $this->form['action']   =   route('backend.purchase_orders.update',['purchase_order'=>$id]);
        $this->form['method']   =   "PUT";
        $this->formDataHandle($data['detail']->toArray());
        $data['form']   =   $this->form;
        $data['tax_percentage'] =   $this->SystemSettingsService->getSetting('tax_percentage')??0;
        $data['decimal_point'] =   $this->SystemSettingsService->getSetting('decimal_point')??0;
        return view('backend.purchase_orders.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->PurchaseOrderService->update($request->all(),$id);
        return redirect()->route('backend.purchase_orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->PurchaseOrderService->delete($id);
        return response()->json(['message' => __('delete').__('success')]);
    }
}
