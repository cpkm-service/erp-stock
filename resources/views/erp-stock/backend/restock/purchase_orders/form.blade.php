@extends('backend.layouts.main')
@section('content')
<main id="main-container">
<!-- Page Content -->
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{$form['title']}}</h3>
            </div>
            <div class="block-content pb-4">
                <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" id="btabs-static-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-home" role="tab" aria-controls="btabs-static-home" aria-selected="false" tabindex="-1">
                            {{ __('basic_data') }}
                        </button>
                    </li>
                    @if($show??false)
                    <li class="nav-item audit-tab" role="presentation">
                        <button type="button" class="nav-link" id="btabs-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-profile" role="tab" aria-controls="btabs-static-profile" aria-selected="false" tabindex="-1">
                            {{ __('audit') }}
                        </button>
                    </li>
                    <li class="nav-item audit-tab" role="presentation">
                        <button type="button" class="nav-link" id="transfer-record-tab" data-bs-toggle="tab" data-bs-target="#transfer-record" role="tab" aria-controls="transfer-record" aria-selected="false" tabindex="-1">
                            轉單紀錄
                        </button>
                    </li>
                    @endif
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabs-static-home" role="tabpanel" aria-labelledby="btabs-alt-static-home-tab">
                        <form action="{{$form['action']}}" method="POST" name="{{$form['name']}}" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="{{$form['method']}}">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <x-backend.input-date
                                        :tag="$form['fields']['date']['tag']" 
                                        :type="$form['fields']['date']['type']" 
                                        :text="$form['fields']['date']['text']" 
                                        :name="$form['fields']['date']['name']" 
                                        :placeholder="$form['fields']['date']['placeholder']"
                                        :required="($form['fields']['date']['required']??false)"
                                        :disabled="($form['fields']['date']['disabled']??false)"
                                        :value="($form['fields']['date']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.input
                                        :tag="$form['fields']['no']['tag']" 
                                        :type="$form['fields']['no']['type']" 
                                        :text="$form['fields']['no']['text']" 
                                        :name="$form['fields']['no']['name']" 
                                        :placeholder="$form['fields']['no']['placeholder']"
                                        :required="($form['fields']['no']['required']??false)"
                                        :disabled="($form['fields']['no']['disabled']??false)"
                                        :readonly="($form['fields']['sourceable_id']['readonly']??false)"
                                        :value="($form['fields']['no']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.select 
                                        :children="($form['fields']['companies_id']['children']??[])" 
                                        :options="$form['fields']['companies_id']['options']" 
                                        :text="$form['fields']['companies_id']['text']" 
                                        :name="$form['fields']['companies_id']['name']" 
                                        :placeholder="$form['fields']['companies_id']['placeholder']"
                                        :required="$form['fields']['companies_id']['required']??false"
                                        :disabled="($form['fields']['companies_id']['disabled']??false)"
                                        :multiple="($form['fields']['companies_id']['multiple']??false)"
                                        :value="($form['fields']['companies_id']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.select 
                                        :children="($form['fields']['factory_id']['children']??[])" 
                                        :options="$form['fields']['factory_id']['options']" 
                                        :text="$form['fields']['factory_id']['text']" 
                                        :name="$form['fields']['factory_id']['name']" 
                                        :placeholder="$form['fields']['factory_id']['placeholder']"
                                        :required="$form['fields']['factory_id']['required']??false"
                                        :disabled="($form['fields']['factory_id']['disabled']??false)"
                                        :multiple="($form['fields']['factory_id']['multiple']??false)"
                                        :value="($form['fields']['factory_id']['value']??'')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <x-backend.select 
                                        :children="($form['fields']['sourceable_type']['children']??[])" 
                                        :options="$form['fields']['sourceable_type']['options']" 
                                        :text="$form['fields']['sourceable_type']['text']" 
                                        :name="$form['fields']['sourceable_type']['name']" 
                                        :placeholder="$form['fields']['sourceable_type']['placeholder']"
                                        :required="$form['fields']['sourceable_type']['required']??false"
                                        :disabled="($form['fields']['sourceable_type']['disabled']??false)"
                                        :multiple="($form['fields']['sourceable_type']['multiple']??false)"
                                        :value="($form['fields']['sourceable_type']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.select 
                                        :children="($form['fields']['sourceable_id']['children']??[])" 
                                        :options="$form['fields']['sourceable_id']['options']" 
                                        :text="$form['fields']['sourceable_id']['text']" 
                                        :name="$form['fields']['sourceable_id']['name']" 
                                        :placeholder="$form['fields']['sourceable_id']['placeholder']"
                                        :required="$form['fields']['sourceable_id']['required']??false"
                                        :disabled="($form['fields']['sourceable_id']['disabled']??false)"
                                        :multiple="($form['fields']['sourceable_id']['multiple']??false)"
                                        :value="($form['fields']['sourceable_id']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.select 
                                        :children="($form['fields']['factory_contact_id']['children']??[])" 
                                        :options="$form['fields']['factory_contact_id']['options']" 
                                        :text="$form['fields']['factory_contact_id']['text']" 
                                        :name="$form['fields']['factory_contact_id']['name']" 
                                        :placeholder="$form['fields']['factory_contact_id']['placeholder']"
                                        :required="$form['fields']['factory_contact_id']['required']??false"
                                        :disabled="($form['fields']['factory_contact_id']['disabled']??false)"
                                        :multiple="($form['fields']['factory_contact_id']['multiple']??false)"
                                        :value="($form['fields']['factory_contact_id']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.select 
                                        :children="($form['fields']['factory_staff_id']['children']??[])" 
                                        :options="$form['fields']['factory_staff_id']['options']" 
                                        :text="$form['fields']['factory_staff_id']['text']" 
                                        :name="$form['fields']['factory_staff_id']['name']" 
                                        :placeholder="$form['fields']['factory_staff_id']['placeholder']"
                                        :required="$form['fields']['factory_staff_id']['required']??false"
                                        :disabled="($form['fields']['factory_staff_id']['disabled']??false)"
                                        :multiple="($form['fields']['factory_staff_id']['multiple']??false)"
                                        :value="($form['fields']['factory_staff_id']['value']??'')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <x-backend.input
                                        :tag="$form['fields']['factory_phone']['tag']" 
                                        :type="$form['fields']['factory_phone']['type']" 
                                        :text="$form['fields']['factory_phone']['text']" 
                                        :name="$form['fields']['factory_phone']['name']" 
                                        :placeholder="$form['fields']['factory_phone']['placeholder']"
                                        :required="($form['fields']['factory_phone']['required']??false)"
                                        :disabled="($form['fields']['factory_phone']['disabled']??false)"
                                        :value="($form['fields']['factory_phone']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-4">
                                    <x-backend.input
                                        :tag="$form['fields']['factory_address']['tag']" 
                                        :type="$form['fields']['factory_address']['type']" 
                                        :text="$form['fields']['factory_address']['text']" 
                                        :name="$form['fields']['factory_address']['name']" 
                                        :placeholder="$form['fields']['factory_address']['placeholder']"
                                        :required="($form['fields']['factory_address']['required']??false)"
                                        :disabled="($form['fields']['factory_address']['disabled']??false)"
                                        :value="($form['fields']['factory_address']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-5">
                                    <x-backend.input
                                        :tag="$form['fields']['name']['tag']" 
                                        :type="$form['fields']['name']['type']" 
                                        :text="$form['fields']['name']['text']" 
                                        :name="$form['fields']['name']['name']" 
                                        :placeholder="$form['fields']['name']['placeholder']"
                                        :required="($form['fields']['name']['required']??false)"
                                        :disabled="($form['fields']['name']['disabled']??false)"
                                        :value="($form['fields']['name']['value']??'')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <x-backend.radio
                                        direction="horizontal"
                                        :tag="$form['fields']['invoice_types_id']['tag']" 
                                        :text="$form['fields']['invoice_types_id']['text']" 
                                        :name="$form['fields']['invoice_types_id']['name']" 
                                        :options="$form['fields']['invoice_types_id']['options']" 
                                        :placeholder="$form['fields']['invoice_types_id']['placeholder']"
                                        :required="($form['fields']['invoice_types_id']['required']??false)"
                                        :disabled="($form['fields']['invoice_types_id']['disabled']??false)"
                                        :value="($form['fields']['invoice_types_id']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.radio
                                        direction="horizontal"
                                        :tag="$form['fields']['invoice_methods_id']['tag']" 
                                        :text="$form['fields']['invoice_methods_id']['text']" 
                                        :name="$form['fields']['invoice_methods_id']['name']" 
                                        :options="$form['fields']['invoice_methods_id']['options']" 
                                        :placeholder="$form['fields']['invoice_methods_id']['placeholder']"
                                        :required="($form['fields']['invoice_methods_id']['required']??false)"
                                        :disabled="($form['fields']['invoice_methods_id']['disabled']??false)"
                                        :value="($form['fields']['invoice_methods_id']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.currency-select 
                                        :name="$form['fields']['currencies_id']['name']" 
                                        :value="($form['fields']['currencies_id']['value']??'')"
                                        :disabled="($form['fields']['currencies_id']['disabled']??false)"
                                    />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.input
                                        :tag="$form['fields']['exchange']['tag']" 
                                        :type="$form['fields']['exchange']['type']" 
                                        :text="$form['fields']['exchange']['text']" 
                                        :name="$form['fields']['exchange']['name']" 
                                        :placeholder="$form['fields']['exchange']['placeholder']"
                                        :required="($form['fields']['exchange']['required']??false)"
                                        :disabled="($form['fields']['exchange']['disabled']??false)"
                                        :value="($form['fields']['exchange']['value']??'')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <x-backend.select 
                                        :children="($form['fields']['factory_payment_method']['children']??[])" 
                                        :options="$form['fields']['factory_payment_method']['options']" 
                                        :text="$form['fields']['factory_payment_method']['text']" 
                                        :name="$form['fields']['factory_payment_method']['name']" 
                                        :placeholder="$form['fields']['factory_payment_method']['placeholder']"
                                        :required="$form['fields']['factory_payment_method']['required']??false"
                                        :disabled="($form['fields']['factory_payment_method']['disabled']??false)"
                                        :multiple="($form['fields']['factory_payment_method']['multiple']??false)"
                                        :value="($form['fields']['factory_payment_method']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.input
                                        :tag="$form['fields']['factory_payment_day']['tag']" 
                                        :type="$form['fields']['factory_payment_day']['type']" 
                                        :text="$form['fields']['factory_payment_day']['text']" 
                                        :name="$form['fields']['factory_payment_day']['name']" 
                                        :placeholder="$form['fields']['factory_payment_day']['placeholder']"
                                        :required="($form['fields']['factory_payment_day']['required']??false)"
                                        :disabled="($form['fields']['factory_payment_day']['disabled']??false)"
                                        :value="($form['fields']['factory_payment_day']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.select 
                                        :children="($form['fields']['staff_id']['children']??[])" 
                                        :options="$form['fields']['staff_id']['options']" 
                                        :text="$form['fields']['staff_id']['text']" 
                                        :name="$form['fields']['staff_id']['name']" 
                                        :placeholder="$form['fields']['staff_id']['placeholder']"
                                        :required="$form['fields']['staff_id']['required']??false"
                                        :disabled="($form['fields']['staff_id']['disabled']??false)"
                                        :multiple="($form['fields']['staff_id']['multiple']??false)"
                                        :value="($form['fields']['staff_id']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.select 
                                        :children="($form['fields']['departments_id']['children']??[])" 
                                        :options="$form['fields']['departments_id']['options']" 
                                        :text="$form['fields']['departments_id']['text']" 
                                        :name="$form['fields']['departments_id']['name']" 
                                        :placeholder="$form['fields']['departments_id']['placeholder']"
                                        :required="$form['fields']['departments_id']['required']??false"
                                        :disabled="($form['fields']['departments_id']['disabled']??false)"
                                        :multiple="($form['fields']['departments_id']['multiple']??false)"
                                        :value="($form['fields']['departments_id']['value']??'')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <x-backend.select 
                                        :children="($form['fields']['make_id']['children']??[])" 
                                        :options="$form['fields']['make_id']['options']" 
                                        :text="$form['fields']['make_id']['text']" 
                                        :name="$form['fields']['make_id']['name']" 
                                        :placeholder="$form['fields']['make_id']['placeholder']"
                                        :required="$form['fields']['make_id']['required']??false"
                                        :disabled="($form['fields']['make_id']['disabled']??false)"
                                        :multiple="($form['fields']['make_id']['multiple']??false)"
                                        :value="($form['fields']['make_id']['value']??'')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <x-backend.input
                                        :tag="$form['fields']['amount']['tag']" 
                                        :type="$form['fields']['amount']['type']" 
                                        :text="$form['fields']['amount']['text']" 
                                        :name="$form['fields']['amount']['name']" 
                                        :placeholder="$form['fields']['amount']['placeholder']"
                                        :required="($form['fields']['amount']['required']??false)"
                                        :disabled="($form['fields']['amount']['disabled']??false)"
                                        :value="($form['fields']['amount']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.input
                                        :tag="$form['fields']['tax']['tag']" 
                                        :type="$form['fields']['tax']['type']" 
                                        :text="$form['fields']['tax']['text']" 
                                        :name="$form['fields']['tax']['name']" 
                                        :placeholder="$form['fields']['tax']['placeholder']"
                                        :required="($form['fields']['tax']['required']??false)"
                                        :disabled="($form['fields']['tax']['disabled']??false)"
                                        :value="($form['fields']['tax']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.input
                                        :tag="$form['fields']['total_amount']['tag']" 
                                        :type="$form['fields']['total_amount']['type']" 
                                        :text="$form['fields']['total_amount']['text']" 
                                        :name="$form['fields']['total_amount']['name']" 
                                        :placeholder="$form['fields']['total_amount']['placeholder']"
                                        :required="($form['fields']['total_amount']['required']??false)"
                                        :disabled="($form['fields']['total_amount']['disabled']??false)"
                                        :value="($form['fields']['total_amount']['value']??'')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <x-backend.input
                                        :tag="$form['fields']['main_amount']['tag']" 
                                        :type="$form['fields']['main_amount']['type']" 
                                        :text="$form['fields']['main_amount']['text']" 
                                        :name="$form['fields']['main_amount']['name']" 
                                        :placeholder="$form['fields']['main_amount']['placeholder']"
                                        :required="($form['fields']['main_amount']['required']??false)"
                                        :disabled="($form['fields']['main_amount']['disabled']??false)"
                                        :value="($form['fields']['main_amount']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.input
                                        :tag="$form['fields']['main_tax']['tag']" 
                                        :type="$form['fields']['main_tax']['type']" 
                                        :text="$form['fields']['main_tax']['text']" 
                                        :name="$form['fields']['main_tax']['name']" 
                                        :placeholder="$form['fields']['main_tax']['placeholder']"
                                        :required="($form['fields']['main_tax']['required']??false)"
                                        :disabled="($form['fields']['main_tax']['disabled']??false)"
                                        :value="($form['fields']['main_tax']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.input
                                        :tag="$form['fields']['main_total_amount']['tag']" 
                                        :type="$form['fields']['main_total_amount']['type']" 
                                        :text="$form['fields']['main_total_amount']['text']" 
                                        :name="$form['fields']['main_total_amount']['name']" 
                                        :placeholder="$form['fields']['main_total_amount']['placeholder']"
                                        :required="($form['fields']['main_total_amount']['required']??false)"
                                        :disabled="($form['fields']['main_total_amount']['disabled']??false)"
                                        :value="($form['fields']['main_total_amount']['value']??'')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <x-backend.textarea
                                        :tag="$form['fields']['remark']['tag']" 
                                        :text="$form['fields']['remark']['text']" 
                                        :name="$form['fields']['remark']['name']" 
                                        :placeholder="$form['fields']['remark']['placeholder']"
                                        :required="($form['fields']['remark']['required']??false)"
                                        :disabled="($form['fields']['remark']['disabled']??false)"
                                        :value="($form['fields']['remark']['value']??'')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <x-backend.input
                                        :tag="$form['fields']['file']['tag']" 
                                        :type="$form['fields']['file']['type']" 
                                        :text="$form['fields']['file']['text']" 
                                        :name="$form['fields']['file']['name']" 
                                        :placeholder="$form['fields']['file']['placeholder']"
                                        :required="($form['fields']['file']['required']??false)"
                                        :disabled="($form['fields']['file']['disabled']??false)"
                                        :value="($form['fields']['file']['value']??'')" />
                                </div>
                            </div>
                            @if(($show??false))
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn @if($detail->purchase_order_statuses_id == 1) btn-warning @elseif($detail->purchase_order_statuses_id == 2) btn-primary @else btn-danger @endif" type="button" id="close" data-id="{{$detail->id}}">{{$detail->status->name}}</button>
                                    @if($detail->purchase_order_statuses_id == 1 && (!$detail->inquiry_order && !$detail->purchase_order))
                                        @if($detail->can_restock_order)
                                        <a href="{{route('backend.restock_orders.create', ['sourceable_type' => \App\Models\PurchaseOrder::class, 'sourceable_id' => $detail->id])}}" class="btn btn-success">轉進貨單</a>
                                        @endif
                                        @if($detail->can_receive_material_order)
                                        <a href="{{route('backend.stock.receive_material_order.create', ['sourceable_type' => \App\Models\PurchaseOrder::class, 'sourceable_id' => $detail->id])}}" class="btn btn-success">轉收料單</a>
                                        @endif
                                    @else
                                        @if($detail->inquiry_order)
                                        <a href="{{route('backend.inquiry_orders.show', ['inquiry_order' => $detail->inquiry_order->id])}}" class="btn btn-info" target="_blank">詢價單</a>
                                        @elseif($detail->purchase_order)
                                        <a href="{{route('backend.purchase_orders.show', ['purchase_order' => $detail->purchase_order->id])}}" class="btn btn-info" target="_blank">採購單</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-12">
                                    @if(!($show??false))
                                    <button class="btn btn-success btn-sm add-template mb-3" data-target="product" type="button">新增</button>
                                    @endif
                                    <div class="table-responsive">
                                        <table class="table table-striped table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center" style="width:250px;"><span class="text-danger">*</span>{{__('backend.inquiry_orders.inquiry_order_items.*.products_id')}}</th>
                                                    <th class="text-center" style="width:180px;">{{__('backend.inquiry_orders.inquiry_order_items.*.name')}}</th>
                                                    <th class="text-center" style="width:180px;">{{__('backend.inquiry_orders.inquiry_order_items.*.standard')}}</th>
                                                    <th class="text-center" style="width:180px;">{{__('backend.inquiry_orders.inquiry_order_items.*.size')}}</th>
                                                    <th class="text-center" style="width:150px;"><span class="text-danger">*</span>{{__('backend.inquiry_orders.inquiry_order_items.*.unit_amount')}}</th>
                                                    <th class="text-center" style="width:100px;"><span class="text-danger">*</span>{{__('backend.inquiry_orders.inquiry_order_items.*.count')}}</th>
                                                    <th class="text-center" style="width:100px;"><span class="text-danger">*</span>{{__('backend.inquiry_orders.inquiry_order_items.*.unit')}}</th>
                                                    <th class="text-center" style="width:150px;"><span class="text-danger">*</span>{{__('backend.inquiry_orders.inquiry_order_items.*.amount')}}</th>
                                                    <th class="text-center" style="width:150px;"><span class="text-danger">*</span>{{__('backend.inquiry_orders.inquiry_order_items.*.tax')}}</th>
                                                    <th class="text-center" style="width:150px;"><span class="text-danger">*</span>{{__('backend.inquiry_orders.inquiry_order_items.*.total_amount')}}</th>
                                                    <th class="text-center" style="width:100px;">{{__('backend.inquiry_orders.inquiry_order_items.*.need_date')}}</th>
                                                    <th class="text-center" style="width:200px;">{{__('backend.inquiry_orders.inquiry_order_items.*.description')}}</th>
                                                    <th class="text-center" style="width:150px;">{{__('backend.inquiry_orders.inquiry_order_items.*.remark')}}</th>
                                                    <th class="text-center" style="width:100px;">{{__('backend.inquiry_orders.inquiry_order_items.*.check')}}</th>
                                                    <th class="text-center" style="width:150px">收料數量</th>
                                                    <th class="text-center" style="width:150px">已進數量</th>
                                                    <th class="text-center" style="width:150px">未進數量</th>
                                                    <th class="text-center" style="width:150px">收料單號</th>
                                                    <th class="text-center" style="width:150px">進貨單號</th>
                                                    <th class="text-center" style="width:100px;">{{__('backend.inquiry_orders.inquiry_order_items.*.stocks')}}</th>
                                                    <th class="text-center" style="width:150px;"><span class="text-danger">*</span>{{__('backend.inquiry_orders.inquiry_order_items.*.main_amount')}}</th>
                                                    <th class="text-center" style="width:150px;"><span class="text-danger">*</span>{{__('backend.inquiry_orders.inquiry_order_items.*.main_tax')}}</th>
                                                    <th class="text-center" style="width:150px;"><span class="text-danger">*</span>{{__('backend.inquiry_orders.inquiry_order_items.*.main_total_amount')}}</th>
                                                    <th class="text-center" style="width:300px;">{{__('backend.inquiry_orders.inquiry_order_items.*.file')}}</th>
                                                    <th class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="product_area" data-name="products">
                                                @foreach($detail->items??[] as $key => $item)
                                                <tr class="product_item template_item ui-sortable-handle">
                                                    <td class="text-center align-top">
                                                        {{( $key + 1 )}}
                                                        <input type="hidden" name="items[{{($key+1)}}][id]" value="{{$item['id']}}">
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.select 
                                                            :children="($form['fields']['items']['products_id']['children']??[])" 
                                                            :options="$form['fields']['items']['products_id']['options']" 
                                                            :text="$form['fields']['items']['products_id']['text']" 
                                                            :name="(str_replace('$i', ($key +1), $form['fields']['items']['products_id']['name']))" 
                                                            :placeholder="$form['fields']['items']['products_id']['placeholder']"
                                                            :required="$form['fields']['items']['products_id']['required']??false"
                                                            :disabled="($form['fields']['items']['products_id']['disabled']??false)"
                                                            :multiple="($form['fields']['items']['products_id']['multiple']??false)"
                                                            :value="($item->order_item->products_id??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                            :tag="$form['fields']['items']['name']['tag']" 
                                                            :type="$form['fields']['items']['name']['type']" 
                                                            :text="$form['fields']['items']['name']['text']" 
                                                            :name="(str_replace('$i', ($key +1), $form['fields']['items']['name']['name']))" 
                                                            :placeholder="$form['fields']['items']['name']['placeholder']"
                                                            :required="($form['fields']['items']['name']['required']??false)"
                                                            :disabled="($form['fields']['items']['name']['disabled']??false)"
                                                            :value="($item->order_item->name??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                                :tag="$form['fields']['items']['standard']['tag']" 
                                                                :type="$form['fields']['items']['standard']['type']" 
                                                                :text="$form['fields']['items']['standard']['text']" 
                                                                :name="(str_replace('$i', ($key +1), $form['fields']['items']['standard']['name']))" 
                                                                :placeholder="$form['fields']['items']['standard']['placeholder']"
                                                                :required="($form['fields']['items']['standard']['required']??false)"
                                                                :disabled="($form['fields']['items']['standard']['disabled']??false)"
                                                                :value="($item->order_item->standard??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                            :tag="$form['fields']['items']['size']['tag']" 
                                                            :type="$form['fields']['items']['size']['type']" 
                                                            :text="$form['fields']['items']['size']['text']" 
                                                            :name="$form['fields']['items']['size']['name']" 
                                                            :name="(str_replace('$i', ($key +1), $form['fields']['items']['size']['name']))" 
                                                            :placeholder="$form['fields']['items']['size']['placeholder']"
                                                            :required="($form['fields']['items']['size']['required']??false)"
                                                            :disabled="($form['fields']['items']['size']['disabled']??false)"
                                                            :value="($item->order_item->size??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                                :tag="$form['fields']['items']['unit_amount']['tag']" 
                                                                :type="$form['fields']['items']['unit_amount']['type']" 
                                                                :text="$form['fields']['items']['unit_amount']['text']" 
                                                                :name="(str_replace('$i', ($key +1), $form['fields']['items']['unit_amount']['name']))" 
                                                                :placeholder="$form['fields']['items']['unit_amount']['placeholder']"
                                                                :required="($form['fields']['items']['unit_amount']['required']??false)"
                                                                :disabled="($form['fields']['items']['unit_amount']['disabled']??false)"
                                                                :value="($item['unit_amount']??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                            :tag="$form['fields']['items']['count']['tag']" 
                                                            :type="$form['fields']['items']['count']['type']" 
                                                            :text="$form['fields']['items']['count']['text']" 
                                                            :name="(str_replace('$i', ($key +1), $form['fields']['items']['count']['name']))" 
                                                            :placeholder="$form['fields']['items']['count']['placeholder']"
                                                            :required="($form['fields']['items']['count']['required']??false)"
                                                            :disabled="($form['fields']['items']['count']['disabled']??false)"
                                                            :value="($item['count']??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                            :tag="$form['fields']['items']['unit']['tag']" 
                                                            :type="$form['fields']['items']['unit']['type']" 
                                                            :text="$form['fields']['items']['unit']['text']" 
                                                            :name="(str_replace('$i', ($key +1), $form['fields']['items']['unit']['name']))" 
                                                            :placeholder="$form['fields']['items']['unit']['placeholder']"
                                                            :required="($form['fields']['items']['unit']['required']??false)"
                                                            :disabled="($form['fields']['items']['unit']['disabled']??false)"
                                                            :value="($item->order_item->unit??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                                :tag="$form['fields']['items']['amount']['tag']" 
                                                                :type="$form['fields']['items']['amount']['type']" 
                                                                :text="$form['fields']['items']['amount']['text']" 
                                                                :name="(str_replace('$i', ($key +1), $form['fields']['items']['amount']['name']))" 
                                                                :placeholder="$form['fields']['items']['amount']['placeholder']"
                                                                :required="($form['fields']['items']['amount']['required']??false)"
                                                                :disabled="($form['fields']['items']['amount']['disabled']??false)"
                                                                :readonly="($form['fields']['items']['amount']['readonly']??false)"
                                                                :value="($item['amount']??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                                :tag="$form['fields']['items']['tax']['tag']" 
                                                                :type="$form['fields']['items']['tax']['type']" 
                                                                :text="$form['fields']['items']['tax']['text']" 
                                                                :name="(str_replace('$i', ($key +1), $form['fields']['items']['tax']['name']))" 
                                                                :placeholder="$form['fields']['items']['tax']['placeholder']"
                                                                :required="($form['fields']['items']['tax']['required']??false)"
                                                                :disabled="($form['fields']['items']['tax']['disabled']??false)"
                                                                :readonly="($form['fields']['items']['tax']['readonly']??false)"
                                                                :value="($item['tax']??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                            :tag="$form['fields']['items']['total_amount']['tag']" 
                                                            :type="$form['fields']['items']['total_amount']['type']" 
                                                            :text="$form['fields']['items']['total_amount']['text']" 
                                                            :name="(str_replace('$i', ($key +1), $form['fields']['items']['total_amount']['name']))" 
                                                            :placeholder="$form['fields']['items']['total_amount']['placeholder']"
                                                            :required="($form['fields']['items']['total_amount']['required']??false)"
                                                            :disabled="($form['fields']['items']['total_amount']['disabled']??false)"
                                                            :readonly="($form['fields']['items']['total_amount']['readonly']??false)"
                                                            :value="($item['total_amount']??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input-date
                                                            :tag="$form['fields']['items']['need_date']['tag']" 
                                                            :type="$form['fields']['items']['need_date']['type']" 
                                                            :text="$form['fields']['items']['need_date']['text']" 
                                                            :name="(str_replace('$i', ($key +1), $form['fields']['items']['need_date']['name']))" 
                                                            :placeholder="$form['fields']['items']['need_date']['placeholder']"
                                                            :required="($form['fields']['items']['need_date']['required']??false)"
                                                            :disabled="($form['fields']['items']['need_date']['disabled']??false)"
                                                            :value="($item['need_date']??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                            :tag="$form['fields']['items']['description']['tag']" 
                                                            :type="$form['fields']['items']['description']['type']" 
                                                            :text="$form['fields']['items']['description']['text']" 
                                                            :name="(str_replace('$i', ($key +1), $form['fields']['items']['description']['name']))" 
                                                            :placeholder="$form['fields']['items']['description']['placeholder']"
                                                            :required="($form['fields']['items']['description']['required']??false)"
                                                            :disabled="($form['fields']['items']['description']['disabled']??false)"
                                                            :value="($item['description']??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                            :tag="$form['fields']['items']['remark']['tag']" 
                                                            :type="$form['fields']['items']['remark']['type']" 
                                                            :text="$form['fields']['items']['remark']['text']" 
                                                            :name="(str_replace('$i', ($key +1), $form['fields']['items']['remark']['name']))" 
                                                            :placeholder="$form['fields']['items']['remark']['placeholder']"
                                                            :required="($form['fields']['items']['remark']['required']??false)"
                                                            :disabled="($form['fields']['items']['remark']['disabled']??false)"
                                                            :value="($item['remark']??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <input type="checkbox" id="product_test_{{($key +1)}}" disabled @if($item->order_item->check) checked @endif>
                                                    </td>
                                                    <td class="text-center align-top">0</td>
                                                    <td class="text-center align-top">0</td>
                                                    <td class="text-center align-top">0</td>
                                                    <td class="text-center align-top"></td>
                                                    <td class="text-center align-top"></td>
                                                    <td class="text-center align-top">
                                                        <span id="product_stock_{{($key +1)}}">
                                                            {{$item->order_item->stock}}
                                                        </span>
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                                :tag="$form['fields']['items']['main_amount']['tag']" 
                                                                :type="$form['fields']['items']['main_amount']['type']" 
                                                                :text="$form['fields']['items']['main_amount']['text']" 
                                                                :name="(str_replace('$i', ($key +1), $form['fields']['items']['main_amount']['name']))" 
                                                                :placeholder="$form['fields']['items']['main_amount']['placeholder']"
                                                                :required="($form['fields']['items']['main_amount']['required']??false)"
                                                                :disabled="($form['fields']['items']['main_amount']['disabled']??false)"
                                                                :readonly="($form['fields']['items']['main_amount']['readonly']??false)"
                                                                :value="($item['main_amount']??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                                :tag="$form['fields']['items']['main_tax']['tag']" 
                                                                :type="$form['fields']['items']['main_tax']['type']" 
                                                                :text="$form['fields']['items']['main_tax']['text']" 
                                                                :name="(str_replace('$i', ($key +1), $form['fields']['items']['main_tax']['name']))" 
                                                                :placeholder="$form['fields']['items']['main_tax']['placeholder']"
                                                                :required="($form['fields']['items']['main_tax']['required']??false)"
                                                                :disabled="($form['fields']['items']['main_tax']['disabled']??false)"
                                                                :readonly="($form['fields']['items']['main_tax']['readonly']??false)"
                                                                :value="($item['main_tax']??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                            :tag="$form['fields']['items']['main_total_amount']['tag']" 
                                                            :type="$form['fields']['items']['main_total_amount']['type']" 
                                                            :text="$form['fields']['items']['main_total_amount']['text']" 
                                                            :name="(str_replace('$i', ($key +1), $form['fields']['items']['main_total_amount']['name']))" 
                                                            :placeholder="$form['fields']['items']['main_total_amount']['placeholder']"
                                                            :required="($form['fields']['items']['main_total_amount']['required']??false)"
                                                            :disabled="($form['fields']['items']['main_total_amount']['disabled']??false)"
                                                            :readonly="($form['fields']['items']['main_total_amount']['readonly']??false)"
                                                            :value="($item['main_total_amount']??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input
                                                            :tag="$form['fields']['items']['file']['tag']" 
                                                            :type="$form['fields']['items']['file']['type']" 
                                                            :text="$form['fields']['items']['file']['text']" 
                                                            :name="(str_replace('$i', ($key +1), $form['fields']['items']['file']['name']))" 
                                                            :placeholder="$form['fields']['items']['file']['placeholder']"
                                                            :required="($form['fields']['items']['file']['required']??false)"
                                                            :disabled="($form['fields']['items']['file']['disabled']??false)"
                                                            :value="($item->order_item->file??'')" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                    @if(!($show??false))
                                                        <button class="btn btn-danger btn-sm delete-template mb-4">
                                                            <i class="fa fa-x"></i>
                                                        </button>
                                                    @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-4">
                                    @if(!($show??false))
                                    <button type="submit" class="btn btn-primary">{{__('backend.common.sent')}}</button>
                                    @endif
                                    @if($form['back'] !== false)
                                    <a href="{{$form['back']}}" class="btn btn-secondary">{{__('backend.common.back')}}</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    @if($show??false)
                    <div class="tab-pane " id="btabs-static-profile" role="tabpanel" aria-labelledby="btabs-alt-static-home-tab">
                        @include('backend.layouts.audits', [ 'table' => $table, 'table_id' => $detail->id ])
                    </div>
                    <div class="tab-pane " id="transfer-record" role="tabpanel" aria-labelledby="btabs-alt-static-home-tab">
                        <div class="accordion" id="transfer-record-list">
                            @foreach($detail->items as $item)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#transfer-record-{{$item->id}}" aria-expanded="false" aria-controls="transfer-record-{{$item->id}}">
                                        {{implode("-", array_filter([$item->order_item->name,$item->order_item->standard,$item->order_item->size]))}}
                                    </button>
                                </h2>
                                <div id="transfer-record-{{$item->id}}" class="accordion-collapse collapse" data-bs-parent="#transfer-record-list">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-bordered w-100">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th class="text-center">採購序</th>
                                                            <th class="text-center">{{__('backend.subscription_orders.subscription_order_items.*.products_id')}}</th>
                                                            <th class="text-center">{{__('backend.subscription_orders.subscription_order_items.*.name')}}</th>
                                                            <th class="text-center">{{__('backend.subscription_orders.subscription_order_items.*.standard')}}</th>
                                                            <th class="text-center">{{__('backend.subscription_orders.subscription_order_items.*.size')}}</th>
                                                            <th class="text-center">採購數量</th>
                                                            <th class="text-center">{{__('backend.subscription_orders.subscription_order_items.*.unit')}}</th>
                                                            <th class="text-center">{{__('backend.restock_orders.no')}}</th>
                                                            <th class="text-center">進貨序</th>
                                                            <th class="text-center">{{__('backend.receive_material_orders.no')}}</th>
                                                            <th class="text-center">收料序</th>
                                                            <th class="text-center">收料數量</th>
                                                            <th class="text-center">已進數量</th>
                                                            <th class="text-center">未轉數量</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($item->restock_order_items as $key => $restock_order_item)
                                                        <tr>
                                                            <th class="text-center">{{($key + 1)}}</th>
                                                            <th class="text-center">{{($item->id)}}</th>
                                                            <th class="text-center">{{($item->order_item->product->product_serial)}}</th>
                                                            <th class="text-center">{{($item->order_item->name)}}</th>
                                                            <th class="text-center">{{($item->order_item->standard)}}</th>
                                                            <th class="text-center">{{($item->order_item->size)}}</th>
                                                            <th class="text-center">{{($item->count)}}</th>
                                                            <th class="text-center">{{($item->order_item->unit)}}</th>
                                                            <th class="text-center">{{$restock_order_item->sourceable->no}}</th>
                                                            <th class="text-center">{{$restock_order_item->sourceable->id}}</th>
                                                            <th class="text-center">{{$restock_order_item->acceptance_order_item?->sourceable->order->no}}</th>
                                                            <th class="text-center">{{$restock_order_item->acceptance_order_item?->sourceable->order->id}}</th>
                                                            <td class="text-center">{{number_format($restock_order_item->acceptance_order_item?->sourceable->count)}}</td>
                                                            <th class="text-center">{{number_format($restock_order_item->count)}}</th>
                                                            <td class="text-center">{{number_format($item->count - $restock_order_item->count)}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
<!-- END Page Content -->
</main>
<div id="template_area" class="row d-none">
    <table class="table table-striped table-vcenter">
        <tbody>
            <tr class="product_item template_item ui-sortable-handle" id="product_template">
                <td class="text-center align-top">
                    $i
                    @if(!($show??false))
                    <input type="hidden" name="items[$i][order_items_id]">
                    @else
                    <input type="hidden" name="items[$i][id]">
                    @endif
                </td>
                <td class="text-center align-top">
                    <x-backend.select 
                        :children="($form['fields']['items']['products_id']['children']??[])" 
                        :options="$form['fields']['items']['products_id']['options']" 
                        :text="$form['fields']['items']['products_id']['text']" 
                        :name="$form['fields']['items']['products_id']['name']" 
                        :placeholder="$form['fields']['items']['products_id']['placeholder']"
                        :required="$form['fields']['items']['products_id']['required']??false"
                        :disabled="($form['fields']['items']['products_id']['disabled']??false)"
                        :multiple="($form['fields']['items']['products_id']['multiple']??false)"
                        :value="($form['fields']['items']['products_id']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['items']['name']['tag']" 
                        :type="$form['fields']['items']['name']['type']" 
                        :text="$form['fields']['items']['name']['text']" 
                        :name="$form['fields']['items']['name']['name']" 
                        :placeholder="$form['fields']['items']['name']['placeholder']"
                        :required="($form['fields']['items']['name']['required']??false)"
                        :disabled="($form['fields']['items']['name']['disabled']??false)"
                        :value="($form['fields']['items']['name']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                            :tag="$form['fields']['items']['standard']['tag']" 
                            :type="$form['fields']['items']['standard']['type']" 
                            :text="$form['fields']['items']['standard']['text']" 
                            :name="$form['fields']['items']['standard']['name']" 
                            :placeholder="$form['fields']['items']['standard']['placeholder']"
                            :required="($form['fields']['items']['standard']['required']??false)"
                            :disabled="($form['fields']['items']['standard']['disabled']??false)"
                            :value="($form['fields']['items']['standard']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['items']['size']['tag']" 
                        :type="$form['fields']['items']['size']['type']" 
                        :text="$form['fields']['items']['size']['text']" 
                        :name="$form['fields']['items']['size']['name']" 
                        :placeholder="$form['fields']['items']['size']['placeholder']"
                        :required="($form['fields']['items']['size']['required']??false)"
                        :disabled="($form['fields']['items']['size']['disabled']??false)"
                        :value="($form['fields']['items']['size']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['items']['unit_amount']['tag']" 
                        :type="$form['fields']['items']['unit_amount']['type']" 
                        :text="$form['fields']['items']['unit_amount']['text']" 
                        :name="$form['fields']['items']['unit_amount']['name']" 
                        :placeholder="$form['fields']['items']['unit_amount']['placeholder']"
                        :required="($form['fields']['items']['unit_amount']['required']??false)"
                        :disabled="($form['fields']['items']['unit_amount']['disabled']??false)"
                        :value="($form['fields']['items']['unit_amount']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :int="true"
                        :tag="$form['fields']['items']['count']['tag']" 
                        :type="$form['fields']['items']['count']['type']" 
                        :text="$form['fields']['items']['count']['text']" 
                        :name="$form['fields']['items']['count']['name']" 
                        :placeholder="$form['fields']['items']['count']['placeholder']"
                        :required="($form['fields']['items']['count']['required']??false)"
                        :disabled="($form['fields']['items']['count']['disabled']??false)"
                        :value="($form['fields']['items']['count']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['items']['unit']['tag']" 
                        :type="$form['fields']['items']['unit']['type']" 
                        :text="$form['fields']['items']['unit']['text']" 
                        :name="$form['fields']['items']['unit']['name']" 
                        :placeholder="$form['fields']['items']['unit']['placeholder']"
                        :required="($form['fields']['items']['unit']['required']??false)"
                        :disabled="($form['fields']['items']['unit']['disabled']??false)"
                        :value="($form['fields']['items']['unit']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                            :tag="$form['fields']['items']['amount']['tag']" 
                            :type="$form['fields']['items']['amount']['type']" 
                            :text="$form['fields']['items']['amount']['text']" 
                            :name="$form['fields']['items']['amount']['name']" 
                            :placeholder="$form['fields']['items']['amount']['placeholder']"
                            :required="($form['fields']['items']['amount']['required']??false)"
                            :disabled="($form['fields']['items']['amount']['disabled']??false)"
                            :readonly="($form['fields']['items']['amount']['readonly']??false)"
                            :value="($form['fields']['items']['amount']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                            :tag="$form['fields']['items']['tax']['tag']" 
                            :type="$form['fields']['items']['tax']['type']" 
                            :text="$form['fields']['items']['tax']['text']" 
                            :name="$form['fields']['items']['tax']['name']" 
                            :placeholder="$form['fields']['items']['tax']['placeholder']"
                            :required="($form['fields']['items']['tax']['required']??false)"
                            :disabled="($form['fields']['items']['tax']['disabled']??false)"
                            :readonly="($form['fields']['items']['tax']['readonly']??false)"
                            :value="($form['fields']['items']['tax']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['items']['total_amount']['tag']" 
                        :type="$form['fields']['items']['total_amount']['type']" 
                        :text="$form['fields']['items']['total_amount']['text']" 
                        :name="$form['fields']['items']['total_amount']['name']" 
                        :placeholder="$form['fields']['items']['total_amount']['placeholder']"
                        :required="($form['fields']['items']['total_amount']['required']??false)"
                        :disabled="($form['fields']['items']['total_amount']['disabled']??false)"
                        :readonly="($form['fields']['items']['total_amount']['readonly']??false)"
                        :value="($form['fields']['items']['total_amount']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input-date
                        :tag="$form['fields']['items']['need_date']['tag']" 
                        :type="$form['fields']['items']['need_date']['type']" 
                        :text="$form['fields']['items']['need_date']['text']" 
                        :name="$form['fields']['items']['need_date']['name']" 
                        :placeholder="$form['fields']['items']['need_date']['placeholder']"
                        :required="($form['fields']['items']['need_date']['required']??false)"
                        :disabled="($form['fields']['items']['need_date']['disabled']??false)"
                        :value="($form['fields']['items']['need_date']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['items']['description']['tag']" 
                        :type="$form['fields']['items']['description']['type']" 
                        :text="$form['fields']['items']['description']['text']" 
                        :name="$form['fields']['items']['description']['name']" 
                        :placeholder="$form['fields']['items']['description']['placeholder']"
                        :required="($form['fields']['items']['description']['required']??false)"
                        :disabled="($form['fields']['items']['description']['disabled']??false)"
                        :value="($form['fields']['items']['description']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['items']['remark']['tag']" 
                        :type="$form['fields']['items']['remark']['type']" 
                        :text="$form['fields']['items']['remark']['text']" 
                        :name="$form['fields']['items']['remark']['name']" 
                        :placeholder="$form['fields']['items']['remark']['placeholder']"
                        :required="($form['fields']['items']['remark']['required']??false)"
                        :disabled="($form['fields']['items']['remark']['disabled']??false)"
                        :value="($form['fields']['items']['remark']['value']??'')" />
                </td>
                
                <td class="text-center align-top">
                    <input type="checkbox" id="product_test_$i" disabled>
                </td>
                <td class="text-center align-top">
                    0
                </td>
                <td class="text-center align-top">
                    0
                </td>
                <td class="text-center align-top">
                    0
                </td>
                <td class="text-center align-top">
                    
                </td>
                <td class="text-center align-top">
                    
                </td>
                <td class="text-center align-top">
                    <span id="product_stock_$i">
                        0
                    </span>
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                            :tag="$form['fields']['items']['main_amount']['tag']" 
                            :type="$form['fields']['items']['main_amount']['type']" 
                            :text="$form['fields']['items']['main_amount']['text']" 
                            :name="$form['fields']['items']['main_amount']['name']" 
                            :placeholder="$form['fields']['items']['main_amount']['placeholder']"
                            :required="($form['fields']['items']['main_amount']['required']??false)"
                            :disabled="($form['fields']['items']['main_amount']['disabled']??false)"
                            :readonly="($form['fields']['items']['main_amount']['readonly']??false)"
                            :value="($form['fields']['items']['main_amount']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                            :tag="$form['fields']['items']['main_tax']['tag']" 
                            :type="$form['fields']['items']['main_tax']['type']" 
                            :text="$form['fields']['items']['main_tax']['text']" 
                            :name="$form['fields']['items']['main_tax']['name']" 
                            :placeholder="$form['fields']['items']['main_tax']['placeholder']"
                            :required="($form['fields']['items']['main_tax']['required']??false)"
                            :disabled="($form['fields']['items']['main_tax']['disabled']??false)"
                            :readonly="($form['fields']['items']['main_tax']['readonly']??false)"
                            :value="($form['fields']['items']['main_tax']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['items']['main_total_amount']['tag']" 
                        :type="$form['fields']['items']['main_total_amount']['type']" 
                        :text="$form['fields']['items']['main_total_amount']['text']" 
                        :name="$form['fields']['items']['main_total_amount']['name']" 
                        :placeholder="$form['fields']['items']['main_total_amount']['placeholder']"
                        :required="($form['fields']['items']['main_total_amount']['required']??false)"
                        :disabled="($form['fields']['items']['main_total_amount']['disabled']??false)"
                        :readonly="($form['fields']['items']['main_total_amount']['readonly']??false)"
                        :value="($form['fields']['items']['main_total_amount']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input
                        :tag="$form['fields']['items']['file']['tag']" 
                        :type="$form['fields']['items']['file']['type']" 
                        :text="$form['fields']['items']['file']['text']" 
                        :name="$form['fields']['items']['file']['name']" 
                        :placeholder="$form['fields']['items']['file']['placeholder']"
                        :required="($form['fields']['items']['file']['required']??false)"
                        :disabled="($form['fields']['items']['file']['disabled']??false)"
                        :value="($form['fields']['items']['file']['value']??'')" />
                </td>
                <td class="text-center align-top">
                @if(!($show??false))
                    <button class="btn btn-danger btn-sm delete-template mb-4" type="button">
                        <i class="fa fa-x"></i>
                    </button>
                @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>
<x-backend.product.product-number />
@endsection
@push('style')
<style>
    #btabs-static-home .table {
        width:max-content;
    }
    #btabs-static-home th,#btabs-static-home td {
        white-space:nowrap;
    }
    .accordion {
        --bs-accordion-bg: #ffffff;
    }
