<?php

return [

    /*
        選單名稱
    */

    /*
        頁面翻譯
    */

    /* A */
    /* B */
    /* C */
    /* D */
    /* E */
    /* F */
    /* I */
    /* J */
    /* L */
    /* M */
    /* O */
    /* P */
    'pre_purchase_orders'   =>  [
        'companies_id'      =>  '公司別',
        'date'              =>  '請購日期',
        'items'             =>  '請購項目',
        'name'              =>  '專案名稱',
		'no'                =>  '請購單號',
		'pre_purchase_order_statuses_id'	=>	'請購單狀態',
        'sourceable_id'     =>	'來源單號',
        'sourceable_type'	=>	'來源類別',

		'customer_contact_id' => '聯絡人',
		'customer_staff_id' => '採購人員',
		'customer_address' => '廠商地址',
		'customer_phone' =>' 連絡電話',
		
		'staff_id' => '人員',
		'departments_id' => '部門',
		'make_id' => '製單人員',
		'no_tax_amount' => '未稅金額',
		'tax' => '稅金',
		'tax_amount' => '含稅金額',
		'no_tax_amount_system' => '未稅金額(本位幣)',
		'tax_system' => '稅金(本位幣)',
		'tax_amount_system' => '含稅金額(本位幣)',
		'status' => '狀態',
		'remark' => '備註',
		'file' => '檔案',
		'subscription_order_types_id' => '請購類別',
		'subscription_order_statuses_id'	=>	'狀態',
		
		
		'pre_purchase_order_items'	=>	[
			'*'	=>	[
				'count'				=>	'請購數量',
				'description'		=>	'內部描述',
				'factory_id'		=>	'供應商',
				'file'				=>	'附加檔案',
				'name'				=>	'品名',
				'pre_count'			=>	'預採數量',
				'products_id'		=>	'產品編號',
				'product_stock'		=>	'庫存量',
				'remark'			=>	'備註',
				'size'				=>	'尺寸',
				'standard'			=>	'規格',
				'unit'				=>	'單位',
				
				'purchase_orders_id'	=>	'採購單號',
				'stocks'			=>	'庫存量',
				'need_date'			=>	'需求日期',
				'already_count'		=>	'已採購數量',
				'yet_count'			=>	'未採購數量',
				'income_count'		=>	'進貨數量',
			],
		]
    ],
    /* S */
	'sales_quote_orders'	=>	[
		'date'	=>	'日期',
		'no'	=>	'報價單號',
		'sourceable_id'	=>	'來源單號',
		'sourceable_type'	=>	'來源類別',
		'delivery_date'	=>	'預定交貨日期',
		'quote_start_date'	=>	'報價起始日期',
		'quote_end_date'	=>	'報價結束日期',
		'staff_id'			=>	'業務人員',
		'departments_id'	=>	'部門',
		'customers_id'		=>	'客戶',
		'customer_contacts_id'	=>	'聯絡人',
		'companies_id'		=>	'公司別',
		'currencies_id'		=>	'客戶幣別',
		'name'				=>	'專案名稱',
		'projects_id' => '專案名稱',
		'invoice_types_id'	=>	'扣稅類別',
		'amount'			=>	'未稅金額',
		'tax'				=>	'稅金',
		'total_amount'		=>	'總金額',
		'file'				=>	'附加檔案',
		'project_managements_id'	=>	'專案項目',
		'main_amount'		=>	'未稅金額(本位幣)',
		'main_tax'			=>	'稅金(本位幣)',
		'main_total_amount'	=>	'總金額(本位幣)',
		'phone'				=>	'客戶聯絡電話',
		'customer_phone'	=>	'聯絡電話',
		'customer_address'	=>	'客戶地址',
		'customer_staff_id'	=>	'業務人員',
		'make_id'	=>	'製單人員',
		'remark'			=>	'備註',
		'sales_quote_order_statuses_id'			=>	'狀態',
		'items'	=>	'報價單項目',
		'sales_quote_order_items'	=>	[
			'*'	=>	[
				'count'				=>	'數量',
				'products_id'		=>	'產品編號',
				'unit'				=>	'單位',
				'amount'			=>	'未稅金額',
				'tax'				=>	'稅金',
				'total_amount'		=>	'總金額',
				'file'				=>	'附加檔案',
				'main_amount'		=>	'未稅金額(本位幣)',
				'main_tax'			=>	'稅金(本位幣)',
				'main_total_amount'	=>	'總金額(本位幣)',
				'description'		=>	'內部描述',
				'remark'			=>	'備註',
				'unit_amount'		=>	'單價',
				'name'				=>	'品名',
				'standard'			=>	'規格',
				'size'				=>	'尺寸',
				'product_number'	=>	'型號',
				'sales_purchase_orders_id'	=>	'訂購單號',
			]
		]
	],
	'sales_sold_return_orders'	=>	[
		'date'	=>	'銷貨退回日期',
		'no'	=>	'銷貨退回單號',
		'sourceable_id'	=>	'來源單號',
		'sourceable_type'	=>	'來源類別',
		'delivery_date'	=>	'預定交貨日期',
		'quote_start_date'	=>	'報價起始日期',
		'quote_end_date'	=>	'報價結束日期',
		'staff_id'			=>	'人員',
		'departments_id'	=>	'部門',
		'customers_id'		=>	'客戶',
		'customer_contacts_id'	=>	'聯絡人',
		'companies_id'		=>	'公司別',
		'currencies_id'		=>	'客戶幣別',
		'name'				=>	'專案名稱',
		'invoice_types_id'	=>	'扣稅類別',
		'invoice_methods_id'	=>	'發票方式',
		'invoice_categories_id'	=>	'發票聯式',
		'exchange'			=>	'匯率',
		'amount'			=>	'未稅金額',
		'tax'				=>	'稅金',
		'total_amount'		=>	'總金額',
		'file'				=>	'附加檔案',
		'project_managements_id'	=>	'專案項目',
		'main_amount'		=>	'未稅金額(本位幣)',
		'main_tax'			=>	'稅金(本位幣)',
		'main_total_amount'	=>	'總金額(本位幣)',
		'customer_phone'	=>	'聯絡電話',
		'customer_address'	=>	'客戶地址',
		'customer_staff_id'	=>	'業務人員',
		'remark'			=>	'備註',
		'make_id'			=>	'製單人員',
		'sales_sold_return_order_statuses_id'	=>	'狀態',
		'items'             =>  '銷貨退回項目',
		'sales_sold_return_order_items'	=>	[
			'*'	=>	[
				'count'				=>	'銷貨數量',
				'products_id'		=>	'產品編號',
				'unit'				=>	'單位',
				'amount'			=>	'未稅金額',
				'tax'				=>	'稅金',
				'total_amount'		=>	'總金額',
				'file'				=>	'附加檔案',
				'main_amount'		=>	'未稅金額(本位幣)',
				'main_tax'			=>	'稅金(本位幣)',
				'main_total_amount'	=>	'總金額(本位幣)',
				'description'		=>	'內部描述',
				'remark'			=>	'備註',
				'unit_amount'		=>	'單價',
				'name'				=>	'品名',
				'standard'			=>	'規格',
				'size'				=>	'尺寸',
				'sales_purchase_orders_id'	=>	'訂購單號',
				'delivery_date'	=>	'預交日期',
			]
		]
	],
    /* T */
    /* U */
    /* W */

];
