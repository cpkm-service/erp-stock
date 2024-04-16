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
];