</style>
@endpush
@push('javascript')
<script src="{{asset('js/rate.js')}}"></script>
<script src="{{asset('js/imageFile.js')}}"></script>
<script>
    var url = "{{route('backend.purchase_orders.index')}}";

    $(`select[name="staff_id"]`).change(function(){
        let staff_id = $(this).val();
        if(staff_id) {
            sendApi(`${url}`,"GET",{
                action: "staff",
                id: staff_id,
            },function(result) {
                $(`select[name="departments_id"]`).val(result.data).trigger('change');
            });
        }
    });

    var contacts = {};
    $(`select[name="factory_id"]`).change(function(){
        let id = $(this).val();
        if(id) {
            sendApi(`${url}`,"GET",{
                action: "factory",
                id: id,
            },function(result) {
                let str = '';
                contacts = result.data.contacts;
                contacts.map((item) => {
                    str += `<option value="${item.id}">${item.name}</option>`
                });
                if(str) {
                    $(`select[name="factory_contact_id"]`).html(str).trigger('change');
                }
                if(typeof(result.data.banks) !='undefined') {
                    $(`input[name="invoice_types_id"][value="${result.data.banks.invoice_tax_method}"]`).prop("checked", true);
                    $(`input[name="invoice_methods_id"][value="${result.data.banks.invoice_method}"]`).prop("checked", true);
                    $(`input[data-name="factory_payment_day"]`).val(result.data.banks.pamynet_day).trigger('change');
                    $(`select[name="factory_payment_method"]`).val(result.data.banks.payment_method).trigger('change');
                }
                $(`select[name="factory_staff_id"]`).val(result.data.staff_id).trigger('change');
                $(`select[name="currencies_id"]`).val(result.data.currencies_id).trigger('change');
                $(`input[data-name="exchange"]`).val(result.data.exchange).trigger('change');
            });
        }
    });

    var init = true;

    $(`select[name="sourceable_type"]`).change(function(){
        if($(this).val() != '') {
            sendApi(`${url}`,"GET",{
                action: "sourceable_type",
                type: $(this).val()
            },function(result) {
                let str = '<option value=""></option>';
                result.data.map((item) => {
                    str += `<option value="${item.value}">${item.name}</option>`
                });
                $(`select[name="sourceable_id"]`).html(str);
                if(init) {
                    $(`select[name="sourceable_id"]`).val('{{addslashes(request()->sourceable_id)}}').trigger('change');
                    init = false;
                }
            });
        }
    });

    $(`select[name="sourceable_id"]`).change(function(){
        let id = $(this).val();
        if(id) {
            sendApi(`${url}`,"GET",{
                action: "sourceable_id",
                type: $(`select[name="sourceable_type"]`).val(),
                id: id,
            },function(result) {
                $('#product_area').html('');
                if(result.data.file) {
                    let file = result.data.file;
                    let name = file.split('/');
                    getFileFromURL('{{asset('storage')}}/'+file, name.pop())
                        .then(file => {
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);
                            $(`input[name="file"]`)[0].files = dataTransfer.files;
                            $(`input[name="file"]`).trigger('change')
                            // 可以將其用於你的程式邏輯中
                        });
                }
                $(`select[name="factory_id"]`).val(result.data.factory_id).trigger('change');
                $(`input[name="name"]`).val(result.data.name);
                $(`textarea[name="remark"]`).text(result.data.remark)
                result.data.items.map((item, key) => {
                    let i = key + 1;
                    $('.add-template').click();
                    setTimeout(() => {
                        $(`select[name="items[${i}][products_id]"]`).attr('disabled', true).val(item.products_id).trigger('change');
                        $(`input[data-name="items[${i}][unit_amount]"]`)
                        @if(request()->sourceable_type == \App\Models\PurchaseOrder::class)
                            .attr('disabled', true)
                        @endif
                        .val(item.unit_amount).trigger('keyup');
                        $(`input[data-name="items[${i}][count]"]`).val(item.count).trigger('keyup');
                        $(`input[name="items[${i}][unit]"]`).attr('disabled', true).val(item.unit);
                        $(`input[name="items[${i}][need_date]"]`).val(item.need_date);
                        $(`input[name="items[${i}][description]"]`).val(item.description);
                        $(`input[name="items[${i}][remark]"]`).val(item.remark);
                        $(`input[name="items[${i}][order_items_id]"]`).val(item.id);
                        $(`input[name="items[${i}][file]"]`).attr('disabled', true)
                        if(item.file) {
                            let name = item.file.split('/');
                            getFileFromURL('{{asset('storage')}}/'+item.file, name.pop())
                            .then(file => {
                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(file);
                                $(`input[name="items[${i}][file]"]`)[0].files = dataTransfer.files;
                                $(`input[name="items[${i}][file]"]`).trigger('change')
                                // 可以將其用於你的程式邏輯中
                            });
                        }
                        
                    }, 300);
                });
            });
        }
    });

    $(`select[name="factory_contact_id"]`).change(function() {
        let customer_contacts_id = $(this).val();
        if(customer_contacts_id) {
            contact = contacts.find((item) => {
                return item.id == customer_contacts_id;
            });
            if(contact) {
                $('input[name="factory_phone"]').val(contact.phone);
                $('input[name="factory_address"]').val(contact.address);
            }
        }
    });

    
    @if(!($show??false))
    var rate = new Rate({{$decimal_point}}, {{$tax_percentage}}, {{config('erp.calibration')}});
    main_calibration = Math.pow(10, {{config('erp.calibration')}});
    setMainCurrency(`input[id="number-main_amount"]`,`input[id="number-amount"]`);
    setMainCurrency(`input[id="number-main_tax"]`,`input[id="number-tax"]`);
    setMainCurrency(`input[id="number-main_total_amount"]`,`input[id="number-total_amount"]`);
    
    @foreach($detail->items??[] as $key => $item)
    setMainCurrency(`input[id="number-items[{{($key +1)}}][main_amount]"]`,`input[id="number-items[{{($key +1)}}][amount]"]`);
    setMainCurrency(`input[id="number-items[{{($key +1)}}][main_tax]"]`,`input[id="number-items[{{($key +1)}}][tax]"]`);
    setMainCurrency(`input[id="number-items[{{($key +1)}}][main_total_amount]"]`,`input[id="number-items[{{($key +1)}}][total_amount]"]`);
    @endforeach

    $(document).on('click', '.add-template', function(){
        let target = $(this).data('target');
        let template = $(`#${target}_template`).clone().removeAttr('id');
        let length = $(`#${target}_area .${target}_item`).length + 1;
        if(target == 'image') {
            length++;
        }
        $(`#${target}_area`).append(template[0].outerHTML.replace(/\$i/g, length));
        $(`#${target}_area`).find('select').select2({
            allowClear: true,
        });
        setMainCurrency(`input[id="number-items[${length}][main_amount]"]`,`input[id="number-items[${length}][amount]"]`);
        setMainCurrency(`input[id="number-items[${length}][main_tax]"]`,`input[id="number-items[${length}][tax]"]`);
        setMainCurrency(`input[id="number-items[${length}][main_total_amount]"]`,`input[id="number-items[${length}][total_amount]"]`);
    }).on('change', 'select[name$="[products_id]"]', function(){
        let product_id = $(this).val();
        let name = $(this).attr('name').replace("products_id", "name");
        let item = name.match(/items\[(\d+)\]/)[1];
        if(product_id) {
            sendApi(`${url}`,"GET",{
                action: "product",
                id: product_id,
            },function(result) {
                $(`input[name="items[${item}][name]"]`).val(result.data.product_name);
                $(`input[name="items[${item}][standard]"]`).val(result.data.product_standard);
                $(`input[name="items[${item}][size]"]`).val(result.data.size);
                $(`#product_stock_${item}`).text(result.data.stock);
                $(`#product_test_${item}`).prop('checked', result.data.test);
                $(`input[name="items[${item}][type]"]`).val(1);
                $(`select[name="items[${item}][products_id]"]`).attr('required', true);
                $(`#product-number-${item}`).html('');
            });
        }
        
    }).on('click', '.delete-template', function(){
        $(this).parents('.template_item').remove();
    }).on('keyup', 'form input[id$="[count]"]', function(){
        rate.calculateAmount();
    }).on('keyup', 'form input[id$="[unit_amount]"]', function(){
        rate.calculateAmount();
    }).on('change', 'form input:radio[name="invoice_types_id"]', function(){
        rate.calculateAmount();
    });
    @endif
    @if(request()->sourceable_type)
        $(`select[name="sourceable_type"]`).val('{{addslashes(request()->sourceable_type)}}').trigger('change');
    @endif
</script>
@endpush