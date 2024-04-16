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
                                        :readonly="($form['fields']['source_no']['readonly']??false)"
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
                                        :children="($form['fields']['customers_id']['children']??[])" 
                                        :options="$form['fields']['customers_id']['options']" 
                                        :text="$form['fields']['customers_id']['text']" 
                                        :name="$form['fields']['customers_id']['name']" 
                                        :placeholder="$form['fields']['customers_id']['placeholder']"
                                        :required="$form['fields']['customers_id']['required']??false"
                                        :disabled="($form['fields']['customers_id']['disabled']??false)"
                                        :multiple="($form['fields']['customers_id']['multiple']??false)"
                                        :value="($form['fields']['customers_id']['value']??'')" />
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
                                    <x-backend.input-date
                                        :tag="$form['fields']['delivery_date']['tag']" 
                                        :type="$form['fields']['delivery_date']['type']" 
                                        :text="$form['fields']['delivery_date']['text']" 
                                        :name="$form['fields']['delivery_date']['name']" 
                                        :placeholder="$form['fields']['delivery_date']['placeholder']"
                                        :required="($form['fields']['delivery_date']['required']??false)"
                                        :disabled="($form['fields']['delivery_date']['disabled']??false)"
                                        :value="($form['fields']['delivery_date']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.select 
                                        :children="($form['fields']['customer_contacts_id']['children']??[])" 
                                        :options="$form['fields']['customer_contacts_id']['options']" 
                                        :text="$form['fields']['customer_contacts_id']['text']" 
                                        :name="$form['fields']['customer_contacts_id']['name']" 
                                        :placeholder="$form['fields']['customer_contacts_id']['placeholder']"
                                        :required="$form['fields']['customer_contacts_id']['required']??false"
                                        :disabled="($form['fields']['customer_contacts_id']['disabled']??false)"
                                        :multiple="($form['fields']['customer_contacts_id']['multiple']??false)"
                                        :value="($form['fields']['customer_contacts_id']['value']??'')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <x-backend.select 
                                        :children="($form['fields']['customer_staff_id']['children']??[])" 
                                        :options="$form['fields']['customer_staff_id']['options']" 
                                        :text="$form['fields']['customer_staff_id']['text']" 
                                        :name="$form['fields']['customer_staff_id']['name']" 
                                        :placeholder="$form['fields']['customer_staff_id']['placeholder']"
                                        :required="$form['fields']['customer_staff_id']['required']??false"
                                        :disabled="($form['fields']['customer_staff_id']['disabled']??false)"
                                        :multiple="($form['fields']['customer_staff_id']['multiple']??false)"
                                        :value="($form['fields']['customer_staff_id']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.input
                                        :tag="$form['fields']['customer_phone']['tag']" 
                                        :type="$form['fields']['customer_phone']['type']" 
                                        :text="$form['fields']['customer_phone']['text']" 
                                        :name="$form['fields']['customer_phone']['name']" 
                                        :placeholder="$form['fields']['customer_phone']['placeholder']"
                                        :required="($form['fields']['customer_phone']['required']??false)"
                                        :disabled="($form['fields']['customer_phone']['disabled']??false)"
                                        :value="($form['fields']['customer_phone']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-6">
                                    <x-backend.input
                                        :tag="$form['fields']['customer_address']['tag']" 
                                        :type="$form['fields']['customer_address']['type']" 
                                        :text="$form['fields']['customer_address']['text']" 
                                        :name="$form['fields']['customer_address']['name']" 
                                        :placeholder="$form['fields']['customer_address']['placeholder']"
                                        :required="($form['fields']['customer_address']['required']??false)"
                                        :disabled="($form['fields']['customer_address']['disabled']??false)"
                                        :value="($form['fields']['customer_address']['value']??'')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
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
                                    <x-backend.radio
                                        direction="horizontal"
                                        :tag="$form['fields']['invoice_categories_id']['tag']" 
                                        :text="$form['fields']['invoice_categories_id']['text']" 
                                        :name="$form['fields']['invoice_categories_id']['name']" 
                                        :options="$form['fields']['invoice_categories_id']['options']" 
                                        :placeholder="$form['fields']['invoice_categories_id']['placeholder']"
                                        :required="($form['fields']['invoice_categories_id']['required']??false)"
                                        :disabled="($form['fields']['invoice_categories_id']['disabled']??false)"
                                        :value="($form['fields']['invoice_categories_id']['value']??'')" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <x-backend.currency-select 
                                        :name="$form['fields']['currencies_id']['name']" 
                                        :value="($form['fields']['currencies_id']['value']??'')"
                                        :disabled="($form['fields']['currencies_id']['disabled']??false)"
                                    />
                                </div>
                            </div>
                            
                            <div class="row">
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
                            @if(($show??false))
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn @if($detail->sales_sold_order_statuses_id == 1) btn-warning @elseif($detail->sales_sold_order_statuses_id == 2) btn-primary @else btn-danger @endif" type="button" id="close" data-id="{{$detail->id}}">{{$detail->status->name}}</button>
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
                                                    <th class="text-center" style="width:250px;"><span class="text-danger">*</span>{{__('backend.sales_orders.sales_order_items.*.products_id')}}</th>
                                                    <th class="text-center" style="width:180px;">{{__('backend.sales_orders.sales_order_items.*.name')}}</th>
                                                    <th class="text-center" style="width:180px;">{{__('backend.sales_orders.sales_order_items.*.standard')}}</th>
                                                    <th class="text-center" style="width:180px;">{{__('backend.sales_orders.sales_order_items.*.size')}}</th>
                                                    @if($show??false)
                                                    <th class="text-center" style="width:180px;"></th>
                                                    @endif
                                                    <th class="text-center" style="width:100px;"><span class="text-danger">*</span>{{__('backend.sales_orders.sales_order_items.*.count')}}</th>
                                                    <th class="text-center" style="width:100px;">{{__('backend.sales_orders.sales_order_items.*.unit')}}</th>
                                                    <th class="text-center" style="width:150px;"><span class="text-danger">*</span>{{__('backend.sales_orders.sales_order_items.*.unit_amount')}}</th>
                                                    <th class="text-center" style="width:150px;"><span class="text-danger">*</span>{{__('backend.sales_orders.sales_order_items.*.amount')}}</th>
                                                    <th class="text-center" style="width:150px;"><span class="text-danger">*</span>{{__('backend.sales_orders.sales_order_items.*.tax')}}</th>
                                                    <th class="text-center" style="width:150px;"><span class="text-danger">*</span>{{__('backend.sales_orders.sales_order_items.*.total_amount')}}</th>
                                                    <th class="text-center" style="width:150px;">{{__('backend.sales_orders.sales_order_items.*.delivery_date')}}</th>
                                                    <th class="text-center" style="width:200px;">{{__('backend.sales_orders.sales_order_items.*.description')}}</th>
                                                    <th class="text-center" style="width:150px;">{{__('backend.sales_orders.sales_order_items.*.remark')}}</th>
                                                    <th class="text-center" style="width:150px;"><span class="text-danger">*</span>{{__('backend.sales_orders.sales_order_items.*.main_amount')}}</th>
                                                    <th class="text-center" style="width:150px;"><span class="text-danger">*</span>{{__('backend.sales_orders.sales_order_items.*.main_tax')}}</th>
                                                    <th class="text-center" style="width:150px;"><span class="text-danger">*</span>{{__('backend.sales_orders.sales_order_items.*.main_total_amount')}}</th>
                                                    <th class="text-center" style="width:250px;">{{__('backend.sales_orders.sales_order_items.*.file')}}</th>
                                                    <th class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="product_area" data-name="products">
                                                @foreach($detail->items??[] as $key => $item)
                                                <tr class="product_item template_item ui-sortable-handle">
                                                    <td class="text-center align-top">
                                                        {{( $key + 1 )}}
                                                        <input type="hidden" name="items[{{($key+1)}}][sales_purchase_order_items_id]" value="{{$item['sales_purchase_order_items_id']}}">
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
                                                            :value="($item->sales_purchase_order_item->sales_order_item->products_id??'')" />
                                                        <div class="d-none">
                                                            <x-backend.input 
                                                                :tag="$form['fields']['items']['type']['tag']" 
                                                                :type="$form['fields']['items']['type']['type']" 
                                                                :text="$form['fields']['items']['type']['text']" 
                                                                :name="(str_replace('$i', ($key +1), $form['fields']['items']['type']['name']))" 
                                                                :placeholder="$form['fields']['items']['type']['placeholder']"
                                                                :required="($form['fields']['items']['type']['required']??false)"
                                                                :disabled="($form['fields']['items']['type']['disabled']??false)"
                                                                :value="1" />
                                                        </div>
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
                                                            :value="($item->sales_purchase_order_item->sales_order_item->name??'')" />
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
                                                                :value="($item->sales_purchase_order_item->sales_order_item->standard??'')" />
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
                                                            :value="($item->sales_purchase_order_item->sales_order_item->size??'')" />
                                                    </td>
                                                    @if($show??false)
                                                    <td class="text-center align-top">
                                                        <a  class="btn btn-sm btn-success makeNo" href="{{route('backend.sales.order_item_standard.create',['item' => $item->sales_purchase_order_item->id])}}" target="_blank">
                                                            訂購規格表
                                                        </a>
                                                    </td>
                                                    @endif
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
                                                            :value="($item->sales_purchase_order_item->sales_order_item->unit??'')" />
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
                                                                :value="($item->sales_purchase_order_item->sales_order_item->unit_amount??'')" />
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
                                                        <x-backend.input 
                                                            :tag="$form['fields']['items']['delivery_date']['tag']" 
                                                            :type="$form['fields']['items']['delivery_date']['type']" 
                                                            :text="$form['fields']['items']['delivery_date']['text']" 
                                                            :name="(str_replace('$i', ($key +1), $form['fields']['items']['delivery_date']['name']))" 
                                                            :placeholder="$form['fields']['items']['delivery_date']['placeholder']"
                                                            :required="($form['fields']['items']['delivery_date']['required']??false)"
                                                            :disabled="($form['fields']['items']['delivery_date']['disabled']??false)"
                                                            :value="($item->sales_purchase_order_item->delivery_date??'')" />
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
                                                            :value="($item->sales_purchase_order_item->sales_order_item->description??'')" />
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
                                                            :value="($item->sales_purchase_order_item->sales_order_item->file??'')" />
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
                    <input type="hidden" name="items[$i][sales_purchase_order_items_id]">
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
                    <div class="d-none">
                        <x-backend.input 
                            :tag="$form['fields']['items']['type']['tag']" 
                            :type="$form['fields']['items']['type']['type']" 
                            :text="$form['fields']['items']['type']['text']" 
                            :name="$form['fields']['items']['type']['name']" 
                            :placeholder="$form['fields']['items']['type']['placeholder']"
                            :required="($form['fields']['items']['type']['required']??false)"
                            :disabled="($form['fields']['items']['type']['disabled']??false)"
                            :value="($form['fields']['items']['type']['value']??'')" />
                    </div>
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
                    <x-backend.input 
                        :tag="$form['fields']['items']['delivery_date']['tag']" 
                        :type="$form['fields']['items']['delivery_date']['type']" 
                        :text="$form['fields']['items']['delivery_date']['text']" 
                        :name="$form['fields']['items']['delivery_date']['name']" 
                        :placeholder="$form['fields']['items']['delivery_date']['placeholder']"
                        :required="($form['fields']['items']['delivery_date']['required']??false)"
                        :disabled="($form['fields']['items']['delivery_date']['disabled']??false)"
                        :value="($form['fields']['items']['delivery_date']['value']??'')" />
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
</style>
@endpush
@push('javascript')
<script src="{{asset('js/rate.js')}}"></script>
<script src="{{asset('js/imageFile.js')}}"></script>
<script>
    var url = "{{route('backend.sales.sold_order.index')}}";

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
    $(`select[name="customers_id"]`).change(function(){
        let id = $(this).val();
        if(id) {
            sendApi(`${url}`,"GET",{
                action: "customer",
                id: id,
            },function(result) {
                let str = '';
                contacts = result.data.contacts;
                contacts.map((item) => {
                    str += `<option value="${item.id}">${item.name}</option>`
                });
                $(`select[name="customer_contacts_id"]`).html(str).trigger('change');
                $(`select[name="currencies_id"]`).val(result.data.currencies_id).trigger('change');
                $(`select[name="customer_staff_id"]`).val(result.data.staff_id).trigger('change');
                $(`input[data-name="exchange"]`).val(result.data.exchange).trigger('change');
                exchange = result.data.exchange;
                $(`input[name="invoice_types_id"][value="${result.data.banks.invoice_tax_method}"]`).prop("checked", true);
            });
        }
    });

    $(`select[name="customer_contacts_id"]`).change(function() {
        let customer_contacts_id = $(this).val();
        if(customer_contacts_id) {
            contact = contacts.find((item) => {
                return item.id == customer_contacts_id;
            });
            if(contact) {
                $('input[name="customer_phone"]').val(contact.phone);
                $('input[name="customer_address"]').val(contact.address);
            }
        }
    });

    var init = true;
    $(`select[name="sourceable_type"]`).change(function(){
        if($(this).val() == "App\\Models\\SalesOrder") {
            sendApi(`${url}`,"GET",{
                action: "sourceable_type",
            },function(result) {
                let str = '<option value=""></option>';
                result.data.map((item) => {
                    str += `<option value="${item.value}">${item.name}</option>`
                });
                $(`select[name="sourceable_id"]`).html(str);
                @if(request()->sourceable_type)
                    if(init) {
                        $(`select[name="sourceable_id"]`).val('{{addslashes(request()->sourceable_id)}}').trigger('change');    
                        init = false;
                    }
                @endif
            });
        }
    });

    $(`select[name="sourceable_id"]`).change(function(){
        let id = $(this).val();
        if(id) {
            sendApi(`${url}`,"GET",{
                action: "sourceable_id",
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
                $(`input[name="name"]`).val(result.data.name);
                $(`select[name="customers_id"]`).val(result.data.customers_id).trigger('change');
                $(`textarea[name="remark"]`).val(result.data.remark);
                result.data.items.map((item, key) => {
                    let i = key + 1;
                    $('.add-template').click();
                    setTimeout(() => {
                        $(`select[name="items[${i}][products_id]"]`).attr('disabled', true).val(item.sales_order_item.products_id).trigger('change');
                        $(`input[name="items[${i}][name]"]`).attr('disabled', true).val(item.sales_order_item.name);
                        $(`input[name="items[${i}][standard]"]`).attr('disabled', true).val(item.sales_order_item.standard);
                        $(`input[name="items[${i}][size]"]`).attr('disabled', true).val(item.sales_order_item.size);
                        $(`input[data-name="items[${i}][count]"]`).val(item.count).trigger('keyup');
                        $(`[id="number-items[${i}][unit_amount]"]`).val(item.sales_order_item.unit_amount).attr('disabled', true).trigger('keyup');
                        $(`input[name="items[${i}][unit]"]`).attr('disabled', true).val(item.sales_order_item.unit);
                        $(`input[name="items[${i}][description]"]`).attr('disabled', true).val(item.sales_order_item.description);
                        $(`input[name="items[${i}][delivery_date]"]`).attr('disabled', true).val(item.delivery_date);
                        $(`input[name="items[${i}][sales_purchase_order_items_id]"]`).val(item.id);
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
                        rate.calculateAmount();;
                    }, 300);
                });
            });
        }
    });
    
    @if(!($show??false))
    main_calibration = Math.pow(10, {{config('erp.calibration')}});
    var rate = new Rate({{$decimal_point}}, {{$tax_percentage}}, {{config('erp.calibration')}});
    setMainCurrency(`input[id="number-main_amount"]`,`input[id="number-amount"]`);
    setMainCurrency(`input[id="number-main_tax"]`,`input[id="number-tax"]`);
    setMainCurrency(`input[id="number-main_total_amount"]`,`input[id="number-total_amount"]`);
    
    @foreach($detail->items??[] as $key => $item)
    setMainCurrency(`input[id="number-items[{{($key +1)}}][main_amount]"]`,`input[id="number-items[{{($key +1)}}][amount]"]`);
    setMainCurrency(`input[id="number-items[{{($key +1)}}][main_tax]"]`,`input[id="number-items[{{($key +1)}}][tax]"]`);
    setMainCurrency(`input[id="number-items[{{($key +1)}}][main_total_amount]"]`,`input[id="number-items[{{($key +1)}}][total_amount]"]`);
    @endforeach

    $(`input[name="invoice_types_id"]`).change(function(){
        rate.setInvoiceType(parseInt($(this).val()));
    });

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
                $(`input[name="items[${item}][type]"]`).val(1);
                $(`select[name="items[${item}][products_id]"]`).attr('required', true);
                $(`#product-number-${item}`).html('');
            });
        }
        
    }).on('click', '.delete-template', function(){
        $(this).parents('.template_item').remove();
    }).on('click', '.makeNo', function(){
        target = `#${$(this).data('target')}`;
        item = $(this).data('item');
    }).on('keyup', 'form input[id$="[count]"]', function(){
        rate.calculateAmount();
    }).on('keyup', 'form input[id$="[unit_amount]"]', function(){
        rate.calculateAmount();
    }).on('change', 'form input:radio[name="invoice_types_id"]', function(){
        rate.calculateAmount();
    });
    @else
        @if($detail->sales_sold_order_statuses_id == 1)
        $('#close').click(function() {
            var id = $(this).data('id');
            Swal.fire({
                title:'確定要結案嗎?',
                icon:'warning',
                showCancelButton: true, 
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{__('backend.common.confirm')}}',
                cancelButtonText: '{{__('backend.common.cancel')}}',
            }).then(function(result){
                if(result.isConfirmed) {
                    sendApi(`${url}/${id}`,"PUT",{
                        action: "close"
                    }).then(function(){
                        location.reload();
                    });
                }
            })
        });
        @endif
    @endif
    @if(request()->sourceable_type)
        $(`select[name="sourceable_type"]`).val('{{addslashes(request()->sourceable_type)}}').trigger('change');
    @endif
</script>
@endpush