<?php

return [
    'pre_purchase_order'    =>  [
        'staff'     =>  \App\Service\StaffService::class,
        'customer'  =>  \App\Service\CustomerService::class,
        'product'   =>  \App\Service\ProductService::class,
        'models'    =>  [
            'staff'     =>  \App\Models\Staff::class,
            'product'   =>  \App\Models\Product::class,
            'department'=>  \App\Models\Department::class,
        ],
        'model' =>  Cpkm\ErpStock\Models\Restock\PrePurchaseOrder::class,
        'service'   => Cpkm\ErpStock\Services\Restock\PrePurchaseOrderService::class,
        'form'  =>  [
            'name'  =>  'pre_purchase_order',
            'action'=>  '',
            'back'  =>  '',
            'method'=>  "POST",
            'form'  =>  [
                [
                    'class' =>  'row',
                    'col'   =>  [
                        [
                            'class' =>  'col-3',
                            'col'   =>  [
                                [
                                    'class' =>  'fields',
                                    'field' =>  'date',
                                ]
                            ]
                        ],
                        [
                            'class' =>  'col-3',
                            'col'   =>  [
                                [
                                    'class' =>  'fields',
                                    'field' =>  'no',
                                ]
                            ]
                        ],
                        [
                            'class' =>  'col-3',
                            'col'   =>  [
                                [
                                    'class' =>  'fields',
                                    'field' =>  'companies_id',
                                ]
                            ]
                        ],
                        [
                            'class' =>  'col-3',
                            'col'   =>  [
                                [
                                    'class' =>  'fields',
                                    'field' =>  'sourceable_type',
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    'class' =>  'row',
                    'col'   =>  [
                        [
                            'class' =>  'col-3',
                            'col'   =>  [
                                [
                                    'class' =>  'fields',
                                    'field' =>  'sourceable_id',
                                ]
                            ]
                        ],
                        [
                            'class' =>  'col-9',
                            'col'   =>  [
                                [
                                    'class' =>  'fields',
                                    'field' =>  'name',
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    'class' =>  'row',
                    'col'   =>  [
                        [
                            'class' =>  'col-3',
                            'col'   =>  [
                                [
                                    'class' =>  'fields',
                                    'field' =>  'staff_id',
                                ]
                            ]
                        ],
                        [
                            'class' =>  'col-3',
                            'col'   =>  [
                                [
                                    'class' =>  'fields',
                                    'field' =>  'departments_id',
                                ]
                            ]
                        ],
                        [
                            'class' =>  'col-3',
                            'col'   =>  [
                                [
                                    'class' =>  'fields',
                                    'field' =>  'make_id',
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    'class' =>  'row',
                    'col'   =>  [
                        [
                            'class' =>  'col-12',
                            'col'   =>  [
                                [
                                    'class' =>  'fields',
                                    'field' =>  'remark',
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    'class' =>  'row',
                    'col'   =>  [
                        [
                            'class' =>  'col-6',
                            'col'   =>  [
                                [
                                    'class' =>  'fields',
                                    'field' =>  'file',
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    'class' =>  'row',
                    'col'   =>  [
                        [
                            'class' =>  'col-12',
                            'col'   =>  [
                                [
                                    'class' =>  'fields',
                                    'field' =>  'items',
                                ]
                            ]
                        ],
                    ]
                ],
            ],
            'fields'    =>  [
                //日期
                'date'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'date',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.date',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.date',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ]
                ],
                //單號
                'no'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'no',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.no',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.no',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ]
                ],
                //公司別
                'companies_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'companies_id',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.companies_id',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.companies_id',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\CompanyService::class,
                ],
                //狀態
                'pre_purchase_order_statuses_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'pre_purchase_order_statuses_id',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_statuses_id',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_statuses_id',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ]
                ],
                //來源單號
                'sourceable_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'sourceable_id',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.sourceable_id',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.sourceable_id',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                    'options'       =>  [

                    ]
                ],
                //來源類別
                'sourceable_type'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'sourceable_type',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.sourceable_type',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.sourceable_type',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                    'options'       =>  [

                    ]
                ],
                //專案名稱
                'name'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'name',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.name',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.name',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ]
                ],
                //人員
                'staff_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'staff_id',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.staff_id',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.staff_id',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\StaffService::class,
                ],
                //部門
                'departments_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'departments_id',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.departments_id',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.departments_id',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\DepartmentService::class,
                ],
                //製單人員
                'make_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'make_id',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.make_id',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.make_id',
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\StaffService::class,
                ],
                //備註
                'remark'   =>  [
                    'tag'           =>  'textarea',
                    'name'          =>  'remark',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.remark',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.remark',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ]
                ],
                //附加檔案
                'file'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'file',
                    'name'          =>  'file',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.file',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.file',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ]
                ],
                //產品編號
                'items[][products_id]'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'items[$i][products_id]',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.products_id',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.products_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules' =>  [
                        
                    ],
                    'source'    =>  \App\Service\ProductService::class,
                    'templateResult' =>  'productTemplateResult',
                    'templateSelection' =>  'productTemplateSelection',
                    'class' =>  'product-item',
                ],
                'items[][factory_id]'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'items[$i][factory_id]',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.factory_id',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.factory_id',
                    'required'      =>  false,
                    'options'       =>  [
                    ],
                    'rules' =>  [
                        
                    ],
                ],
                //品名
                'items[][name]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][name]',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.name',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.name',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //規格
                'items[][standard]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][standard]',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.standard',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.standard',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //尺寸
                'items[][size]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][size]',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.size',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.size',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //數量
                'items[][count]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][count]',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.count',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.count',
                    'value'         =>  0,
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                'items[][pre_count]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][pre_count]',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.pre_count',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.pre_count',
                    'value'         =>  0,
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //單位
                'items[][unit]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][unit]',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.unit',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.unit',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                'items[][need_date]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'items[$i][need_date]',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.need_date',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.need_date',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],
                //內部描述
                'items[][description]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][description]',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.description',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.description',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],
                //備註
                'items[][remark]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][remark]',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.remark',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.remark',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],
                //附加檔案
                'items[][file]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'file',
                    'name'          =>  'items[$i][file]',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.file',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.file',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][product_stock]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'product_stock_$i',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.product_stock',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.product_stock',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][already_count]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'already_count_$i',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.already_count',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.already_count',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][yet_count]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'yet_count_$i',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.yet_count',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.yet_count',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][income_count]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'income_count_$i',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.income_count',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.income_count',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][purchase_orders_id]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'purchase_orders_id_$i',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.purchase_orders_id',
                    'placeholder'   =>  'erp-stock::backend.pre_purchase_orders.pre_purchase_order_items.*.purchase_orders_id',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],
                
                /*-------------------------表身---------------------- */
                'items' =>  [
                    'tag'           =>  'multiple_table',
                    'name'          =>  'items',
                    'text'          =>  'erp-stock::backend.pre_purchase_orders.items',
                    'key'           =>  'id',
                    'info'          =>  [],
                    'value'         =>  [],
                    'rules' =>  [
                        
                    ],
                    'parameters'    =>  [
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][products_id]',
                            'width' =>  '250px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][name]'
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][standard]'
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][size]'
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][count]'
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][unit]'
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][product_stock]'
                        ],
                        
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][need_date]'
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][pre_count]'
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][factory_id]',
                            'width' =>  '250px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][description]'
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][remark]'
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][already_count]'
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][yet_count]'
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][income_count]'
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][purchase_orders_id]'
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][file]'
                        ],
                    ],
                    
                ],
            ],
        ]
    ],
    'sales_quote_orders'  =>  [
        'staff'     =>  \App\Service\StaffService::class,
        'customer'  =>  \App\Service\CustomerService::class,
        'product'   =>  \App\Service\ProductService::class,
        'models'    =>  [
            'staff'     =>  \App\Models\Staff::class,
            'product'   =>  \App\Models\Product::class,
            'department'=>  \App\Models\Department::class,
        ],
        'model' =>  Cpkm\ErpStock\Models\Sales\QuoteOrder::class,
        'service'   => Cpkm\ErpStock\Service\Sales\QuoteOrderService::class,
        'form'  =>  [
            'name'  =>  'sales_quote_order',
            'action'=>  '',
            'back'  =>  '',
            'method'=>  "POST",
            'tabs'  =>  [
                [
                    'key'   =>  'basic_data',
                    'tab'   =>  [
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'date',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'no',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'companies_id',
                                        ]
                                    ]
                                ],
                                
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customers_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'sourceable_type',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'sourceable_id',
                                        ]
                                    ]
                                ],
                                
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'project_managements_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'quote_start_date',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'quote_end_date',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'delivery_date',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'staff_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'departments_id',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'make_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customer_contacts_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customer_phone',
                                        ]
                                    ]
                                ],
                                
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customer_address',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'invoice_types_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'currencies_id',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'exchange',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'amount',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'tax',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'total_amount',
                                        ]
                                    ]
                                ],
                            ],
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'main_amount',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'main_tax',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'main_total_amount',
                                        ]
                                    ]
                                ],
                            ],
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'file',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-xl-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'slots',
                                            'field' =>  'options',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'items',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'key'   =>  'remark',
                    'tab'   =>  [
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-md-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'remark',
                                        ]
                                    ]
                                ],
                            ]
                        ]
                    ],
                ]
            ],
            'fields'    =>  [
                //日期
                'date'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'date',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.date',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.date',
                    'required'      =>  true,
                    'value'         =>  date('Y-m-d'),
                    'rules' =>  [
                        
                    ]
                ],
                //單號
                'no'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'no',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.no',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.no',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ]
                ],
                //公司別
                'companies_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'companies_id',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.companies_id',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.companies_id',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\CompanyService::class,
                ],
                //狀態
                'sales_quote_order_statuses_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'sales_quote_order_statuses_id',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_statuses_id',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_statuses_id',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ]
                ],
                //客戶
                'customers_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'customers_id',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.customers_id',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.customers_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules'         =>  [

                    ],
                ],
                //來源單號
                'sourceable_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'sourceable_id',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sourceable_id',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sourceable_id',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                    'options'       =>  [

                    ]
                ],
                //來源類別
                'sourceable_type'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'sourceable_type',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sourceable_type',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sourceable_type',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                    'options'       =>  [

                    ]
                ],
                //報價起始日
                'quote_start_date'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'quote_start_date',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.quote_start_date',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.quote_start_date',
                    'required'      =>  true,
                    'rules'         =>  [
                        
                    ],
                ],
                //報價失效日
                'quote_end_date'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'quote_end_date',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.quote_end_date',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.quote_end_date',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                ],
                //預定交貨日
                'delivery_date'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'delivery_date',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.delivery_date',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.delivery_date',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                ],
                //人員
                'staff_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'staff_id',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.staff_id',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.staff_id',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\StaffService::class,
                ],
                //部門
                'departments_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'departments_id',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.departments_id',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.departments_id',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\DepartmentService::class,
                ],
                //聯絡人
                'customer_contacts_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'customer_contacts_id',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.customer_contacts_id',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.customer_contacts_id',
                    'required'      =>  false,
                    'options'       =>  [
                    ],
                    'rules'         =>  [

                    ]
                ],
                //連絡電話
                'customer_phone'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'customer_phone',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.customer_phone',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.customer_phone',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules'         =>  [

                    ]
                ],
                'customer_address'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'customer_address',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.customer_address',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.customer_address',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules'         =>  [

                    ]
                ],
                //專案資料
                'project_managements_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'project_managements_id',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.project_managements_id',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.project_managements_id',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\ProjectManagementService::class,
                ],
                //發票
                'invoice_types_id'   =>  [
                    'tag'           =>  'radio',
                    'name'          =>  'invoice_types_id',
                    'direction'     =>  'horizontal',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.invoice_types_id',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.invoice_types_id',
                    'required'      =>  true,
                    'options'       =>  [
                        
                    ],
                    'rules'         =>  [
                        
                    ],
                ],
                //幣別
                'currencies_id'   =>  [
                    'tag'           =>  'currency-select',
                    'name'          =>  'currencies_id',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.currencies_id',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.currencies_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules'         =>  [
                        
                    ],
                ],
                //匯率
                'exchange'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'exchange',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.exchange',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.exchange',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules'         =>  [
                        
                    ],
                ],
                //製單人員
                'make_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'make_id',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.make_id',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.make_id',
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\StaffService::class,
                ],
                //未稅金額
                'amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'amount',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.amount',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //稅金
                'tax'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'tax',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.tax',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //總額
                'total_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'total_amount',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //未稅金額(本未必)
                'main_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'main_amount',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.main_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.main_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //稅金(本位幣)
                'main_tax'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'main_tax',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.main_tax',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.main_tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //總額(本位幣)
                'main_total_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'main_total_amount',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.main_total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.main_total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //備註
                'remark'   =>  [
                    'tag'           =>  'textarea',
                    'name'          =>  'remark',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.remark',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.remark',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ]
                ],
                //附加檔案
                'file'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'file',
                    'name'          =>  'file',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.file',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.file',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ]
                ],
                //產品編號
                'items[][products_id]'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'items[$i][products_id]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.products_id',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.products_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules' =>  [
                        
                    ],
                    'templateResult' =>  'productTemplateResult',
                    'templateSelection' =>  'productTemplateSelection',
                    'class' =>  'product-item',
                    'source'    =>  \App\Service\ProductService::class,
                ],
                //品名
                'items[][name]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][name]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.name',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.name',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //規格
                'items[][standard]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][standard]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.standard',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.standard',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //尺寸
                'items[][size]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][size]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.size',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.size',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //數量
                'items[][count]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][count]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.count',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.count',
                    'value'         =>  0,
                    'int'           =>  true,
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //單位
                'items[][unit]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][unit]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.unit',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.unit',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //單價
                'items[][unit_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][unit_amount]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.unit_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.unit_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //未稅金額
                'items[][amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][amount]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.amount',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //稅金
                'items[][tax]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][tax]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.tax',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //總額
                'items[][total_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][total_amount]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //未稅金額(本未必)
                'items[][main_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_amount]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.main_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.main_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //稅金(本位幣)
                'items[][main_tax]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_tax]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.main_tax',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.main_tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //總額(本位幣)
                'items[][main_total_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_total_amount]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.main_total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.main_total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //內部描述
                'items[][description]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][description]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.description',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.description',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],
                //備註
                'items[][remark]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][remark]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.remark',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.remark',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],
                //附加檔案
                'items[][file]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'file',
                    'name'          =>  'items[$i][file]',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.file',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.file',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][product_number]'   =>  [
                    'tag'           =>  'slot',
                    'name'          =>  'product_number_$i',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.product_number',
                    'placeholder'   =>  'erp-stock::backend.sales_quote_orders.sales_quote_order_items.*.product_number',
                    'required'      =>  false,
                    'value'         =>  '
                        <div id="product-number-$i"></div>
                        <input type="hidden" name="items[$i][product_number]">
                        <input type="hidden" name="items[$i][type]" value="1">
                        <a type="button" class="btn btn-sm btn-success makeNo" data-bs-toggle="modal" data-bs-target="#product-number" href="#" data-target="product-number-$i" data-item="$i">取號</a>
                    ',
                    'rules' =>  [
                        
                    ],
                ],
                
                /*-------------------------表身---------------------- */
                'items' =>  [
                    'tag'           =>  'multiple_table',
                    'name'          =>  'items',
                    'text'          =>  'erp-stock::backend.sales_quote_orders.items',
                    'key'           =>  'id',
                    'info'          =>  [],
                    'value'         =>  [],
                    'rules' =>  [
                        
                    ],
                    'parameters'    =>  [
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][products_id]',
                            'width' =>  '350px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][name]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][standard]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][size]',
                            'width' =>  '200px',
                        ],
                        'product_number'    =>  [
                            'class' =>  'fields',
                            'field' =>  'items[][product_number]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][count]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][unit]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][unit_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][tax]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][total_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][main_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][main_tax]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][main_total_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][description]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][file]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][remark]',
                            'width' =>  '200px',
                        ],
                    ],
                    
                ],
            ],
        ]
    ],
    'sales_orders'  =>  [
        'staff'     =>  \App\Service\StaffService::class,
        'customer'  =>  \App\Service\CustomerService::class,
        'product'   =>  \App\Service\ProductService::class,
        'models'    =>  [
            'staff'     =>  \App\Models\Staff::class,
            'product'   =>  \App\Models\Product::class,
            'department'=>  \App\Models\Department::class,
        ],
        'model' =>  Cpkm\ErpStock\Models\Sales\Order::class,
        'service'   => Cpkm\ErpStock\Service\Sales\OrderService::class,
        'form'  =>  [
            'name'  =>  'sales_order',
            'action'=>  '',
            'back'  =>  '',
            'method'=>  "POST",
            'tabs'  =>  [
                [
                    'key'   =>  'basic_data',
                    'tab'   =>  [
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'date',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'no',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'companies_id',
                                        ]
                                    ]
                                ],
                                
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customers_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'sourceable_type',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'sourceable_id',
                                        ]
                                    ]
                                ],
                                
                            ]
                        ],
                        
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'delivery_date',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'staff_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'departments_id',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customer_contacts_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customer_phone',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customer_address',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'project_managements_id',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'invoice_types_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'invoice_methods_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'invoice_categories_id',
                                        ]
                                    ]
                                ],
                                
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'currencies_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'exchange',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'make_id',
                                        ]
                                    ]
                                ],
                                
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'amount',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'tax',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'total_amount',
                                        ]
                                    ]
                                ],
                            ],
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'main_amount',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'main_tax',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'main_total_amount',
                                        ]
                                    ]
                                ],
                            ],
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'file',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-xl-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'slots',
                                            'field' =>  'options',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'items',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'key'   =>  'remark',
                    'tab'   =>  [
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-md-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'remark',
                                        ]
                                    ]
                                ],
                            ]
                        ]
                    ],
                ]
            ],
            'fields'    =>  [
                //報價單號
                
                //日期
                'date'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'date',
                    'text'          =>  'erp-stock::backend.sales_orders.date',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.date',
                    'required'      =>  true,
                    'value'         =>  date('Y-m-d'),
                    'rules' =>  [
                        
                    ]
                ],
                //單號
                'no'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'no',
                    'text'          =>  'erp-stock::backend.sales_orders.no',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.no',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ]
                ],
                //公司別
                'companies_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'companies_id',
                    'text'          =>  'erp-stock::backend.sales_orders.companies_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.companies_id',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\CompanyService::class,
                ],
                //狀態
                'sales_order_statuses_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'sales_order_statuses_id',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_statuses_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_statuses_id',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ]
                ],
                //客戶
                'customers_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'customers_id',
                    'text'          =>  'erp-stock::backend.sales_orders.customers_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.customers_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules'         =>  [

                    ],
                ],
                //來源單號
                'sourceable_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'sourceable_id',
                    'text'          =>  'erp-stock::backend.sales_orders.sourceable_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sourceable_id',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                    'options'       =>  [

                    ]
                ],
                //來源類別
                'sourceable_type'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'sourceable_type',
                    'text'          =>  'erp-stock::backend.sales_orders.sourceable_type',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sourceable_type',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                    'options'       =>  [

                    ]
                ],
                //預定交貨日
                'delivery_date'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'delivery_date',
                    'text'          =>  'erp-stock::backend.sales_orders.delivery_date',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.delivery_date',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                ],
                //人員
                'staff_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'staff_id',
                    'text'          =>  'erp-stock::backend.sales_orders.staff_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.staff_id',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\StaffService::class,
                ],
                //專案資料
                'project_managements_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'project_managements_id',
                    'text'          =>  'erp-stock::backend.sales_orders.project_managements_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.project_managements_id',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\ProjectManagementService::class,
                ],
                //部門
                'departments_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'departments_id',
                    'text'          =>  'erp-stock::backend.sales_orders.departments_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.departments_id',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\DepartmentService::class,
                ],
                //聯絡人
                'customer_contacts_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'customer_contacts_id',
                    'text'          =>  'erp-stock::backend.sales_orders.customer_contacts_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.customer_contacts_id',
                    'required'      =>  false,
                    'options'       =>  [
                    ],
                    'rules'         =>  [

                    ]
                ],
                //連絡電話
                'customer_phone'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'customer_phone',
                    'text'          =>  'erp-stock::backend.sales_orders.customer_phone',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.customer_phone',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules'         =>  [

                    ]
                ],
                'customer_address'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'customer_address',
                    'text'          =>  'erp-stock::backend.sales_orders.customer_address',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.customer_address',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules'         =>  [

                    ]
                ],
                //發票
                'invoice_types_id'   =>  [
                    'tag'           =>  'radio',
                    'name'          =>  'invoice_types_id',
                    'direction'     =>  'horizontal',
                    'text'          =>  'erp-stock::backend.sales_orders.invoice_types_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.invoice_types_id',
                    'required'      =>  true,
                    'options'       =>  [
                        
                    ],
                    'rules'         =>  [
                        
                    ],
                ],
                //發票
                'invoice_methods_id'   =>  [
                    'tag'           =>  'radio',
                    'name'          =>  'invoice_methods_id',
                    'direction'     =>  'horizontal',
                    'text'          =>  'erp-stock::backend.sales_orders.invoice_methods_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.invoice_methods_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules'         =>  [
                        
                    ],
                ],
                //發票
                'invoice_categories_id'   =>  [
                    'tag'           =>  'radio',
                    'name'          =>  'invoice_categories_id',
                    'direction'     =>  'horizontal',
                    'text'          =>  'erp-stock::backend.sales_orders.invoice_categories_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.invoice_categories_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules'         =>  [
                        
                    ],
                ],
                //幣別
                'currencies_id'   =>  [
                    'tag'           =>  'currency-select',
                    'name'          =>  'currencies_id',
                    'text'          =>  'erp-stock::backend.sales_orders.currencies_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.currencies_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules'         =>  [
                        
                    ],
                ],
                //匯率
                'exchange'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'exchange',
                    'text'          =>  'erp-stock::backend.sales_orders.exchange',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.exchange',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules'         =>  [
                        
                    ],
                ],
                //製單人員
                'make_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'make_id',
                    'text'          =>  'erp-stock::backend.sales_orders.make_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.make_id',
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\StaffService::class,
                ],
                //未稅金額
                'amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'amount',
                    'text'          =>  'erp-stock::backend.sales_orders.amount',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //稅金
                'tax'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'tax',
                    'text'          =>  'erp-stock::backend.sales_orders.tax',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //總額
                'total_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'total_amount',
                    'text'          =>  'erp-stock::backend.sales_orders.total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //未稅金額(本未必)
                'main_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'main_amount',
                    'text'          =>  'erp-stock::backend.sales_orders.main_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.main_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //稅金(本位幣)
                'main_tax'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'main_tax',
                    'text'          =>  'erp-stock::backend.sales_orders.main_tax',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.main_tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //總額(本位幣)
                'main_total_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'main_total_amount',
                    'text'          =>  'erp-stock::backend.sales_orders.main_total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.main_total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //備註
                'remark'   =>  [
                    'tag'           =>  'textarea',
                    'name'          =>  'remark',
                    'text'          =>  'erp-stock::backend.sales_orders.remark',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.remark',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ]
                ],
                //附加檔案
                'file'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'file',
                    'name'          =>  'file',
                    'text'          =>  'erp-stock::backend.sales_orders.file',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.file',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ]
                ],
                //報價單號
                'items[][sales_quote_order_items_id]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][sales_quote_order_items_id]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_quote_order_items_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_quote_order_items_id',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ]
                ],
                //產品編號
                'items[][products_id]'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'items[$i][products_id]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.products_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.products_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules' =>  [
                        
                    ],
                    'templateResult' =>  'productTemplateResult',
                    'templateSelection' =>  'productTemplateSelection',
                    'class' =>  'product-item',
                    'source'    =>  \App\Service\ProductService::class,
                ],
                //品名
                'items[][name]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][name]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.name',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.name',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //規格
                'items[][standard]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][standard]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.standard',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.standard',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //尺寸
                'items[][size]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][size]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.size',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.size',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //數量
                'items[][count]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][count]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.count',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.count',
                    'value'         =>  0,
                    'int'           =>  true,
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //單位
                'items[][unit]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][unit]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.unit',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.unit',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //單價
                'items[][unit_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][unit_amount]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.unit_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.unit_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //未稅金額
                'items[][amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][amount]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.amount',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //稅金
                'items[][tax]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][tax]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.tax',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //總額
                'items[][total_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][total_amount]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //未稅金額(本未必)
                'items[][main_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_amount]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.main_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.main_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //稅金(本位幣)
                'items[][main_tax]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_tax]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.main_tax',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.main_tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //總額(本位幣)
                'items[][main_total_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_total_amount]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.main_total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.main_total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //預交日期
                'items[][delivery_date]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'items[$i][delivery_date]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.delivery_date',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.delivery_date',
                    'required'      =>  false,
                    'rules'         =>  [

                    ],
                ],
                //內部描述
                'items[][description]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][description]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.description',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.description',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],
                //備註
                'items[][remark]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][remark]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.remark',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.remark',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],
                //附加檔案
                'items[][file]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'file',
                    'name'          =>  'items[$i][file]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.file',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.file',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][purchase_standard]'   =>  [
                    'tag'           =>  'slot',
                    'name'          =>  'purchase_standard_$i',
                    'text'          =>  '',
                    'placeholder'   =>  '',
                    'required'      =>  false,
                    'value'         =>  '
                        <a class="btn btn-sm btn-success" id="items[$i][purchase_standard]" href="" target="_blank">
                            訂購規格表
                        </a>
                    ',
                    'rules' =>  [
                        
                    ],
                ],

                'items[][yet_count]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'items[$i][yet_count]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.yet_count',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.yet_count',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][income_count]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'items[$i][income_count]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items.*.income_count',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items.*.income_count',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],
                
                /*-------------------------表身---------------------- */
                'items' =>  [
                    'tag'           =>  'multiple_table',
                    'name'          =>  'items',
                    'text'          =>  'erp-stock::backend.sales_orders.items',
                    'key'           =>  'id',
                    'info'          =>  [],
                    'value'         =>  [],
                    'rules' =>  [
                        
                    ],
                    'parameters'    =>  [
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][sales_quote_order_items_id]',
                            'width' =>  '0px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][products_id]',
                            'width' =>  '350px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][name]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][standard]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][size]',
                            'width' =>  '200px',
                        ],
                        'purchase_standard' =>  [
                            'class' =>  'fields',
                            'field' =>  'items[][purchase_standard]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][count]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][unit]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][unit_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][tax]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][total_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][main_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][main_tax]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][main_total_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][delivery_date]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][description]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][remark]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][income_count]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][yet_count]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][file]',
                            'width' =>  '200px',
                        ],
                    ],
                    
                ],
            ],
        ]
    ],
    'sales_sold_orders'  =>  [
        'staff'     =>  \App\Service\StaffService::class,
        'customer'  =>  \App\Service\CustomerService::class,
        'product'   =>  \App\Service\ProductService::class,
        'models'    =>  [
            'staff'     =>  \App\Models\Staff::class,
            'product'   =>  \App\Models\Product::class,
            'department'=>  \App\Models\Department::class,
        ],
        'model' =>  Cpkm\ErpStock\Models\Sales\SoldOrder::class,
        'service'   => Cpkm\ErpStock\Service\Sales\SoldOrderService::class,
        'form'  =>  [
            'name'  =>  'sales_sold_return_order',
            'action'=>  '',
            'back'  =>  '',
            'method'=>  "POST",
            'tabs'  =>  [
                [
                    'key'   =>  'basic_data',
                    'tab'   =>  [
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'date',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'no',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'companies_id',
                                        ]
                                    ]
                                ],
                                
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customers_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'sourceable_type',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'sourceable_id',
                                        ]
                                    ]
                                ],
                                
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'delivery_date',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'staff_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'departments_id',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customer_contacts_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customer_phone',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customer_address',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'project_managements_id',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'invoice_types_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'invoice_methods_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'invoice_categories_id',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'currencies_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'exchange',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'make_id',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'amount',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'tax',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'total_amount',
                                        ]
                                    ]
                                ],
                            ],
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'main_amount',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'main_tax',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'main_total_amount',
                                        ]
                                    ]
                                ],
                            ],
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'file',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-xl-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'slots',
                                            'field' =>  'options',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'items',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'key'   =>  'remark',
                    'tab'   =>  [
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-md-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'remark',
                                        ]
                                    ]
                                ],
                            ]
                        ]
                    ],
                ]
            ],
            'fields'    =>  [
                //日期
                'date'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'date',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.date',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.date',
                    'required'      =>  true,
                    'value'         =>  date('Y-m-d'),
                    'rules' =>  [
                        
                    ]
                ],
                //單號
                'no'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'no',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.no',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.no',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ]
                ],
                //公司別
                'companies_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'companies_id',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.companies_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.companies_id',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\CompanyService::class,
                ],
                //狀態
                'sales_sold_return_order_statuses_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'sales_sold_return_order_statuses_id',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_return_order_statuses_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_return_order_statuses_id',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ]
                ],
                //客戶
                'customers_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'customers_id',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.customers_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.customers_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules'         =>  [

                    ],
                ],
                //來源單號
                'sourceable_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'sourceable_id',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sourceable_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sourceable_id',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                    'options'       =>  [

                    ]
                ],
                //來源類別
                'sourceable_type'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'sourceable_type',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sourceable_type',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sourceable_type',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                    'options'       =>  [

                    ]
                ],
                //預定交貨日
                'delivery_date'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'delivery_date',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.delivery_date',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.delivery_date',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                ],
                //人員
                'staff_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'staff_id',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.staff_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.staff_id',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\StaffService::class,
                ],
                //部門
                'departments_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'departments_id',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.departments_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.departments_id',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\DepartmentService::class,
                ],
                //聯絡人
                'customer_contacts_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'customer_contacts_id',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.customer_contacts_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.customer_contacts_id',
                    'required'      =>  false,
                    'options'       =>  [
                    ],
                    'rules'         =>  [

                    ]
                ],
                //連絡電話
                'customer_phone'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'customer_phone',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.customer_phone',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.customer_phone',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules'         =>  [

                    ]
                ],
                'customer_address'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'customer_address',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.customer_address',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.customer_address',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules'         =>  [

                    ]
                ],
                //專案資料
                'project_managements_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'project_managements_id',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.project_managements_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.project_managements_id',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\ProjectManagementService::class,
                ],
                //發票
                'invoice_types_id'   =>  [
                    'tag'           =>  'radio',
                    'name'          =>  'invoice_types_id',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.invoice_types_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.invoice_types_id',
                    'direction'     =>  'horizontal',
                    'required'      =>  true,
                    'options'       =>  [
                        
                    ],
                    'rules'         =>  [
                        
                    ],
                ],
                //發票
                'invoice_methods_id'   =>  [
                    'tag'           =>  'radio',
                    'name'          =>  'invoice_methods_id',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.invoice_methods_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.invoice_methods_id',
                    'direction'     =>  'horizontal',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules'         =>  [
                        
                    ],
                ],
                //發票
                'invoice_categories_id'   =>  [
                    'tag'           =>  'radio',
                    'name'          =>  'invoice_categories_id',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.invoice_categories_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.invoice_categories_id',
                    'direction'     =>  'horizontal',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules'         =>  [
                        
                    ],
                ],
                //幣別
                'currencies_id'   =>  [
                    'tag'           =>  'currency-select',
                    'name'          =>  'currencies_id',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.currencies_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.currencies_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules'         =>  [
                        
                    ],
                ],
                //匯率
                'exchange'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'exchange',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.exchange',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.exchange',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules'         =>  [
                        
                    ],
                ],
                //製單人員
                'make_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'make_id',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.make_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.make_id',
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\StaffService::class,
                ],
                //未稅金額
                'amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'amount',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //稅金
                'tax'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'tax',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.tax',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //總額
                'total_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'total_amount',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //未稅金額(本未必)
                'main_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'main_amount',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.main_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.main_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //稅金(本位幣)
                'main_tax'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'main_tax',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.main_tax',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.main_tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //總額(本位幣)
                'main_total_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'main_total_amount',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.main_total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.main_total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //備註
                'remark'   =>  [
                    'tag'           =>  'textarea',
                    'name'          =>  'remark',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.remark',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.remark',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ]
                ],
                //附加檔案
                'file'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'file',
                    'name'          =>  'file',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.file',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.file',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ]
                ],
                //報價單號
                'items[][sales_order_items_id]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][sales_order_items_id]',
                    'text'          =>  'erp-stock::backend.sales_orders.sales_order_items_id',
                    'placeholder'   =>  'erp-stock::backend.sales_orders.sales_order_items_id',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ]
                ],
                //產品編號
                'items[][products_id]'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'items[$i][products_id]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.products_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.products_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules' =>  [
                        
                    ],
                    'templateResult' =>  'productTemplateResult',
                    'templateSelection' =>  'productTemplateSelection',
                    'class' =>  'product-item',
                    'source'    =>  \App\Service\ProductService::class,
                ],
                'items[][factory_id]'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'items[$i][factory_id]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.factory_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.factory_id',
                    'required'      =>  false,
                    'options'       =>  [
                    ],
                    'rules' =>  [
                        
                    ],
                ],
                //品名
                'items[][name]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][name]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.name',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.name',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //規格
                'items[][standard]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][standard]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.standard',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.standard',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //尺寸
                'items[][size]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][size]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.size',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.size',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //數量
                'items[][count]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][count]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.count',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.count',
                    'value'         =>  0,
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //單位
                'items[][unit]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][unit]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.unit',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.unit',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //單價
                'items[][unit_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][unit_amount]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.unit_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.unit_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //未稅金額
                'items[][amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][amount]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //稅金
                'items[][tax]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][tax]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.tax',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //總額
                'items[][total_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][total_amount]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //未稅金額(本未必)
                'items[][main_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_amount]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.main_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.main_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //稅金(本位幣)
                'items[][main_tax]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_tax]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.main_tax',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.main_tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //總額(本位幣)
                'items[][main_total_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_total_amount]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.main_total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.main_total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                'items[][delivery_date]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'items[$i][delivery_date]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.delivery_date',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.delivery_date',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],
                //內部描述
                'items[][description]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][description]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.description',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.description',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],
                //備註
                'items[][remark]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][remark]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.remark',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.remark',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],
                //附加檔案
                'items[][file]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'file',
                    'name'          =>  'items[$i][file]',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.file',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.file',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][product_stock]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'product_stock_$i',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.product_stock',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.product_stock',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][already_count]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'already_count_$i',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.already_count',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.already_count',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][yet_count]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'yet_count_$i',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.yet_count',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.yet_count',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][income_count]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'income_count_$i',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.income_count',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_order_items.*.income_count',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][purchase_orders_id]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'purchase_orders_id_$i',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.sales_sold_return_order_items.*.sales_sold_orders_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_orders.sales_sold_return_order_items.*.sales_sold_orders_id',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],
                
                /*-------------------------表身---------------------- */
                'items' =>  [
                    'tag'           =>  'multiple_table',
                    'name'          =>  'items',
                    'text'          =>  'erp-stock::backend.sales_sold_orders.items',
                    'key'           =>  'id',
                    'info'          =>  [],
                    'value'         =>  [],
                    'rules' =>  [
                        
                    ],
                    'parameters'    =>  [
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][sales_order_items_id]',
                            'width' =>  '0px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][products_id]',
                            'width' =>  '350px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][name]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][standard]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][size]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][count]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][unit]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][unit_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][tax]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][total_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][main_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][main_tax]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][main_total_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][delivery_date]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][description]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][remark]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][file]',
                            'width' =>  '200px',
                        ],
                    ],
                    
                ],
            ],
        ]
    ],
    'sales_sold_return_orders'  =>  [
        'staff'     =>  \App\Service\StaffService::class,
        'customer'  =>  \App\Service\CustomerService::class,
        'product'   =>  \App\Service\ProductService::class,
        'models'    =>  [
            'staff'     =>  \App\Models\Staff::class,
            'product'   =>  \App\Models\Product::class,
            'department'=>  \App\Models\Department::class,
        ],
        'model' =>  Cpkm\ErpStock\Models\Sales\SoldReturnOrder::class,
        'service'   => Cpkm\ErpStock\Service\Sales\SoldReturnOrderService::class,
        'form'  =>  [
            'name'  =>  'sales_sold_return_order',
            'action'=>  '',
            'back'  =>  '',
            'method'=>  "POST",
            'tabs'  =>  [
                [
                    'key'   =>  'basic_data',
                    'tab'   =>  [
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'date',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'no',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'companies_id',
                                        ]
                                    ]
                                ],
                                
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customers_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'sourceable_type',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'sourceable_id',
                                        ]
                                    ]
                                ],
                                
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'delivery_date',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'staff_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'departments_id',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customer_contacts_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customer_phone',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'customer_address',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'project_managements_id',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'invoice_types_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'invoice_methods_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'invoice_categories_id',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'currencies_id',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'exchange',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'make_id',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'amount',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'tax',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'total_amount',
                                        ]
                                    ]
                                ],
                            ],
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'main_amount',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'main_tax',
                                        ]
                                    ]
                                ],
                                [
                                    'class' =>  'col-4',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'main_total_amount',
                                        ]
                                    ]
                                ],
                            ],
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'file',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-xl-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'slots',
                                            'field' =>  'options',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'items',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'key'   =>  'remark',
                    'tab'   =>  [
                        [
                            'class' =>  'row',
                            'col'   =>  [
                                [
                                    'class' =>  'col-md-12',
                                    'col'   =>  [
                                        [
                                            'class' =>  'fields',
                                            'field' =>  'remark',
                                        ]
                                    ]
                                ],
                            ]
                        ]
                    ],
                ]
            ],
            'fields'    =>  [
                //日期
                'date'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'date',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.date',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.date',
                    'required'      =>  true,
                    'value'         =>  date('Y-m-d'),
                    'rules' =>  [
                        
                    ]
                ],
                //單號
                'no'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'no',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.no',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.no',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ]
                ],
                //公司別
                'companies_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'companies_id',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.companies_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.companies_id',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\CompanyService::class,
                ],
                //狀態
                'sales_sold_return_order_statuses_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'sales_sold_return_order_statuses_id',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_statuses_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_statuses_id',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ]
                ],
                //客戶
                'customers_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'customers_id',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.customers_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.customers_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules'         =>  [

                    ],
                ],
                //來源單號
                'sourceable_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'sourceable_id',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sourceable_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sourceable_id',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                    'options'       =>  [

                    ]
                ],
                //來源類別
                'sourceable_type'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'sourceable_type',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sourceable_type',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sourceable_type',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                    'options'       =>  [

                    ]
                ],
                //預定交貨日
                'delivery_date'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'delivery_date',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.delivery_date',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.delivery_date',
                    'required'      =>  false,
                    'rules'         =>  [
                        
                    ],
                ],
                //人員
                'staff_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'staff_id',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.staff_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.staff_id',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\StaffService::class,
                ],
                //部門
                'departments_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'departments_id',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.departments_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.departments_id',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\DepartmentService::class,
                ],
                //聯絡人
                'customer_contacts_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'customer_contacts_id',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.customer_contacts_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.customer_contacts_id',
                    'required'      =>  false,
                    'options'       =>  [
                    ],
                    'rules'         =>  [

                    ]
                ],
                //連絡電話
                'customer_phone'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'customer_phone',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.customer_phone',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.customer_phone',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules'         =>  [

                    ]
                ],
                'customer_address'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'customer_address',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.customer_address',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.customer_address',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules'         =>  [

                    ]
                ],
                //專案資料
                'project_managements_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'project_managements_id',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.project_managements_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.project_managements_id',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\ProjectManagementService::class,
                ],
                //發票
                'invoice_types_id'   =>  [
                    'tag'           =>  'radio',
                    'name'          =>  'invoice_types_id',
                    'direction'     =>  'horizontal',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.invoice_types_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.invoice_types_id',
                    'required'      =>  true,
                    'options'       =>  [
                        
                    ],
                    'rules'         =>  [
                        
                    ],
                ],
                //發票
                'invoice_methods_id'   =>  [
                    'tag'           =>  'radio',
                    'name'          =>  'invoice_methods_id',
                    'direction'     =>  'horizontal',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.invoice_methods_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.invoice_methods_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules'         =>  [
                        
                    ],
                ],
                //發票
                'invoice_categories_id'   =>  [
                    'tag'           =>  'radio',
                    'name'          =>  'invoice_categories_id',
                    'direction'     =>  'horizontal',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.invoice_categories_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.invoice_categories_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules'         =>  [
                        
                    ],
                ],
                //幣別
                'currencies_id'   =>  [
                    'tag'           =>  'currency-select',
                    'name'          =>  'currencies_id',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.currencies_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.currencies_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules'         =>  [
                        
                    ],
                ],
                //匯率
                'exchange'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'exchange',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.exchange',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.exchange',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules'         =>  [
                        
                    ],
                ],
                //製單人員
                'make_id'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'make_id',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.make_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.make_id',
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                    'options'       =>  [
                    ],
                    'source'    =>  \App\Service\StaffService::class,
                ],
                //未稅金額
                'amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'amount',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //稅金
                'tax'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'tax',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.tax',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //總額
                'total_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'total_amount',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //未稅金額(本未必)
                'main_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'main_amount',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.main_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.main_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //稅金(本位幣)
                'main_tax'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'main_tax',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.main_tax',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.main_tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //總額(本位幣)
                'main_total_amount'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'main_total_amount',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.main_total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.main_total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //備註
                'remark'   =>  [
                    'tag'           =>  'textarea',
                    'name'          =>  'remark',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.remark',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.remark',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ]
                ],
                //附加檔案
                'file'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'file',
                    'name'          =>  'file',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.file',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.file',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ]
                ],
                //銷貨單號
                'items[][sales_sold_order_items_id]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][sales_sold_order_items_id]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_order_items_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_order_items_id',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ]
                ],
                //產品編號
                'items[][products_id]'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'items[$i][products_id]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.products_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.products_id',
                    'required'      =>  true,
                    'options'       =>  [
                    ],
                    'rules' =>  [
                        
                    ],
                    'templateResult' =>  'productTemplateResult',
                    'templateSelection' =>  'productTemplateSelection',
                    'class' =>  'product-item',
                    'source'    =>  \App\Service\ProductService::class,
                ],
                //品名
                'items[][name]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][name]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.name',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.name',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //規格
                'items[][standard]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][standard]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.standard',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.standard',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //尺寸
                'items[][size]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][size]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.size',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.size',
                    'required'      =>  false,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //數量
                'items[][count]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][count]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.count',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.count',
                    'value'         =>  0,
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //單價
                'items[][unit_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][unit_amount]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.unit_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.unit_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //未稅金額
                'items[][amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][amount]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //稅金
                'items[][tax]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][tax]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.tax',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //總額
                'items[][total_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][total_amount]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                //未稅金額(本未必)
                'items[][main_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_amount]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.main_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.main_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //稅金(本位幣)
                'items[][main_tax]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_tax]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.main_tax',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.main_tax',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                //總額(本位幣)
                'items[][main_total_amount]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'number',
                    'name'          =>  'items[$i][main_total_amount]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.main_total_amount',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.main_total_amount',
                    'value'         =>  0,
                    'required'      =>  true,
                    'disabled'      =>  true,
                    'rules' =>  [
                            
                        ],
                ],
                'items[][delivery_date]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'items[$i][delivery_date]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.delivery_date',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.delivery_date',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],
                //單位
                'items[][unit]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][unit]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.unit',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.unit',
                    'required'      =>  true,
                    'rules' =>  [
                        
                    ],
                ],
                'items[][need_date]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'date',
                    'name'          =>  'items[$i][need_date]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.need_date',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.need_date',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],
                //內部描述
                'items[][description]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][description]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.description',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.description',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],
                //備註
                'items[][remark]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'text',
                    'name'          =>  'items[$i][remark]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.remark',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.remark',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],
                //附加檔案
                'items[][file]'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'file',
                    'name'          =>  'items[$i][file]',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.file',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.file',
                    'required'      =>  false,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][product_stock]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'product_stock_$i',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.product_stock',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.product_stock',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][already_count]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'already_count_$i',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.already_count',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.already_count',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][yet_count]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'yet_count_$i',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.yet_count',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.yet_count',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][income_count]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'income_count_$i',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.income_count',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.income_count',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],

                'items[][purchase_orders_id]'   =>  [
                    'tag'           =>  'span',
                    'name'          =>  'purchase_orders_id_$i',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.sales_sold_orders_id',
                    'placeholder'   =>  'erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_items.*.sales_sold_orders_id',
                    'required'      =>  false,
                    'value'         =>  0,
                    'rules' =>  [
                        
                    ],
                ],
                
                /*-------------------------表身---------------------- */
                'items' =>  [
                    'tag'           =>  'multiple_table',
                    'name'          =>  'items',
                    'text'          =>  'erp-stock::backend.sales_sold_return_orders.items',
                    'key'           =>  'id',
                    'info'          =>  [],
                    'value'         =>  [],
                    'rules' =>  [
                        
                    ],
                    'parameters'    =>  [
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][sales_sold_order_items_id]',
                            'width' =>  '0px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][products_id]',
                            'width' =>  '350px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][name]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][standard]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][size]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][count]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][unit]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][unit_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][tax]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][total_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][main_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][main_tax]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][main_total_amount]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][delivery_date]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][description]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][remark]',
                            'width' =>  '200px',
                        ],
                        [
                            'class' =>  'fields',
                            'field' =>  'items[][file]',
                            'width' =>  '200px',
                        ],
                    ],
                    
                ],
            ],
        ]
    ]
];
