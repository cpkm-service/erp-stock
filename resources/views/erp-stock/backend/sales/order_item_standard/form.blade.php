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
                            訂購規格
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" id="order-illustrate-tab" data-bs-toggle="tab" data-bs-target="#order-illustrate" role="tab" aria-controls="order-illustrate" aria-selected="false" tabindex="-1">
                            訂購規格明細
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
                <div class="pt-2 tab-content">
                    <div class="tab-pane" id="order-illustrate" role="tabpanel" aria-labelledby="order-illustrate-tab">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>品名</th>
                                    <th>規格</th>
                                    <th>尺寸</th>
                                    <th>數量</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane active" id="btabs-static-home" role="tabpanel" aria-labelledby="btabs-alt-static-home-tab">
                        <form action="{{$form['action']}}" method="POST" name="{{$form['name']}}" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="{{$form['method']}}">
                            @csrf
                            <div class="accordion" id="order">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#orderInfo" aria-expanded="false" aria-controls="orderInfo">
                                        1. 訂單資訊
                                    </button>
                                    </h2>
                                    <div id="orderInfo" class="accordion-collapse collapse" data-bs-parent="#order">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-12 col-md-4">
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
                                                <div class="col-12 col-md-4">
                                                    <x-backend.input
                                                        :tag="$form['fields']['no']['tag']" 
                                                        :type="$form['fields']['no']['type']" 
                                                        :text="$form['fields']['no']['text']" 
                                                        :name="$form['fields']['no']['name']" 
                                                        :placeholder="$form['fields']['no']['placeholder']"
                                                        :required="($form['fields']['no']['required']??false)"
                                                        :disabled="($form['fields']['no']['disabled']??false)"
                                                        :readonly="($form['fields']['no']['readonly']??false)"
                                                        :value="($form['fields']['no']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-4">
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
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <x-backend.input
                                                        :tag="$form['fields']['product_serial']['tag']" 
                                                        :type="$form['fields']['product_serial']['type']" 
                                                        :text="$form['fields']['product_serial']['text']" 
                                                        :name="$form['fields']['product_serial']['name']" 
                                                        :placeholder="$form['fields']['product_serial']['placeholder']"
                                                        :required="($form['fields']['product_serial']['required']??false)"
                                                        :disabled="($form['fields']['product_serial']['disabled']??false)"
                                                        :readonly="($form['fields']['product_serial']['readonly']??false)"
                                                        :value="($form['fields']['product_serial']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-4">
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
                                                <div class="col-12 col-md-4">
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
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['manager_id']['children']??[])" 
                                                        :options="$form['fields']['manager_id']['options']" 
                                                        :text="$form['fields']['manager_id']['text']" 
                                                        :name="$form['fields']['manager_id']['name']" 
                                                        :placeholder="$form['fields']['manager_id']['placeholder']"
                                                        :required="$form['fields']['manager_id']['required']??false"
                                                        :disabled="($form['fields']['manager_id']['disabled']??false)"
                                                        :multiple="($form['fields']['manager_id']['multiple']??false)"
                                                        :value="($form['fields']['manager_id']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <x-backend.input
                                                        :tag="$form['fields']['customer_fax']['tag']" 
                                                        :type="$form['fields']['customer_fax']['type']" 
                                                        :text="$form['fields']['customer_fax']['text']" 
                                                        :name="$form['fields']['customer_fax']['name']" 
                                                        :placeholder="$form['fields']['customer_fax']['placeholder']"
                                                        :required="($form['fields']['customer_fax']['required']??false)"
                                                        :disabled="($form['fields']['customer_fax']['disabled']??false)"
                                                        :readonly="($form['fields']['customer_fax']['readonly']??false)"
                                                        :value="($form['fields']['customer_fax']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <x-backend.input
                                                        :tag="$form['fields']['phone']['tag']" 
                                                        :type="$form['fields']['phone']['type']" 
                                                        :text="$form['fields']['phone']['text']" 
                                                        :name="$form['fields']['phone']['name']" 
                                                        :placeholder="$form['fields']['phone']['placeholder']"
                                                        :required="($form['fields']['phone']['required']??false)"
                                                        :disabled="($form['fields']['phone']['disabled']??false)"
                                                        :value="($form['fields']['phone']['value']??'')" />
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
                                                <div class="col-12 col-md-6">
                                                    <x-backend.input
                                                        :tag="$form['fields']['text_no']['tag']" 
                                                        :type="$form['fields']['text_no']['type']" 
                                                        :text="$form['fields']['text_no']['text']" 
                                                        :name="$form['fields']['text_no']['name']" 
                                                        :placeholder="$form['fields']['text_no']['placeholder']"
                                                        :required="($form['fields']['text_no']['required']??false)"
                                                        :disabled="($form['fields']['text_no']['disabled']??false)"
                                                        :value="($form['fields']['text_no']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <x-backend.input
                                                        :tag="$form['fields']['depot']['tag']" 
                                                        :type="$form['fields']['depot']['type']" 
                                                        :text="$form['fields']['depot']['text']" 
                                                        :name="$form['fields']['depot']['name']" 
                                                        :placeholder="$form['fields']['depot']['placeholder']"
                                                        :required="($form['fields']['depot']['required']??false)"
                                                        :disabled="($form['fields']['depot']['disabled']??false)"
                                                        :value="($form['fields']['depot']['value']??'')" />
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
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pumpInfo" aria-expanded="false" aria-controls="pumpInfo">
                                        2. 水泵資訊
                                    </button>
                                    </h2>
                                    <div id="pumpInfo" class="accordion-collapse collapse " data-bs-parent="#order">
                                        <div class="accordion-body">
                                            <p class="bg-light">操作條件</p>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['liquid']['tag']" 
                                                        :type="$form['fields']['liquid']['type']" 
                                                        :text="$form['fields']['liquid']['text']" 
                                                        :name="$form['fields']['liquid']['name']" 
                                                        :placeholder="$form['fields']['liquid']['placeholder']"
                                                        :required="($form['fields']['liquid']['required']??false)"
                                                        :disabled="($form['fields']['liquid']['disabled']??false)"
                                                        :readonly="($form['fields']['liquid']['readonly']??false)"
                                                        :value="($form['fields']['liquid']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['flow']['tag']" 
                                                        :type="$form['fields']['flow']['type']" 
                                                        :text="$form['fields']['flow']['text']" 
                                                        :name="$form['fields']['flow']['name']" 
                                                        :placeholder="$form['fields']['flow']['placeholder']"
                                                        :required="($form['fields']['flow']['required']??false)"
                                                        :disabled="($form['fields']['flow']['disabled']??false)"
                                                        :readonly="($form['fields']['flow']['readonly']??false)"
                                                        :value="($form['fields']['flow']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['lift']['tag']" 
                                                        :type="$form['fields']['lift']['type']" 
                                                        :text="$form['fields']['lift']['text']" 
                                                        :name="$form['fields']['lift']['name']" 
                                                        :placeholder="$form['fields']['lift']['placeholder']"
                                                        :required="($form['fields']['lift']['required']??false)"
                                                        :disabled="($form['fields']['lift']['disabled']??false)"
                                                        :readonly="($form['fields']['lift']['readonly']??false)"
                                                        :value="($form['fields']['lift']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['particle']['tag']" 
                                                        :type="$form['fields']['particle']['type']" 
                                                        :text="$form['fields']['particle']['text']" 
                                                        :name="$form['fields']['particle']['name']" 
                                                        :placeholder="$form['fields']['particle']['placeholder']"
                                                        :required="($form['fields']['particle']['required']??false)"
                                                        :disabled="($form['fields']['particle']['disabled']??false)"
                                                        :readonly="($form['fields']['particle']['readonly']??false)"
                                                        :value="($form['fields']['particle']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['npsha']['tag']" 
                                                        :type="$form['fields']['npsha']['type']" 
                                                        :text="$form['fields']['npsha']['text']" 
                                                        :name="$form['fields']['npsha']['name']" 
                                                        :placeholder="$form['fields']['npsha']['placeholder']"
                                                        :required="($form['fields']['npsha']['required']??false)"
                                                        :disabled="($form['fields']['npsha']['disabled']??false)"
                                                        :readonly="($form['fields']['npsha']['readonly']??false)"
                                                        :value="($form['fields']['npsha']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['balance']['tag']" 
                                                        :type="$form['fields']['balance']['type']" 
                                                        :text="$form['fields']['balance']['text']" 
                                                        :name="$form['fields']['balance']['name']" 
                                                        :placeholder="$form['fields']['balance']['placeholder']"
                                                        :required="($form['fields']['balance']['required']??false)"
                                                        :disabled="($form['fields']['balance']['disabled']??false)"
                                                        :readonly="($form['fields']['balance']['readonly']??false)"
                                                        :value="($form['fields']['balance']['value']??'')" />
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
                                            <p class="bg-light">產品規格</p>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <x-backend.input
                                                        :tag="$form['fields']['pump_serial']['tag']" 
                                                        :type="$form['fields']['pump_serial']['type']" 
                                                        :text="$form['fields']['pump_serial']['text']" 
                                                        :name="$form['fields']['pump_serial']['name']" 
                                                        :placeholder="$form['fields']['pump_serial']['placeholder']"
                                                        :required="($form['fields']['pump_serial']['required']??false)"
                                                        :disabled="($form['fields']['pump_serial']['disabled']??false)"
                                                        :readonly="($form['fields']['pump_serial']['readonly']??false)"
                                                        :value="($form['fields']['pump_serial']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['order_quantity']['tag']" 
                                                        :type="$form['fields']['order_quantity']['type']" 
                                                        :text="$form['fields']['order_quantity']['text']" 
                                                        :name="$form['fields']['order_quantity']['name']" 
                                                        :placeholder="$form['fields']['order_quantity']['placeholder']"
                                                        :required="($form['fields']['order_quantity']['required']??false)"
                                                        :disabled="($form['fields']['order_quantity']['disabled']??false)"
                                                        :readonly="($form['fields']['order_quantity']['readonly']??false)"
                                                        :value="($form['fields']['order_quantity']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['rotating_speed']['tag']" 
                                                        :type="$form['fields']['rotating_speed']['type']" 
                                                        :text="$form['fields']['rotating_speed']['text']" 
                                                        :name="$form['fields']['rotating_speed']['name']" 
                                                        :placeholder="$form['fields']['rotating_speed']['placeholder']"
                                                        :required="($form['fields']['rotating_speed']['required']??false)"
                                                        :disabled="($form['fields']['rotating_speed']['disabled']??false)"
                                                        :readonly="($form['fields']['rotating_speed']['readonly']??false)"
                                                        :value="($form['fields']['rotating_speed']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['power']['tag']" 
                                                        :type="$form['fields']['power']['type']" 
                                                        :text="$form['fields']['power']['text']" 
                                                        :name="$form['fields']['power']['name']" 
                                                        :placeholder="$form['fields']['power']['placeholder']"
                                                        :required="($form['fields']['power']['required']??false)"
                                                        :disabled="($form['fields']['power']['disabled']??false)"
                                                        :readonly="($form['fields']['power']['readonly']??false)"
                                                        :value="($form['fields']['power']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['inletFlange']['children']??[])" 
                                                        :options="$form['fields']['inletFlange']['options']" 
                                                        :text="$form['fields']['inletFlange']['text']" 
                                                        :name="$form['fields']['inletFlange']['name']" 
                                                        :placeholder="$form['fields']['inletFlange']['placeholder']"
                                                        :required="$form['fields']['inletFlange']['required']??false"
                                                        :disabled="($form['fields']['inletFlange']['disabled']??false)"
                                                        :multiple="($form['fields']['inletFlange']['multiple']??false)"
                                                        :value="($form['fields']['inletFlange']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['outletFlange']['children']??[])" 
                                                        :options="$form['fields']['outletFlange']['options']" 
                                                        :text="$form['fields']['outletFlange']['text']" 
                                                        :name="$form['fields']['outletFlange']['name']" 
                                                        :placeholder="$form['fields']['outletFlange']['placeholder']"
                                                        :required="$form['fields']['outletFlange']['required']??false"
                                                        :disabled="($form['fields']['outletFlange']['disabled']??false)"
                                                        :multiple="($form['fields']['outletFlange']['multiple']??false)"
                                                        :value="($form['fields']['outletFlange']['value']??'')" />
                                                </div>
                                            </div>
                                            <p class="bg-light">材質選用</p>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['pump_shell']['children']??[])" 
                                                        :options="$form['fields']['pump_shell']['options']" 
                                                        :text="$form['fields']['pump_shell']['text']" 
                                                        :name="$form['fields']['pump_shell']['name']" 
                                                        :placeholder="$form['fields']['pump_shell']['placeholder']"
                                                        :required="$form['fields']['pump_shell']['required']??false"
                                                        :disabled="($form['fields']['pump_shell']['disabled']??false)"
                                                        :multiple="($form['fields']['pump_shell']['multiple']??false)"
                                                        :value="($form['fields']['pump_shell']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['impeller']['children']??[])" 
                                                        :options="$form['fields']['impeller']['options']" 
                                                        :text="$form['fields']['impeller']['text']" 
                                                        :name="$form['fields']['impeller']['name']" 
                                                        :placeholder="$form['fields']['impeller']['placeholder']"
                                                        :required="$form['fields']['impeller']['required']??false"
                                                        :disabled="($form['fields']['impeller']['disabled']??false)"
                                                        :multiple="($form['fields']['impeller']['multiple']??false)"
                                                        :value="($form['fields']['impeller']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['axis']['children']??[])" 
                                                        :options="$form['fields']['axis']['options']" 
                                                        :text="$form['fields']['axis']['text']" 
                                                        :name="$form['fields']['axis']['name']" 
                                                        :placeholder="$form['fields']['axis']['placeholder']"
                                                        :required="$form['fields']['axis']['required']??false"
                                                        :disabled="($form['fields']['axis']['disabled']??false)"
                                                        :multiple="($form['fields']['axis']['multiple']??false)"
                                                        :value="($form['fields']['axis']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['mechanical_shaft_seal']['children']??[])" 
                                                        :options="$form['fields']['mechanical_shaft_seal']['options']" 
                                                        :text="$form['fields']['mechanical_shaft_seal']['text']" 
                                                        :name="$form['fields']['mechanical_shaft_seal']['name']" 
                                                        :placeholder="$form['fields']['mechanical_shaft_seal']['placeholder']"
                                                        :required="$form['fields']['mechanical_shaft_seal']['required']??false"
                                                        :disabled="($form['fields']['mechanical_shaft_seal']['disabled']??false)"
                                                        :multiple="($form['fields']['mechanical_shaft_seal']['multiple']??false)"
                                                        :value="($form['fields']['mechanical_shaft_seal']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['wear_ring_quality']['children']??[])" 
                                                        :options="$form['fields']['wear_ring_quality']['options']" 
                                                        :text="$form['fields']['wear_ring_quality']['text']" 
                                                        :name="$form['fields']['wear_ring_quality']['name']" 
                                                        :placeholder="$form['fields']['wear_ring_quality']['placeholder']"
                                                        :required="$form['fields']['wear_ring_quality']['required']??false"
                                                        :disabled="($form['fields']['wear_ring_quality']['disabled']??false)"
                                                        :multiple="($form['fields']['wear_ring_quality']['multiple']??false)"
                                                        :value="($form['fields']['wear_ring_quality']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['sealing_material']['children']??[])" 
                                                        :options="$form['fields']['sealing_material']['options']" 
                                                        :text="$form['fields']['sealing_material']['text']" 
                                                        :name="$form['fields']['sealing_material']['name']" 
                                                        :placeholder="$form['fields']['sealing_material']['placeholder']"
                                                        :required="$form['fields']['sealing_material']['required']??false"
                                                        :disabled="($form['fields']['sealing_material']['disabled']??false)"
                                                        :multiple="($form['fields']['sealing_material']['multiple']??false)"
                                                        :value="($form['fields']['sealing_material']['value']??'')" />
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
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#powerInfo" aria-expanded="false" aria-controls="powerInfo">
                                        03. 動力資訊
                                    </button>
                                    </h2>
                                    <div id="powerInfo" class="accordion-collapse collapse" data-bs-parent="#order">
                                        <div class="accordion-body">
                                            <p class="bg-light">動力資訊通用項目</p>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['power_serial']['children']??[])" 
                                                        :options="$form['fields']['power_serial']['options']" 
                                                        :text="$form['fields']['power_serial']['text']" 
                                                        :name="$form['fields']['power_serial']['name']" 
                                                        :placeholder="$form['fields']['power_serial']['placeholder']"
                                                        :required="$form['fields']['power_serial']['required']??false"
                                                        :disabled="($form['fields']['power_serial']['disabled']??false)"
                                                        :multiple="($form['fields']['power_serial']['multiple']??false)"
                                                        :value="($form['fields']['power_serial']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['power_method']['tag']" 
                                                        :type="$form['fields']['power_method']['type']" 
                                                        :text="$form['fields']['power_method']['text']" 
                                                        :name="$form['fields']['power_method']['name']" 
                                                        :placeholder="$form['fields']['power_method']['placeholder']"
                                                        :required="($form['fields']['power_method']['required']??false)"
                                                        :disabled="($form['fields']['power_method']['disabled']??false)"
                                                        :readonly="($form['fields']['power_method']['readonly']??false)"
                                                        :value="($form['fields']['power_method']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['power_brand']['tag']" 
                                                        :type="$form['fields']['power_brand']['type']" 
                                                        :text="$form['fields']['power_brand']['text']" 
                                                        :name="$form['fields']['power_brand']['name']" 
                                                        :placeholder="$form['fields']['power_brand']['placeholder']"
                                                        :required="($form['fields']['power_brand']['required']??false)"
                                                        :disabled="($form['fields']['power_brand']['disabled']??false)"
                                                        :readonly="($form['fields']['power_brand']['readonly']??false)"
                                                        :value="($form['fields']['power_brand']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['horsepower']['tag']" 
                                                        :type="$form['fields']['horsepower']['type']" 
                                                        :text="$form['fields']['horsepower']['text']" 
                                                        :name="$form['fields']['horsepower']['name']" 
                                                        :placeholder="$form['fields']['horsepower']['placeholder']"
                                                        :required="($form['fields']['horsepower']['required']??false)"
                                                        :disabled="($form['fields']['horsepower']['disabled']??false)"
                                                        :readonly="($form['fields']['horsepower']['readonly']??false)"
                                                        :value="($form['fields']['horsepower']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['environmental_efficiency']['tag']" 
                                                        :type="$form['fields']['environmental_efficiency']['type']" 
                                                        :text="$form['fields']['environmental_efficiency']['text']" 
                                                        :name="$form['fields']['environmental_efficiency']['name']" 
                                                        :placeholder="$form['fields']['environmental_efficiency']['placeholder']"
                                                        :required="($form['fields']['environmental_efficiency']['required']??false)"
                                                        :disabled="($form['fields']['environmental_efficiency']['disabled']??false)"
                                                        :readonly="($form['fields']['environmental_efficiency']['readonly']??false)"
                                                        :value="($form['fields']['environmental_efficiency']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['power_common_rotating_speed']['tag']" 
                                                        :type="$form['fields']['power_common_rotating_speed']['type']" 
                                                        :text="$form['fields']['power_common_rotating_speed']['text']" 
                                                        :name="$form['fields']['power_common_rotating_speed']['name']" 
                                                        :placeholder="$form['fields']['power_common_rotating_speed']['placeholder']"
                                                        :required="($form['fields']['power_common_rotating_speed']['required']??false)"
                                                        :disabled="($form['fields']['power_common_rotating_speed']['disabled']??false)"
                                                        :readonly="($form['fields']['power_common_rotating_speed']['readonly']??false)"
                                                        :value="($form['fields']['power_common_rotating_speed']['value']??'')" />
                                                </div>
                                            </div>
                                            <p class="bg-light">馬達附屬項</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <x-backend.select 
                                                        :children="($form['fields']['motor_serial']['children']??[])" 
                                                        :options="$form['fields']['motor_serial']['options']" 
                                                        :text="$form['fields']['motor_serial']['text']" 
                                                        :name="$form['fields']['motor_serial']['name']" 
                                                        :placeholder="$form['fields']['motor_serial']['placeholder']"
                                                        :required="$form['fields']['motor_serial']['required']??false"
                                                        :disabled="($form['fields']['motor_serial']['disabled']??false)"
                                                        :multiple="($form['fields']['motor_serial']['multiple']??false)"
                                                        :value="($form['fields']['motor_serial']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['motor_poles']['tag']" 
                                                        :type="$form['fields']['motor_poles']['type']" 
                                                        :text="$form['fields']['motor_poles']['text']" 
                                                        :name="$form['fields']['motor_poles']['name']" 
                                                        :placeholder="$form['fields']['motor_poles']['placeholder']"
                                                        :required="($form['fields']['motor_poles']['required']??false)"
                                                        :disabled="($form['fields']['motor_poles']['disabled']??false)"
                                                        :readonly="($form['fields']['motor_poles']['readonly']??false)"
                                                        :value="($form['fields']['motor_poles']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['motor_start']['tag']" 
                                                        :type="$form['fields']['motor_start']['type']" 
                                                        :text="$form['fields']['motor_start']['text']" 
                                                        :name="$form['fields']['motor_start']['name']" 
                                                        :placeholder="$form['fields']['motor_start']['placeholder']"
                                                        :required="($form['fields']['motor_start']['required']??false)"
                                                        :disabled="($form['fields']['motor_start']['disabled']??false)"
                                                        :readonly="($form['fields']['motor_start']['readonly']??false)"
                                                        :value="($form['fields']['motor_start']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['rated_voltage']['tag']" 
                                                        :type="$form['fields']['rated_voltage']['type']" 
                                                        :text="$form['fields']['rated_voltage']['text']" 
                                                        :name="$form['fields']['rated_voltage']['name']" 
                                                        :placeholder="$form['fields']['rated_voltage']['placeholder']"
                                                        :required="($form['fields']['rated_voltage']['required']??false)"
                                                        :disabled="($form['fields']['rated_voltage']['disabled']??false)"
                                                        :readonly="($form['fields']['rated_voltage']['readonly']??false)"
                                                        :value="($form['fields']['rated_voltage']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['Insulation_level']['tag']" 
                                                        :type="$form['fields']['Insulation_level']['type']" 
                                                        :text="$form['fields']['Insulation_level']['text']" 
                                                        :name="$form['fields']['Insulation_level']['name']" 
                                                        :placeholder="$form['fields']['Insulation_level']['placeholder']"
                                                        :required="($form['fields']['Insulation_level']['required']??false)"
                                                        :disabled="($form['fields']['Insulation_level']['disabled']??false)"
                                                        :readonly="($form['fields']['Insulation_level']['readonly']??false)"
                                                        :value="($form['fields']['Insulation_level']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['use_coefficient']['tag']" 
                                                        :type="$form['fields']['use_coefficient']['type']" 
                                                        :text="$form['fields']['use_coefficient']['text']" 
                                                        :name="$form['fields']['use_coefficient']['name']" 
                                                        :placeholder="$form['fields']['use_coefficient']['placeholder']"
                                                        :required="($form['fields']['use_coefficient']['required']??false)"
                                                        :disabled="($form['fields']['use_coefficient']['disabled']??false)"
                                                        :readonly="($form['fields']['use_coefficient']['readonly']??false)"
                                                        :value="($form['fields']['use_coefficient']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['knots']['tag']" 
                                                        :type="$form['fields']['knots']['type']" 
                                                        :text="$form['fields']['knots']['text']" 
                                                        :name="$form['fields']['knots']['name']" 
                                                        :placeholder="$form['fields']['knots']['placeholder']"
                                                        :required="($form['fields']['knots']['required']??false)"
                                                        :disabled="($form['fields']['knots']['disabled']??false)"
                                                        :readonly="($form['fields']['knots']['readonly']??false)"
                                                        :value="($form['fields']['knots']['value']??'')" />
                                                </div>
                                            </div>
                                            <p class="bg-light">引擎附屬項</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <x-backend.select 
                                                        :children="($form['fields']['engine_serial']['children']??[])" 
                                                        :options="$form['fields']['engine_serial']['options']" 
                                                        :text="$form['fields']['engine_serial']['text']" 
                                                        :name="$form['fields']['engine_serial']['name']" 
                                                        :placeholder="$form['fields']['engine_serial']['placeholder']"
                                                        :required="$form['fields']['engine_serial']['required']??false"
                                                        :disabled="($form['fields']['engine_serial']['disabled']??false)"
                                                        :multiple="($form['fields']['engine_serial']['multiple']??false)"
                                                        :value="($form['fields']['engine_serial']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                            :children="($form['fields']['turn']['children']??[])" 
                                                            :options="$form['fields']['turn']['options']" 
                                                            :text="$form['fields']['turn']['text']" 
                                                            :name="$form['fields']['turn']['name']" 
                                                            :placeholder="$form['fields']['turn']['placeholder']"
                                                            :required="$form['fields']['turn']['required']??false"
                                                            :disabled="($form['fields']['turn']['disabled']??false)"
                                                            :multiple="($form['fields']['turn']['multiple']??false)"
                                                            :value="($form['fields']['turn']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['displacement']['children']??[])" 
                                                        :options="$form['fields']['displacement']['options']" 
                                                        :text="$form['fields']['displacement']['text']" 
                                                        :name="$form['fields']['displacement']['name']" 
                                                        :placeholder="$form['fields']['displacement']['placeholder']"
                                                        :required="$form['fields']['displacement']['required']??false"
                                                        :disabled="($form['fields']['displacement']['disabled']??false)"
                                                        :multiple="($form['fields']['displacement']['multiple']??false)"
                                                        :value="($form['fields']['displacement']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['full_load_fuel_consumption']['children']??[])" 
                                                        :options="$form['fields']['full_load_fuel_consumption']['options']" 
                                                        :text="$form['fields']['full_load_fuel_consumption']['text']" 
                                                        :name="$form['fields']['full_load_fuel_consumption']['name']" 
                                                        :placeholder="$form['fields']['full_load_fuel_consumption']['placeholder']"
                                                        :required="$form['fields']['full_load_fuel_consumption']['required']??false"
                                                        :disabled="($form['fields']['full_load_fuel_consumption']['disabled']??false)"
                                                        :multiple="($form['fields']['full_load_fuel_consumption']['multiple']??false)"
                                                        :value="($form['fields']['full_load_fuel_consumption']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['silencer']['tag']" 
                                                        :type="$form['fields']['silencer']['type']" 
                                                        :text="$form['fields']['silencer']['text']" 
                                                        :name="$form['fields']['silencer']['name']" 
                                                        :placeholder="$form['fields']['silencer']['placeholder']"
                                                        :required="($form['fields']['silencer']['required']??false)"
                                                        :disabled="($form['fields']['silencer']['disabled']??false)"
                                                        :readonly="($form['fields']['silencer']['readonly']??false)"
                                                        :value="($form['fields']['silencer']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['range_of_rotation']['tag']" 
                                                        :type="$form['fields']['range_of_rotation']['type']" 
                                                        :text="$form['fields']['range_of_rotation']['text']" 
                                                        :name="$form['fields']['range_of_rotation']['name']" 
                                                        :placeholder="$form['fields']['range_of_rotation']['placeholder']"
                                                        :required="($form['fields']['range_of_rotation']['required']??false)"
                                                        :disabled="($form['fields']['range_of_rotation']['disabled']??false)"
                                                        :readonly="($form['fields']['range_of_rotation']['readonly']??false)"
                                                        :value="($form['fields']['range_of_rotation']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['battery_voltage']['children']??[])" 
                                                        :options="$form['fields']['battery_voltage']['options']" 
                                                        :text="$form['fields']['battery_voltage']['text']" 
                                                        :name="$form['fields']['battery_voltage']['name']" 
                                                        :placeholder="$form['fields']['battery_voltage']['placeholder']"
                                                        :required="$form['fields']['battery_voltage']['required']??false"
                                                        :disabled="($form['fields']['battery_voltage']['disabled']??false)"
                                                        :multiple="($form['fields']['battery_voltage']['multiple']??false)"
                                                        :value="($form['fields']['battery_voltage']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['lubricating_oil']['children']??[])" 
                                                        :options="$form['fields']['lubricating_oil']['options']" 
                                                        :text="$form['fields']['lubricating_oil']['text']" 
                                                        :name="$form['fields']['lubricating_oil']['name']" 
                                                        :placeholder="$form['fields']['lubricating_oil']['placeholder']"
                                                        :required="$form['fields']['lubricating_oil']['required']??false"
                                                        :disabled="($form['fields']['lubricating_oil']['disabled']??false)"
                                                        :multiple="($form['fields']['lubricating_oil']['multiple']??false)"
                                                        :value="($form['fields']['lubricating_oil']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['second_water_tank']['children']??[])" 
                                                        :options="$form['fields']['second_water_tank']['options']" 
                                                        :text="$form['fields']['second_water_tank']['text']" 
                                                        :name="$form['fields']['second_water_tank']['name']" 
                                                        :placeholder="$form['fields']['second_water_tank']['placeholder']"
                                                        :required="$form['fields']['second_water_tank']['required']??false"
                                                        :disabled="($form['fields']['second_water_tank']['disabled']??false)"
                                                        :multiple="($form['fields']['second_water_tank']['multiple']??false)"
                                                        :value="($form['fields']['second_water_tank']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['cooling_method']['children']??[])" 
                                                        :options="$form['fields']['cooling_method']['options']" 
                                                        :text="$form['fields']['cooling_method']['text']" 
                                                        :name="$form['fields']['cooling_method']['name']" 
                                                        :placeholder="$form['fields']['cooling_method']['placeholder']"
                                                        :required="$form['fields']['cooling_method']['required']??false"
                                                        :disabled="($form['fields']['cooling_method']['disabled']??false)"
                                                        :multiple="($form['fields']['cooling_method']['multiple']??false)"
                                                        :value="($form['fields']['cooling_method']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['engine_form']['children']??[])" 
                                                        :options="$form['fields']['engine_form']['options']" 
                                                        :text="$form['fields']['engine_form']['text']" 
                                                        :name="$form['fields']['engine_form']['name']" 
                                                        :placeholder="$form['fields']['engine_form']['placeholder']"
                                                        :required="$form['fields']['engine_form']['required']??false"
                                                        :disabled="($form['fields']['engine_form']['disabled']??false)"
                                                        :multiple="($form['fields']['engine_form']['multiple']??false)"
                                                        :value="($form['fields']['engine_form']['value']??'')" />
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
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#controlSystem" aria-expanded="false" aria-controls="controlSystem">
                                        04. 控制資訊
                                    </button>
                                    </h2>
                                    <div id="controlSystem" class="accordion-collapse collapse" data-bs-parent="#order">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['product_serial']['tag']" 
                                                        :type="$form['fields']['product_serial']['type']" 
                                                        :text="$form['fields']['product_serial']['text']" 
                                                        :name="$form['fields']['product_serial']['name']" 
                                                        :placeholder="$form['fields']['product_serial']['placeholder']"
                                                        :required="($form['fields']['product_serial']['required']??false)"
                                                        :disabled="($form['fields']['product_serial']['disabled']??false)"
                                                        :readonly="($form['fields']['product_serial']['readonly']??false)"
                                                        :value="($form['fields']['product_serial']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['control']['children']??[])" 
                                                        :options="$form['fields']['control']['options']" 
                                                        :text="$form['fields']['control']['text']" 
                                                        :name="$form['fields']['control']['name']" 
                                                        :placeholder="$form['fields']['control']['placeholder']"
                                                        :required="$form['fields']['control']['required']??false"
                                                        :disabled="($form['fields']['control']['disabled']??false)"
                                                        :multiple="($form['fields']['control']['multiple']??false)"
                                                        :value="($form['fields']['control']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['stop_mode']['children']??[])" 
                                                        :options="$form['fields']['stop_mode']['options']" 
                                                        :text="$form['fields']['stop_mode']['text']" 
                                                        :name="$form['fields']['stop_mode']['name']" 
                                                        :placeholder="$form['fields']['stop_mode']['placeholder']"
                                                        :required="$form['fields']['stop_mode']['required']??false"
                                                        :disabled="($form['fields']['stop_mode']['disabled']??false)"
                                                        :multiple="($form['fields']['stop_mode']['multiple']??false)"
                                                        :value="($form['fields']['stop_mode']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['power_standrad']['children']??[])" 
                                                        :options="$form['fields']['power_standrad']['options']" 
                                                        :text="$form['fields']['power_standrad']['text']" 
                                                        :name="$form['fields']['power_standrad']['name']" 
                                                        :placeholder="$form['fields']['power_standrad']['placeholder']"
                                                        :required="$form['fields']['power_standrad']['required']??false"
                                                        :disabled="($form['fields']['power_standrad']['disabled']??false)"
                                                        :multiple="($form['fields']['power_standrad']['multiple']??false)"
                                                        :value="($form['fields']['power_standrad']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['iot_standard']['children']??[])" 
                                                        :options="$form['fields']['iot_standard']['options']" 
                                                        :text="$form['fields']['iot_standard']['text']" 
                                                        :name="$form['fields']['iot_standard']['name']" 
                                                        :placeholder="$form['fields']['iot_standard']['placeholder']"
                                                        :required="$form['fields']['iot_standard']['required']??false"
                                                        :disabled="($form['fields']['iot_standard']['disabled']??false)"
                                                        :multiple="($form['fields']['iot_standard']['multiple']??false)"
                                                        :value="($form['fields']['iot_standard']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['power_backup']['children']??[])" 
                                                        :options="$form['fields']['power_backup']['options']" 
                                                        :text="$form['fields']['power_backup']['text']" 
                                                        :name="$form['fields']['power_backup']['name']" 
                                                        :placeholder="$form['fields']['power_backup']['placeholder']"
                                                        :required="$form['fields']['power_backup']['required']??false"
                                                        :disabled="($form['fields']['power_backup']['disabled']??false)"
                                                        :multiple="($form['fields']['power_backup']['multiple']??false)"
                                                        :value="($form['fields']['power_backup']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['additional_requirements']['children']??[])" 
                                                        :options="$form['fields']['additional_requirements']['options']" 
                                                        :text="$form['fields']['additional_requirements']['text']" 
                                                        :name="$form['fields']['additional_requirements']['name']" 
                                                        :placeholder="$form['fields']['additional_requirements']['placeholder']"
                                                        :required="$form['fields']['additional_requirements']['required']??false"
                                                        :disabled="($form['fields']['additional_requirements']['disabled']??false)"
                                                        :multiple="($form['fields']['additional_requirements']['multiple']??false)"
                                                        :value="($form['fields']['additional_requirements']['value']??'')" />
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
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#vacuumSystem" aria-expanded="false" aria-controls="vacuumSystem">
                                        05. 真空系統
                                    </button>
                                    </h2>
                                    <div id="vacuumSystem" class="accordion-collapse collapse" data-bs-parent="#order">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['product_serial']['tag']" 
                                                        :type="$form['fields']['product_serial']['type']" 
                                                        :text="$form['fields']['product_serial']['text']" 
                                                        :name="$form['fields']['product_serial']['name']" 
                                                        :placeholder="$form['fields']['product_serial']['placeholder']"
                                                        :required="($form['fields']['product_serial']['required']??false)"
                                                        :disabled="($form['fields']['product_serial']['disabled']??false)"
                                                        :readonly="($form['fields']['product_serial']['readonly']??false)"
                                                        :value="($form['fields']['product_serial']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['air_pipe_diameter']['children']??[])" 
                                                        :options="$form['fields']['air_pipe_diameter']['options']" 
                                                        :text="$form['fields']['air_pipe_diameter']['text']" 
                                                        :name="$form['fields']['air_pipe_diameter']['name']" 
                                                        :placeholder="$form['fields']['air_pipe_diameter']['placeholder']"
                                                        :required="$form['fields']['air_pipe_diameter']['required']??false"
                                                        :disabled="($form['fields']['air_pipe_diameter']['disabled']??false)"
                                                        :multiple="($form['fields']['air_pipe_diameter']['multiple']??false)"
                                                        :value="($form['fields']['air_pipe_diameter']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['vacuum_generator']['children']??[])" 
                                                        :options="$form['fields']['vacuum_generator']['options']" 
                                                        :text="$form['fields']['vacuum_generator']['text']" 
                                                        :name="$form['fields']['vacuum_generator']['name']" 
                                                        :placeholder="$form['fields']['vacuum_generator']['placeholder']"
                                                        :required="$form['fields']['vacuum_generator']['required']??false"
                                                        :disabled="($form['fields']['vacuum_generator']['disabled']??false)"
                                                        :multiple="($form['fields']['vacuum_generator']['multiple']??false)"
                                                        :value="($form['fields']['vacuum_generator']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['generator_horsepower']['children']??[])" 
                                                        :options="$form['fields']['generator_horsepower']['options']" 
                                                        :text="$form['fields']['generator_horsepower']['text']" 
                                                        :name="$form['fields']['generator_horsepower']['name']" 
                                                        :placeholder="$form['fields']['generator_horsepower']['placeholder']"
                                                        :required="$form['fields']['generator_horsepower']['required']??false"
                                                        :disabled="($form['fields']['generator_horsepower']['disabled']??false)"
                                                        :multiple="($form['fields']['generator_horsepower']['multiple']??false)"
                                                        :value="($form['fields']['generator_horsepower']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['electromagnetic_clutch']['children']??[])" 
                                                        :options="$form['fields']['electromagnetic_clutch']['options']" 
                                                        :text="$form['fields']['electromagnetic_clutch']['text']" 
                                                        :name="$form['fields']['electromagnetic_clutch']['name']" 
                                                        :placeholder="$form['fields']['electromagnetic_clutch']['placeholder']"
                                                        :required="$form['fields']['electromagnetic_clutch']['required']??false"
                                                        :disabled="($form['fields']['electromagnetic_clutch']['disabled']??false)"
                                                        :multiple="($form['fields']['electromagnetic_clutch']['multiple']??false)"
                                                        :value="($form['fields']['electromagnetic_clutch']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['gas_water_separator']['children']??[])" 
                                                        :options="$form['fields']['gas_water_separator']['options']" 
                                                        :text="$form['fields']['gas_water_separator']['text']" 
                                                        :name="$form['fields']['gas_water_separator']['name']" 
                                                        :placeholder="$form['fields']['gas_water_separator']['placeholder']"
                                                        :required="$form['fields']['gas_water_separator']['required']??false"
                                                        :disabled="($form['fields']['gas_water_separator']['disabled']??false)"
                                                        :multiple="($form['fields']['gas_water_separator']['multiple']??false)"
                                                        :value="($form['fields']['gas_water_separator']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['check_valve_specifications']['children']??[])" 
                                                        :options="$form['fields']['check_valve_specifications']['options']" 
                                                        :text="$form['fields']['check_valve_specifications']['text']" 
                                                        :name="$form['fields']['check_valve_specifications']['name']" 
                                                        :placeholder="$form['fields']['check_valve_specifications']['placeholder']"
                                                        :required="$form['fields']['check_valve_specifications']['required']??false"
                                                        :disabled="($form['fields']['check_valve_specifications']['disabled']??false)"
                                                        :multiple="($form['fields']['check_valve_specifications']['multiple']??false)"
                                                        :value="($form['fields']['check_valve_specifications']['value']??'')" />
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
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#transmissionSystem" aria-expanded="false" aria-controls="transmissionSystem">
                                        06. 傳動系統
                                    </button>
                                    </h2>
                                    <div id="transmissionSystem" class="accordion-collapse collapse" data-bs-parent="#order">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <x-backend.input
                                                        :tag="$form['fields']['reducer']['tag']" 
                                                        :type="$form['fields']['reducer']['type']" 
                                                        :text="$form['fields']['reducer']['text']" 
                                                        :name="$form['fields']['reducer']['name']" 
                                                        :placeholder="$form['fields']['reducer']['placeholder']"
                                                        :required="($form['fields']['reducer']['required']??false)"
                                                        :disabled="($form['fields']['reducer']['disabled']??false)"
                                                        :readonly="($form['fields']['reducer']['readonly']??false)"
                                                        :value="($form['fields']['reducer']['value']??'')" />
                                                </div>
                                            </div>
                                            <p class="bg-light">聯軸器規格</p>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['product_properties']['tag']" 
                                                        :type="$form['fields']['product_properties']['type']" 
                                                        :text="$form['fields']['product_properties']['text']" 
                                                        :name="$form['fields']['product_properties']['name']" 
                                                        :placeholder="$form['fields']['product_properties']['placeholder']"
                                                        :required="($form['fields']['product_properties']['required']??false)"
                                                        :disabled="($form['fields']['product_properties']['disabled']??false)"
                                                        :readonly="($form['fields']['product_properties']['readonly']??false)"
                                                        :value="($form['fields']['product_properties']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['brand_model_number']['children']??[])" 
                                                        :options="$form['fields']['brand_model_number']['options']" 
                                                        :text="$form['fields']['brand_model_number']['text']" 
                                                        :name="$form['fields']['brand_model_number']['name']" 
                                                        :placeholder="$form['fields']['brand_model_number']['placeholder']"
                                                        :required="$form['fields']['brand_model_number']['required']??false"
                                                        :disabled="($form['fields']['brand_model_number']['disabled']??false)"
                                                        :multiple="($form['fields']['brand_model_number']['multiple']??false)"
                                                        :value="($form['fields']['brand_model_number']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['deviation_angle']['children']??[])" 
                                                        :options="$form['fields']['deviation_angle']['options']" 
                                                        :text="$form['fields']['deviation_angle']['text']" 
                                                        :name="$form['fields']['deviation_angle']['name']" 
                                                        :placeholder="$form['fields']['deviation_angle']['placeholder']"
                                                        :required="$form['fields']['deviation_angle']['required']??false"
                                                        :disabled="($form['fields']['deviation_angle']['disabled']??false)"
                                                        :multiple="($form['fields']['deviation_angle']['multiple']??false)"
                                                        :value="($form['fields']['deviation_angle']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['parallel_deviation']['children']??[])" 
                                                        :options="$form['fields']['parallel_deviation']['options']" 
                                                        :text="$form['fields']['parallel_deviation']['text']" 
                                                        :name="$form['fields']['parallel_deviation']['name']" 
                                                        :placeholder="$form['fields']['parallel_deviation']['placeholder']"
                                                        :required="$form['fields']['parallel_deviation']['required']??false"
                                                        :disabled="($form['fields']['parallel_deviation']['disabled']??false)"
                                                        :multiple="($form['fields']['parallel_deviation']['multiple']??false)"
                                                        :value="($form['fields']['parallel_deviation']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['axial_telescopic']['children']??[])" 
                                                        :options="$form['fields']['axial_telescopic']['options']" 
                                                        :text="$form['fields']['axial_telescopic']['text']" 
                                                        :name="$form['fields']['axial_telescopic']['name']" 
                                                        :placeholder="$form['fields']['axial_telescopic']['placeholder']"
                                                        :required="$form['fields']['axial_telescopic']['required']??false"
                                                        :disabled="($form['fields']['axial_telescopic']['disabled']??false)"
                                                        :multiple="($form['fields']['axial_telescopic']['multiple']??false)"
                                                        :value="($form['fields']['axial_telescopic']['value']??'')" />
                                                </div>
                                            </div>
                                            
                                            <p class="bg-light">傳動規格</p>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['transfer_method']['children']??[])" 
                                                        :options="$form['fields']['transfer_method']['options']" 
                                                        :text="$form['fields']['transfer_method']['text']" 
                                                        :name="$form['fields']['transfer_method']['name']" 
                                                        :placeholder="$form['fields']['transfer_method']['placeholder']"
                                                        :required="$form['fields']['transfer_method']['required']??false"
                                                        :disabled="($form['fields']['transfer_method']['disabled']??false)"
                                                        :multiple="($form['fields']['transfer_method']['multiple']??false)"
                                                        :value="($form['fields']['transfer_method']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['product_number']['children']??[])" 
                                                        :options="$form['fields']['product_number']['options']" 
                                                        :text="$form['fields']['product_number']['text']" 
                                                        :name="$form['fields']['product_number']['name']" 
                                                        :placeholder="$form['fields']['product_number']['placeholder']"
                                                        :required="$form['fields']['product_number']['required']??false"
                                                        :disabled="($form['fields']['product_number']['disabled']??false)"
                                                        :multiple="($form['fields']['product_number']['multiple']??false)"
                                                        :value="($form['fields']['product_number']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['reduction_ratio']['children']??[])" 
                                                        :options="$form['fields']['reduction_ratio']['options']" 
                                                        :text="$form['fields']['reduction_ratio']['text']" 
                                                        :name="$form['fields']['reduction_ratio']['name']" 
                                                        :placeholder="$form['fields']['reduction_ratio']['placeholder']"
                                                        :required="$form['fields']['reduction_ratio']['required']??false"
                                                        :disabled="($form['fields']['reduction_ratio']['disabled']??false)"
                                                        :multiple="($form['fields']['reduction_ratio']['multiple']??false)"
                                                        :value="($form['fields']['reduction_ratio']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['maximum_transmission']['children']??[])" 
                                                        :options="$form['fields']['maximum_transmission']['options']" 
                                                        :text="$form['fields']['maximum_transmission']['text']" 
                                                        :name="$form['fields']['maximum_transmission']['name']" 
                                                        :placeholder="$form['fields']['maximum_transmission']['placeholder']"
                                                        :required="$form['fields']['maximum_transmission']['required']??false"
                                                        :disabled="($form['fields']['maximum_transmission']['disabled']??false)"
                                                        :multiple="($form['fields']['maximum_transmission']['multiple']??false)"
                                                        :value="($form['fields']['maximum_transmission']['value']??'')" />
                                                </div>
                                            </div>
                                            <p class="bg-light">材質選用</p>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['bearing_life']['tag']" 
                                                        :type="$form['fields']['bearing_life']['type']" 
                                                        :text="$form['fields']['bearing_life']['text']" 
                                                        :name="$form['fields']['bearing_life']['name']" 
                                                        :placeholder="$form['fields']['bearing_life']['placeholder']"
                                                        :required="($form['fields']['bearing_life']['required']??false)"
                                                        :disabled="($form['fields']['bearing_life']['disabled']??false)"
                                                        :readonly="($form['fields']['bearing_life']['readonly']??false)"
                                                        :value="($form['fields']['bearing_life']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['shell_material']['tag']" 
                                                        :type="$form['fields']['shell_material']['type']" 
                                                        :text="$form['fields']['shell_material']['text']" 
                                                        :name="$form['fields']['shell_material']['name']" 
                                                        :placeholder="$form['fields']['shell_material']['placeholder']"
                                                        :required="($form['fields']['shell_material']['required']??false)"
                                                        :disabled="($form['fields']['shell_material']['disabled']??false)"
                                                        :readonly="($form['fields']['shell_material']['readonly']??false)"
                                                        :value="($form['fields']['shell_material']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['vacuum_puri']['tag']" 
                                                        :type="$form['fields']['vacuum_puri']['type']" 
                                                        :text="$form['fields']['vacuum_puri']['text']" 
                                                        :name="$form['fields']['vacuum_puri']['name']" 
                                                        :placeholder="$form['fields']['vacuum_puri']['placeholder']"
                                                        :required="($form['fields']['vacuum_puri']['required']??false)"
                                                        :disabled="($form['fields']['vacuum_puri']['disabled']??false)"
                                                        :readonly="($form['fields']['vacuum_puri']['readonly']??false)"
                                                        :value="($form['fields']['vacuum_puri']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['vacuum_belt']['tag']" 
                                                        :type="$form['fields']['vacuum_belt']['type']" 
                                                        :text="$form['fields']['vacuum_belt']['text']" 
                                                        :name="$form['fields']['vacuum_belt']['name']" 
                                                        :placeholder="$form['fields']['vacuum_belt']['placeholder']"
                                                        :required="($form['fields']['vacuum_belt']['required']??false)"
                                                        :disabled="($form['fields']['vacuum_belt']['disabled']??false)"
                                                        :readonly="($form['fields']['vacuum_belt']['readonly']??false)"
                                                        :value="($form['fields']['vacuum_belt']['value']??'')" />
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
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#platformSystem" aria-expanded="false" aria-controls="platformSystem">
                                        07. 平台系統
                                    </button>
                                    </h2>
                                    <div id="platformSystem" class="accordion-collapse collapse" data-bs-parent="#order">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['model']['tag']" 
                                                        :type="$form['fields']['model']['type']" 
                                                        :text="$form['fields']['model']['text']" 
                                                        :name="$form['fields']['model']['name']" 
                                                        :placeholder="$form['fields']['model']['placeholder']"
                                                        :required="($form['fields']['model']['required']??false)"
                                                        :disabled="($form['fields']['model']['disabled']??false)"
                                                        :readonly="($form['fields']['model']['readonly']??false)"
                                                        :value="($form['fields']['model']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['pump_diameter']['children']??[])" 
                                                        :options="$form['fields']['pump_diameter']['options']" 
                                                        :text="$form['fields']['pump_diameter']['text']" 
                                                        :name="$form['fields']['pump_diameter']['name']" 
                                                        :placeholder="$form['fields']['pump_diameter']['placeholder']"
                                                        :required="$form['fields']['pump_diameter']['required']??false"
                                                        :disabled="($form['fields']['pump_diameter']['disabled']??false)"
                                                        :multiple="($form['fields']['pump_diameter']['multiple']??false)"
                                                        :value="($form['fields']['pump_diameter']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['power_code']['children']??[])" 
                                                        :options="$form['fields']['power_code']['options']" 
                                                        :text="$form['fields']['power_code']['text']" 
                                                        :name="$form['fields']['power_code']['name']" 
                                                        :placeholder="$form['fields']['power_code']['placeholder']"
                                                        :required="$form['fields']['power_code']['required']??false"
                                                        :disabled="($form['fields']['power_code']['disabled']??false)"
                                                        :multiple="($form['fields']['power_code']['multiple']??false)"
                                                        :value="($form['fields']['power_code']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['platform_architecture']['children']??[])" 
                                                        :options="$form['fields']['platform_architecture']['options']" 
                                                        :text="$form['fields']['platform_architecture']['text']" 
                                                        :name="$form['fields']['platform_architecture']['name']" 
                                                        :placeholder="$form['fields']['platform_architecture']['placeholder']"
                                                        :required="$form['fields']['platform_architecture']['required']??false"
                                                        :disabled="($form['fields']['platform_architecture']['disabled']??false)"
                                                        :multiple="($form['fields']['platform_architecture']['multiple']??false)"
                                                        :value="($form['fields']['platform_architecture']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.select 
                                                        :children="($form['fields']['platform_accessories']['children']??[])" 
                                                        :options="$form['fields']['platform_accessories']['options']" 
                                                        :text="$form['fields']['platform_accessories']['text']" 
                                                        :name="$form['fields']['platform_accessories']['name']" 
                                                        :placeholder="$form['fields']['platform_accessories']['placeholder']"
                                                        :required="$form['fields']['platform_accessories']['required']??false"
                                                        :disabled="($form['fields']['platform_accessories']['disabled']??false)"
                                                        :multiple="($form['fields']['platform_accessories']['multiple']??false)"
                                                        :value="($form['fields']['platform_accessories']['value']??'')" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#painting" aria-expanded="false" aria-controls="painting">
                                        08. 塗裝要求
                                    </button>
                                    </h2>
                                    <div id="painting" class="accordion-collapse collapse" data-bs-parent="#order">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['primer']['tag']" 
                                                        :type="$form['fields']['primer']['type']" 
                                                        :text="$form['fields']['primer']['text']" 
                                                        :name="$form['fields']['primer']['name']" 
                                                        :placeholder="$form['fields']['primer']['placeholder']"
                                                        :required="($form['fields']['primer']['required']??false)"
                                                        :disabled="($form['fields']['primer']['disabled']??false)"
                                                        :readonly="($form['fields']['primer']['readonly']??false)"
                                                        :value="($form['fields']['primer']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <x-backend.input
                                                        :tag="$form['fields']['topcoat']['tag']" 
                                                        :type="$form['fields']['topcoat']['type']" 
                                                        :text="$form['fields']['topcoat']['text']" 
                                                        :name="$form['fields']['topcoat']['name']" 
                                                        :placeholder="$form['fields']['topcoat']['placeholder']"
                                                        :required="($form['fields']['topcoat']['required']??false)"
                                                        :disabled="($form['fields']['topcoat']['disabled']??false)"
                                                        :readonly="($form['fields']['topcoat']['readonly']??false)"
                                                        :value="($form['fields']['topcoat']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>項目</td>
                                                            @foreach($sales_item_categories->settings as $setting)
                                                            <td>{{$setting->name}}</td>
                                                            @endforeach
                                                        </tr>
                                                        @foreach($sales_item_categories->items as $category)
                                                        <tr>
                                                            <td>{{$category->name}}</td>
                                                            @foreach($sales_item_categories->settings as $setting)
                                                            <td>
                                                                <x-backend.select 
                                                                    :children="($form['fields']['painting_items'][$category->id][$setting->id]['sales_order_item_option_items_id']['children']??[])" 
                                                                    :options="$form['fields']['painting_items'][$category->id][$setting->id]['sales_order_item_option_items_id']['options']" 
                                                                    :text="$form['fields']['painting_items'][$category->id][$setting->id]['sales_order_item_option_items_id']['text']" 
                                                                    :name="$form['fields']['painting_items'][$category->id][$setting->id]['sales_order_item_option_items_id']['name']" 
                                                                    :placeholder="$form['fields']['painting_items'][$category->id][$setting->id]['sales_order_item_option_items_id']['placeholder']"
                                                                    :required="$form['fields']['painting_items'][$category->id][$setting->id]['sales_order_item_option_items_id']['required']??false"
                                                                    :disabled="($form['fields']['painting_items'][$category->id][$setting->id]['sales_order_item_option_items_id']['disabled']??false)"
                                                                    :multiple="($form['fields']['painting_items'][$category->id][$setting->id]['sales_order_item_option_items_id']['multiple']??false)"
                                                                    :value="($form['fields']['painting_items'][$category->id][$setting->id]['sales_order_item_option_items_id']['value']??'')" />
                                                            </td>
                                                            @endforeach
                                                        </tr>
                                                        @endforeach
                                                    </table>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#shop" aria-expanded="false" aria-controls="shop">
                                        09. 選購配件
                                    </button>
                                    </h2>
                                    <div id="shop" class="accordion-collapse collapse" data-bs-parent="#order">
                                        <div class="accordion-body">
                                            <p class="bg-light">快速連結座、接頭型式與數量</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>
                                                                {{__('backend.sales_order_item_standards.connector_type')}}
                                                            </td>
                                                            <td>
                                                                數量
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <x-backend.select 
                                                                    :children="($form['fields']['connector_type']['children']??[])" 
                                                                    :options="$form['fields']['connector_type']['options']" 
                                                                    :text="$form['fields']['connector_type']['text']" 
                                                                    :name="$form['fields']['connector_type']['name']" 
                                                                    :placeholder="$form['fields']['connector_type']['placeholder']"
                                                                    :required="$form['fields']['connector_type']['required']??false"
                                                                    :disabled="($form['fields']['connector_type']['disabled']??false)"
                                                                    :multiple="($form['fields']['connector_type']['multiple']??false)"
                                                                    :value="($form['fields']['connector_type']['value']??'')" />
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <p class="bg-light">材質與規格</p>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <x-backend.select 
                                                        :children="($form['fields']['connector_material']['children']??[])" 
                                                        :options="$form['fields']['connector_material']['options']" 
                                                        :text="$form['fields']['connector_material']['text']" 
                                                        :name="$form['fields']['connector_material']['name']" 
                                                        :placeholder="$form['fields']['connector_material']['placeholder']"
                                                        :required="$form['fields']['connector_material']['required']??false"
                                                        :disabled="($form['fields']['connector_material']['disabled']??false)"
                                                        :multiple="($form['fields']['connector_material']['multiple']??false)"
                                                        :value="($form['fields']['connector_material']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <x-backend.select 
                                                        :children="($form['fields']['caliber_specifications']['children']??[])" 
                                                        :options="$form['fields']['caliber_specifications']['options']" 
                                                        :text="$form['fields']['caliber_specifications']['text']" 
                                                        :name="$form['fields']['caliber_specifications']['name']" 
                                                        :placeholder="$form['fields']['caliber_specifications']['placeholder']"
                                                        :required="$form['fields']['caliber_specifications']['required']??false"
                                                        :disabled="($form['fields']['caliber_specifications']['disabled']??false)"
                                                        :multiple="($form['fields']['caliber_specifications']['multiple']??false)"
                                                        :value="($form['fields']['caliber_specifications']['value']??'')" />
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
                                                <div class="col-12">
                                                    @if(!($show??false))
                                                        <button class="btn btn-success btn-sm add-template mb-3" data-target="accessories_pipe_fitting" type="button">新增</button>
                                                    @endif
                                                    <table class="table table-bordered w-100">
                                                        <thead>
                                                            <tr>
                                                                <th>項次</th>
                                                                <th>{{__('backend.sales_order_item_standards.accessories_pipe_fittings.*.category')}}</th>
                                                                <th>{{__('backend.sales_order_item_standards.accessories_pipe_fittings.*.caliber')}}</th>
                                                                <th>{{__('backend.sales_order_item_standards.accessories_pipe_fittings.*.type')}}</th>
                                                                <th>{{__('backend.sales_order_item_standards.accessories_pipe_fittings.*.model')}}</th>
                                                                <th>{{__('backend.sales_order_item_standards.accessories_pipe_fittings.*.count')}}</th>
                                                                <th>{{__('backend.sales_order_item_standards.accessories_pipe_fittings.*.remark')}}</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="accessories_pipe_fitting_area" data-name="accessories_pipe_fittings">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <p class="bg-light">管件規格與材質</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>規格項目</td>
                                                            <td>管長</td>
                                                            <td>厚度</td>
                                                            <td>粒徑</td>
                                                        </tr>
                                                        <tr>
                                                            <td>濾頭</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>布管</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>剛性</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>橡膠</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>材質項目</td>
                                                            <td>材質</td>
                                                            <td>硬度</td>
                                                        </tr>
                                                        <tr>
                                                            <td>濾頭</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>束帶</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>快接</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <p class="bg-light">工具箱及其他</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    @if(!($show??false))
                                                        <button class="btn btn-success btn-sm add-template mb-3" data-target="tool" type="button">新增</button>
                                                    @endif
                                                    <table class="table table-bordered w-100">
                                                        <thead>
                                                            <tr>
                                                                <td>項次</td>
                                                                <th>{{__('backend.sales_order_item_standards.tools.*.number')}}</th>
                                                                <th>{{__('backend.sales_order_item_standards.tools.*.name')}}</th>
                                                                <th>{{__('backend.sales_order_item_standards.tools.*.standard')}}</th>
                                                                <th>{{__('backend.sales_order_item_standards.tools.*.count')}}</th>
                                                                <th>{{__('backend.sales_order_item_standards.tools.*.remark')}}</th>
                                                                <td></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody  id="tool_area" data-name="tools">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <p class="bg-light">客製需求</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    @if(!($show??false))
                                                        <button class="btn btn-success btn-sm add-template mb-3" data-target="custom" type="button">新增</button>
                                                    @endif
                                                    <table class="table table-bordered w-100">
                                                        <thead>
                                                            <tr>
                                                                <td>項次</td>
                                                                <th>{{__('backend.sales_order_item_standards.customs.*.number')}}</th>
                                                                <th>{{__('backend.sales_order_item_standards.customs.*.name')}}</th>
                                                                <th>{{__('backend.sales_order_item_standards.customs.*.standard')}}</th>
                                                                <th>{{__('backend.sales_order_item_standards.customs.*.count')}}</th>
                                                                <th>{{__('backend.sales_order_item_standards.customs.*.remark')}}</th>
                                                                <td></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody  id="custom_area" data-name="customs">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#test" aria-expanded="false" aria-controls="test">
                                        10. 檢驗資訊
                                    </button>
                                    </h2>
                                    <div id="test" class="accordion-collapse collapse" data-bs-parent="#order">
                                        <div class="accordion-body">
                                            <p class="bg-light">報告資訊</p>
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['report_title']['children']??[])" 
                                                        :options="$form['fields']['report_title']['options']" 
                                                        :text="$form['fields']['report_title']['text']" 
                                                        :name="$form['fields']['report_title']['name']" 
                                                        :placeholder="$form['fields']['report_title']['placeholder']"
                                                        :required="$form['fields']['report_title']['required']??false"
                                                        :disabled="($form['fields']['report_title']['disabled']??false)"
                                                        :multiple="($form['fields']['report_title']['multiple']??false)"
                                                        :value="($form['fields']['report_title']['value']??'')" />
                                                </div>
                                            </div>
                                            <p class="bg-light">材質取樣</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <x-backend.select 
                                                        :children="($form['fields']['sample_method']['children']??[])" 
                                                        :options="$form['fields']['sample_method']['options']" 
                                                        :text="$form['fields']['sample_method']['text']" 
                                                        :name="$form['fields']['sample_method']['name']" 
                                                        :placeholder="$form['fields']['sample_method']['placeholder']"
                                                        :required="$form['fields']['sample_method']['required']??false"
                                                        :disabled="($form['fields']['sample_method']['disabled']??false)"
                                                        :multiple="($form['fields']['sample_method']['multiple']??false)"
                                                        :value="($form['fields']['sample_method']['value']??'')" />
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['pump_body']['children']??[])" 
                                                        :options="$form['fields']['pump_body']['options']" 
                                                        :text="$form['fields']['pump_body']['text']" 
                                                        :name="$form['fields']['pump_body']['name']" 
                                                        :placeholder="$form['fields']['pump_body']['placeholder']"
                                                        :required="$form['fields']['pump_body']['required']??false"
                                                        :disabled="($form['fields']['pump_body']['disabled']??false)"
                                                        :multiple="($form['fields']['pump_body']['multiple']??false)"
                                                        :value="($form['fields']['pump_body']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['vacuum_pump']['children']??[])" 
                                                        :options="$form['fields']['vacuum_pump']['options']" 
                                                        :text="$form['fields']['vacuum_pump']['text']" 
                                                        :name="$form['fields']['vacuum_pump']['name']" 
                                                        :placeholder="$form['fields']['vacuum_pump']['placeholder']"
                                                        :required="$form['fields']['vacuum_pump']['required']??false"
                                                        :disabled="($form['fields']['vacuum_pump']['disabled']??false)"
                                                        :multiple="($form['fields']['vacuum_pump']['multiple']??false)"
                                                        :value="($form['fields']['vacuum_pump']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['control_box']['children']??[])" 
                                                        :options="$form['fields']['control_box']['options']" 
                                                        :text="$form['fields']['control_box']['text']" 
                                                        :name="$form['fields']['control_box']['name']" 
                                                        :placeholder="$form['fields']['control_box']['placeholder']"
                                                        :required="$form['fields']['control_box']['required']??false"
                                                        :disabled="($form['fields']['control_box']['disabled']??false)"
                                                        :multiple="($form['fields']['control_box']['multiple']??false)"
                                                        :value="($form['fields']['control_box']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['test_impeller']['children']??[])" 
                                                        :options="$form['fields']['test_impeller']['options']" 
                                                        :text="$form['fields']['test_impeller']['text']" 
                                                        :name="$form['fields']['test_impeller']['name']" 
                                                        :placeholder="$form['fields']['test_impeller']['placeholder']"
                                                        :required="$form['fields']['test_impeller']['required']??false"
                                                        :disabled="($form['fields']['test_impeller']['disabled']??false)"
                                                        :multiple="($form['fields']['test_impeller']['multiple']??false)"
                                                        :value="($form['fields']['test_impeller']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['vacuum_pump_axis']['children']??[])" 
                                                        :options="$form['fields']['vacuum_pump_axis']['options']" 
                                                        :text="$form['fields']['vacuum_pump_axis']['text']" 
                                                        :name="$form['fields']['vacuum_pump_axis']['name']" 
                                                        :placeholder="$form['fields']['vacuum_pump_axis']['placeholder']"
                                                        :required="$form['fields']['vacuum_pump_axis']['required']??false"
                                                        :disabled="($form['fields']['vacuum_pump_axis']['disabled']??false)"
                                                        :multiple="($form['fields']['vacuum_pump_axis']['multiple']??false)"
                                                        :value="($form['fields']['vacuum_pump_axis']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['frame_oil_tank']['children']??[])" 
                                                        :options="$form['fields']['frame_oil_tank']['options']" 
                                                        :text="$form['fields']['frame_oil_tank']['text']" 
                                                        :name="$form['fields']['frame_oil_tank']['name']" 
                                                        :placeholder="$form['fields']['frame_oil_tank']['placeholder']"
                                                        :required="$form['fields']['frame_oil_tank']['required']??false"
                                                        :disabled="($form['fields']['frame_oil_tank']['disabled']??false)"
                                                        :multiple="($form['fields']['frame_oil_tank']['multiple']??false)"
                                                        :value="($form['fields']['frame_oil_tank']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['impeller_axis']['children']??[])" 
                                                        :options="$form['fields']['impeller_axis']['options']" 
                                                        :text="$form['fields']['impeller_axis']['text']" 
                                                        :name="$form['fields']['impeller_axis']['name']" 
                                                        :placeholder="$form['fields']['impeller_axis']['placeholder']"
                                                        :required="$form['fields']['impeller_axis']['required']??false"
                                                        :disabled="($form['fields']['impeller_axis']['disabled']??false)"
                                                        :multiple="($form['fields']['impeller_axis']['multiple']??false)"
                                                        :value="($form['fields']['impeller_axis']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['lubricating_oil_box']['children']??[])" 
                                                        :options="$form['fields']['lubricating_oil_box']['options']" 
                                                        :text="$form['fields']['lubricating_oil_box']['text']" 
                                                        :name="$form['fields']['lubricating_oil_box']['name']" 
                                                        :placeholder="$form['fields']['lubricating_oil_box']['placeholder']"
                                                        :required="$form['fields']['lubricating_oil_box']['required']??false"
                                                        :disabled="($form['fields']['lubricating_oil_box']['disabled']??false)"
                                                        :multiple="($form['fields']['lubricating_oil_box']['multiple']??false)"
                                                        :value="($form['fields']['lubricating_oil_box']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['support_frame_rotating_rod']['children']??[])" 
                                                        :options="$form['fields']['support_frame_rotating_rod']['options']" 
                                                        :text="$form['fields']['support_frame_rotating_rod']['text']" 
                                                        :name="$form['fields']['support_frame_rotating_rod']['name']" 
                                                        :placeholder="$form['fields']['support_frame_rotating_rod']['placeholder']"
                                                        :required="$form['fields']['support_frame_rotating_rod']['required']??false"
                                                        :disabled="($form['fields']['support_frame_rotating_rod']['disabled']??false)"
                                                        :multiple="($form['fields']['support_frame_rotating_rod']['multiple']??false)"
                                                        :value="($form['fields']['support_frame_rotating_rod']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['entrance_and_exit_elbow']['children']??[])" 
                                                        :options="$form['fields']['entrance_and_exit_elbow']['options']" 
                                                        :text="$form['fields']['entrance_and_exit_elbow']['text']" 
                                                        :name="$form['fields']['entrance_and_exit_elbow']['name']" 
                                                        :placeholder="$form['fields']['entrance_and_exit_elbow']['placeholder']"
                                                        :required="$form['fields']['entrance_and_exit_elbow']['required']??false"
                                                        :disabled="($form['fields']['entrance_and_exit_elbow']['disabled']??false)"
                                                        :multiple="($form['fields']['entrance_and_exit_elbow']['multiple']??false)"
                                                        :value="($form['fields']['entrance_and_exit_elbow']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['test_gas_water_separator']['children']??[])" 
                                                        :options="$form['fields']['test_gas_water_separator']['options']" 
                                                        :text="$form['fields']['test_gas_water_separator']['text']" 
                                                        :name="$form['fields']['test_gas_water_separator']['name']" 
                                                        :placeholder="$form['fields']['test_gas_water_separator']['placeholder']"
                                                        :required="$form['fields']['test_gas_water_separator']['required']??false"
                                                        :disabled="($form['fields']['test_gas_water_separator']['disabled']??false)"
                                                        :multiple="($form['fields']['test_gas_water_separator']['multiple']??false)"
                                                        :value="($form['fields']['test_gas_water_separator']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['stainless_steel_filter']['children']??[])" 
                                                        :options="$form['fields']['stainless_steel_filter']['options']" 
                                                        :text="$form['fields']['stainless_steel_filter']['text']" 
                                                        :name="$form['fields']['stainless_steel_filter']['name']" 
                                                        :placeholder="$form['fields']['stainless_steel_filter']['placeholder']"
                                                        :required="$form['fields']['stainless_steel_filter']['required']??false"
                                                        :disabled="($form['fields']['stainless_steel_filter']['disabled']??false)"
                                                        :multiple="($form['fields']['stainless_steel_filter']['multiple']??false)"
                                                        :value="($form['fields']['stainless_steel_filter']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['quick_connect_connector']['children']??[])" 
                                                        :options="$form['fields']['quick_connect_connector']['options']" 
                                                        :text="$form['fields']['quick_connect_connector']['text']" 
                                                        :name="$form['fields']['quick_connect_connector']['name']" 
                                                        :placeholder="$form['fields']['quick_connect_connector']['placeholder']"
                                                        :required="$form['fields']['quick_connect_connector']['required']??false"
                                                        :disabled="($form['fields']['quick_connect_connector']['disabled']??false)"
                                                        :multiple="($form['fields']['quick_connect_connector']['multiple']??false)"
                                                        :value="($form['fields']['quick_connect_connector']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['reducer_housing']['children']??[])" 
                                                        :options="$form['fields']['reducer_housing']['options']" 
                                                        :text="$form['fields']['reducer_housing']['text']" 
                                                        :name="$form['fields']['reducer_housing']['name']" 
                                                        :placeholder="$form['fields']['reducer_housing']['placeholder']"
                                                        :required="$form['fields']['reducer_housing']['required']??false"
                                                        :disabled="($form['fields']['reducer_housing']['disabled']??false)"
                                                        :multiple="($form['fields']['reducer_housing']['multiple']??false)"
                                                        :value="($form['fields']['reducer_housing']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['useful_quick_connect']['children']??[])" 
                                                        :options="$form['fields']['useful_quick_connect']['options']" 
                                                        :text="$form['fields']['useful_quick_connect']['text']" 
                                                        :name="$form['fields']['useful_quick_connect']['name']" 
                                                        :placeholder="$form['fields']['useful_quick_connect']['placeholder']"
                                                        :required="$form['fields']['useful_quick_connect']['required']??false"
                                                        :disabled="($form['fields']['useful_quick_connect']['disabled']??false)"
                                                        :multiple="($form['fields']['useful_quick_connect']['multiple']??false)"
                                                        :value="($form['fields']['useful_quick_connect']['value']??'')" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['check_valve']['children']??[])" 
                                                        :options="$form['fields']['check_valve']['options']" 
                                                        :text="$form['fields']['check_valve']['text']" 
                                                        :name="$form['fields']['check_valve']['name']" 
                                                        :placeholder="$form['fields']['check_valve']['placeholder']"
                                                        :required="$form['fields']['check_valve']['required']??false"
                                                        :disabled="($form['fields']['check_valve']['disabled']??false)"
                                                        :multiple="($form['fields']['check_valve']['multiple']??false)"
                                                        :value="($form['fields']['check_valve']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['engine_protective_cover']['children']??[])" 
                                                        :options="$form['fields']['engine_protective_cover']['options']" 
                                                        :text="$form['fields']['engine_protective_cover']['text']" 
                                                        :name="$form['fields']['engine_protective_cover']['name']" 
                                                        :placeholder="$form['fields']['engine_protective_cover']['placeholder']"
                                                        :required="$form['fields']['engine_protective_cover']['required']??false"
                                                        :disabled="($form['fields']['engine_protective_cover']['disabled']??false)"
                                                        :multiple="($form['fields']['engine_protective_cover']['multiple']??false)"
                                                        :value="($form['fields']['engine_protective_cover']['value']??'')" />
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <x-backend.select 
                                                        :children="($form['fields']['quick_hook']['children']??[])" 
                                                        :options="$form['fields']['quick_hook']['options']" 
                                                        :text="$form['fields']['quick_hook']['text']" 
                                                        :name="$form['fields']['quick_hook']['name']" 
                                                        :placeholder="$form['fields']['quick_hook']['placeholder']"
                                                        :required="$form['fields']['quick_hook']['required']??false"
                                                        :disabled="($form['fields']['quick_hook']['disabled']??false)"
                                                        :multiple="($form['fields']['quick_hook']['multiple']??false)"
                                                        :value="($form['fields']['quick_hook']['value']??'')" />
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
                                            <p class="bg-light">塗裝檢驗</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td></td>
                                                            <td>泵浦殼</td>
                                                            <td>葉輪</td>
                                                            <td>減速機</td>
                                                            <td>彎頭</td>
                                                            <td>油槽內部</td>
                                                            <td>油槽外部</td>
                                                        </tr>
                                                        <tr>
                                                            <td>噴砂</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>底漆塗裝</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>面漆塗裝</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
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
                                            <p class="bg-light">水泵系統</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>檢驗內容</td>
                                                            <td>檢驗時機</td>
                                                            <td>檢驗公正</td>
                                                            <td>相片檢附</td>
                                                        </tr>
                                                        <tr>
                                                            <td>葉輪通過粒徑mm</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>TAF證書：揚程、流量、動力及效率</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(1) 性能測試點數：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(2) 性能測試時間：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <p class="bg-light">引擎資料審查</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>檢驗內容</td>
                                                            <td>檢驗時機</td>
                                                            <td>檢驗公正</td>
                                                            <td>相片檢附</td>
                                                        </tr>
                                                        <tr>
                                                            <td>進口報單 / 產地證明 / 引擎年份與型式</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <p class="bg-light">控制系統(功能顯示)</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>檢驗內容</td>
                                                            <td>檢驗時機</td>
                                                            <td>檢驗公正</td>
                                                            <td>相片檢附</td>
                                                        </tr>
                                                        <tr>
                                                            <td>(1) 電瓶電壓顯示</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(2) 引擎轉速顯示</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(3) 引擎冷卻水溫度顯示</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(4) 引擎機油壓力顯示</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(5) 引擎機油溫度顯示</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(6) 減速機油溫度顯示</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(7) 燃油油量百分比顯示</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(8) 其他</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <p class="bg-light">控制系統(警示停機)</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>檢驗內容</td>
                                                            <td>檢驗時機</td>
                                                            <td>檢驗公正</td>
                                                            <td>相片檢附</td>
                                                        </tr>
                                                        <tr>
                                                            <td>(1) 引擎潤滑油低油壓</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(2) 引擎潤滑油高油溫</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(3) 引擎冷卻水高水溫</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(4) 引擎超速運轉</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(5) 引擎充電機故障警示</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(6) 引擎啟動失敗</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(7) 泵浦無水輸出警報</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(8) 其他</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <p class="bg-light">控制系統(通訊測試)</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>檢驗內容</td>
                                                            <td>檢驗時機</td>
                                                            <td>檢驗公正</td>
                                                            <td>相片檢附</td>
                                                        </tr>
                                                        <tr>
                                                            <td>詠和泵浦平台</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
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
                                            <p class="bg-light">真空泵浦</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>檢驗內容</td>
                                                            <td>檢驗時機</td>
                                                            <td>檢驗公正</td>
                                                            <td>相片檢附</td>
                                                        </tr>
                                                        <tr>
                                                            <td>泵吸速率與馬力測試</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>最大吸入揚程測試</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <p class="bg-light">傳動系統(減速機)</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>檢驗內容</td>
                                                            <td>檢驗時機</td>
                                                            <td>檢驗公正</td>
                                                            <td>相片檢附</td>
                                                        </tr>
                                                        <tr>
                                                            <td>(1) 冷卻</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(2) 過濾</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(3) 減速比</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <p class="bg-light">底座系統</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>檢驗內容</td>
                                                            <td>檢驗時機</td>
                                                            <td>檢驗公正</td>
                                                            <td>相片檢附</td>
                                                        </tr>
                                                        <tr>
                                                            <td>車胎（行走輪與導向輪）規格尺寸</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>機組尺寸及重量</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(1) 容量：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(2) 鈑厚：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(3) 焊道：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(4) 氣密：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(5) 開孔：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(6) 預留孔：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>電瓶基座防竊措施</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>引擎保護罩鈑厚</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>機組基座鈑厚</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>各項單元必要之標示或操作說明</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <p class="bg-light">連續運轉</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>檢驗內容</td>
                                                            <td>檢驗時機</td>
                                                            <td>檢驗公正</td>
                                                            <td>相片檢附</td>
                                                        </tr>
                                                        <tr>
                                                            <td>(1) 測試地點：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(2) 測試時間：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(3) 允收條件：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <p class="bg-light">可摺疊橡膠管</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>檢驗內容</td>
                                                            <td>檢驗時機</td>
                                                            <td>檢驗公正</td>
                                                            <td>相片檢附</td>
                                                        </tr>
                                                        <tr>
                                                            <td>長度－數量：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>管厚－數量：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>耐壓－條件：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>耐壓－數量：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <p class="bg-light">剛性橡膠管+濾網頭</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>檢驗內容</td>
                                                            <td>檢驗時機</td>
                                                            <td>檢驗公正</td>
                                                            <td>相片檢附</td>
                                                        </tr>
                                                        <tr>
                                                            <td>管厚－標準：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>管長－標準：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>網厚－標準：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>網孔－標準：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>網筋－標準：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <p class="bg-light">剛性橡膠管</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered w-100">
                                                        <tr>
                                                            <td>檢驗內容</td>
                                                            <td>檢驗時機</td>
                                                            <td>檢驗公正</td>
                                                            <td>相片檢附</td>
                                                        </tr>
                                                        <tr>
                                                            <td>長度－數量：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>管厚－數量：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>正壓－條件：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>正壓－數量：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>負壓－條件：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>負壓－數量：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>吊掛－條件：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>吊掛－數量：</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="mb-4 text-center">
                                    @if(!($show??false))
                                    <button type="submit" class="btn btn-success">草稿</button>
                                    <button type="submit" class="btn btn-warning">{{__('backend.common.sent')}}</button>
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
            <tr class="accessories_pipe_fitting_item template_item ui-sortable-handle" id="accessories_pipe_fitting_template">
                <td class="text-center align-top">
                    $i
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['accessories_pipe_fittings']['category']['tag']" 
                        :type="$form['fields']['accessories_pipe_fittings']['category']['type']" 
                        :text="$form['fields']['accessories_pipe_fittings']['category']['text']" 
                        :name="$form['fields']['accessories_pipe_fittings']['category']['name']" 
                        :placeholder="$form['fields']['accessories_pipe_fittings']['category']['placeholder']"
                        :required="($form['fields']['accessories_pipe_fittings']['category']['required']??false)"
                        :disabled="($form['fields']['accessories_pipe_fittings']['category']['disabled']??false)"
                        :value="($form['fields']['accessories_pipe_fittings']['category']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['accessories_pipe_fittings']['caliber']['tag']" 
                        :type="$form['fields']['accessories_pipe_fittings']['caliber']['type']" 
                        :text="$form['fields']['accessories_pipe_fittings']['caliber']['text']" 
                        :name="$form['fields']['accessories_pipe_fittings']['caliber']['name']" 
                        :placeholder="$form['fields']['accessories_pipe_fittings']['caliber']['placeholder']"
                        :required="($form['fields']['accessories_pipe_fittings']['caliber']['required']??false)"
                        :disabled="($form['fields']['accessories_pipe_fittings']['caliber']['disabled']??false)"
                        :value="($form['fields']['accessories_pipe_fittings']['caliber']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['accessories_pipe_fittings']['type']['tag']" 
                        :type="$form['fields']['accessories_pipe_fittings']['type']['type']" 
                        :text="$form['fields']['accessories_pipe_fittings']['type']['text']" 
                        :name="$form['fields']['accessories_pipe_fittings']['type']['name']" 
                        :placeholder="$form['fields']['accessories_pipe_fittings']['type']['placeholder']"
                        :required="($form['fields']['accessories_pipe_fittings']['type']['required']??false)"
                        :disabled="($form['fields']['accessories_pipe_fittings']['type']['disabled']??false)"
                        :value="($form['fields']['accessories_pipe_fittings']['type']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['accessories_pipe_fittings']['model']['tag']" 
                        :type="$form['fields']['accessories_pipe_fittings']['model']['type']" 
                        :text="$form['fields']['accessories_pipe_fittings']['model']['text']" 
                        :name="$form['fields']['accessories_pipe_fittings']['model']['name']" 
                        :placeholder="$form['fields']['accessories_pipe_fittings']['model']['placeholder']"
                        :required="($form['fields']['accessories_pipe_fittings']['model']['required']??false)"
                        :disabled="($form['fields']['accessories_pipe_fittings']['model']['disabled']??false)"
                        :value="($form['fields']['accessories_pipe_fittings']['model']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['accessories_pipe_fittings']['count']['tag']" 
                        :type="$form['fields']['accessories_pipe_fittings']['count']['type']" 
                        :text="$form['fields']['accessories_pipe_fittings']['count']['text']" 
                        :name="$form['fields']['accessories_pipe_fittings']['count']['name']" 
                        :placeholder="$form['fields']['accessories_pipe_fittings']['count']['placeholder']"
                        :required="($form['fields']['accessories_pipe_fittings']['count']['required']??false)"
                        :disabled="($form['fields']['accessories_pipe_fittings']['count']['disabled']??false)"
                        :value="($form['fields']['accessories_pipe_fittings']['count']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['accessories_pipe_fittings']['remark']['tag']" 
                        :type="$form['fields']['accessories_pipe_fittings']['remark']['type']" 
                        :text="$form['fields']['accessories_pipe_fittings']['remark']['text']" 
                        :name="$form['fields']['accessories_pipe_fittings']['remark']['name']" 
                        :placeholder="$form['fields']['accessories_pipe_fittings']['remark']['placeholder']"
                        :required="($form['fields']['accessories_pipe_fittings']['remark']['required']??false)"
                        :disabled="($form['fields']['accessories_pipe_fittings']['remark']['disabled']??false)"
                        :value="($form['fields']['accessories_pipe_fittings']['remark']['value']??'')" />
                </td>
                <td class="text-center align-top">
                @if(!($show??false))
                    <button class="btn btn-danger btn-sm delete-template mb-4">
                        <i class="fa fa-x"></i>
                    </button>
                @endif
                </td>
            </tr>
            <tr class="tool_item template_item ui-sortable-handle" id="tool_template">
                <td class="text-center align-top">
                    $i
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['tools']['number']['tag']" 
                        :type="$form['fields']['tools']['number']['type']" 
                        :text="$form['fields']['tools']['number']['text']" 
                        :name="$form['fields']['tools']['number']['name']" 
                        :placeholder="$form['fields']['tools']['number']['placeholder']"
                        :required="($form['fields']['tools']['number']['required']??false)"
                        :disabled="($form['fields']['tools']['number']['disabled']??false)"
                        :value="($form['fields']['tools']['number']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['tools']['name']['tag']" 
                        :type="$form['fields']['tools']['name']['type']" 
                        :text="$form['fields']['tools']['name']['text']" 
                        :name="$form['fields']['tools']['name']['name']" 
                        :placeholder="$form['fields']['tools']['name']['placeholder']"
                        :required="($form['fields']['tools']['name']['required']??false)"
                        :disabled="($form['fields']['tools']['name']['disabled']??false)"
                        :value="($form['fields']['tools']['name']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['tools']['standard']['tag']" 
                        :type="$form['fields']['tools']['standard']['type']" 
                        :text="$form['fields']['tools']['standard']['text']" 
                        :name="$form['fields']['tools']['standard']['name']" 
                        :placeholder="$form['fields']['tools']['standard']['placeholder']"
                        :required="($form['fields']['tools']['standard']['required']??false)"
                        :disabled="($form['fields']['tools']['standard']['disabled']??false)"
                        :value="($form['fields']['tools']['standard']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['tools']['count']['tag']" 
                        :type="$form['fields']['tools']['count']['type']" 
                        :text="$form['fields']['tools']['count']['text']" 
                        :name="$form['fields']['tools']['count']['name']" 
                        :placeholder="$form['fields']['tools']['count']['placeholder']"
                        :required="($form['fields']['tools']['count']['required']??false)"
                        :disabled="($form['fields']['tools']['count']['disabled']??false)"
                        :value="($form['fields']['tools']['count']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['tools']['remark']['tag']" 
                        :type="$form['fields']['tools']['remark']['type']" 
                        :text="$form['fields']['tools']['remark']['text']" 
                        :name="$form['fields']['tools']['remark']['name']" 
                        :placeholder="$form['fields']['tools']['remark']['placeholder']"
                        :required="($form['fields']['tools']['remark']['required']??false)"
                        :disabled="($form['fields']['tools']['remark']['disabled']??false)"
                        :value="($form['fields']['tools']['remark']['value']??'')" />
                </td>
                <td class="text-center align-top">
                @if(!($show??false))
                    <button class="btn btn-danger btn-sm delete-template mb-4">
                        <i class="fa fa-x"></i>
                    </button>
                @endif
                </td>
            </tr>
            <tr class="custom_item template_item ui-sortable-handle" id="custom_template">
                <td class="text-center align-top">
                    $i
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['customs']['number']['tag']" 
                        :type="$form['fields']['customs']['number']['type']" 
                        :text="$form['fields']['customs']['number']['text']" 
                        :name="$form['fields']['customs']['number']['name']" 
                        :placeholder="$form['fields']['customs']['number']['placeholder']"
                        :required="($form['fields']['customs']['number']['required']??false)"
                        :disabled="($form['fields']['customs']['number']['disabled']??false)"
                        :value="($form['fields']['customs']['number']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['customs']['name']['tag']" 
                        :type="$form['fields']['customs']['name']['type']" 
                        :text="$form['fields']['customs']['name']['text']" 
                        :name="$form['fields']['customs']['name']['name']" 
                        :placeholder="$form['fields']['customs']['name']['placeholder']"
                        :required="($form['fields']['customs']['name']['required']??false)"
                        :disabled="($form['fields']['customs']['name']['disabled']??false)"
                        :value="($form['fields']['customs']['name']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['customs']['standard']['tag']" 
                        :type="$form['fields']['customs']['standard']['type']" 
                        :text="$form['fields']['customs']['standard']['text']" 
                        :name="$form['fields']['customs']['standard']['name']" 
                        :placeholder="$form['fields']['customs']['standard']['placeholder']"
                        :required="($form['fields']['customs']['standard']['required']??false)"
                        :disabled="($form['fields']['customs']['standard']['disabled']??false)"
                        :value="($form['fields']['customs']['standard']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['customs']['count']['tag']" 
                        :type="$form['fields']['customs']['count']['type']" 
                        :text="$form['fields']['customs']['count']['text']" 
                        :name="$form['fields']['customs']['count']['name']" 
                        :placeholder="$form['fields']['customs']['count']['placeholder']"
                        :required="($form['fields']['customs']['count']['required']??false)"
                        :disabled="($form['fields']['customs']['count']['disabled']??false)"
                        :value="($form['fields']['customs']['count']['value']??'')" />
                </td>
                <td class="text-center align-top">
                    <x-backend.input 
                        :tag="$form['fields']['customs']['remark']['tag']" 
                        :type="$form['fields']['customs']['remark']['type']" 
                        :text="$form['fields']['customs']['remark']['text']" 
                        :name="$form['fields']['customs']['remark']['name']" 
                        :placeholder="$form['fields']['customs']['remark']['placeholder']"
                        :required="($form['fields']['customs']['remark']['required']??false)"
                        :disabled="($form['fields']['customs']['remark']['disabled']??false)"
                        :value="($form['fields']['customs']['remark']['value']??'')" />
                </td>
                <td class="text-center align-top">
                @if(!($show??false))
                    <button class="btn btn-danger btn-sm delete-template mb-4">
                        <i class="fa fa-x"></i>
                    </button>
                @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>
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
<script>
    var url = "{{route('backend.sales.order_item_standard.index')}}";
    var engine_serial = {
            1: 'turn',
            2: 'displacement',
            3: 'full_load_fuel_consumption',
            4: 'cooling_method',
            5: 'engine_form',
        }
    $(`select[name="engine_serial"]`).change(function(){
        let id = $(this).val();
        if(id) {
            sendApi(`${url}`,"GET",{
                action: "engine_serial",
                id: id,
            },function(result) {
                let data = result.data;
                Object.keys(data).map((key) => {
                    let str = '';
                    data[key].map((item) => {
                        str += `<option value="${item.id}">${item.name}</option>`
                    })
                    let select = $(`select[name="${engine_serial[key]}"]`);
                    select.select2('destroy');
                    select.html(str);
                    select.select2({
                        allowClear: true,
                    });
                })
            });
        }
    });

    var brand_model_number = {
            6: 'deviation_angle',
            7: 'parallel_deviation',
            8: 'axial_telescopic',
        }
    $(`select[name="brand_model_number"]`).change(function(){
        let id = $(this).val();
        if(id) {
            sendApi(`${url}`,"GET",{
                action: "brand_model_number",
                id: id,
            },function(result) {
                let data = result.data;
                Object.keys(data).map((key) => {
                    let str = '';
                    data[key].map((item) => {
                        str += `<option value="${item.id}">${item.name}</option>`
                    })
                    let select = $(`select[name="${brand_model_number[key]}"]`);
                    select.select2('destroy');
                    select.html(str);
                    select.select2({
                        allowClear: true,
                    });
                })
            });
        }
    });



    @if(!($show??false))
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
    }).on('click', '.delete-template', function(){
        $(this).parents('.template_item').remove();
    });
    @endif
</script>
@endpush