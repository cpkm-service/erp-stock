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
                        <x-backend::form :form="$form" :fields="$fields" />
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
                                        {{implode("-", array_filter([$item->name,$item->standard,$item->size]))}}
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
                                                            <th class="text-center">請購序</th>
                                                            <th class="text-center">{{__('backend.subscription_orders.subscription_order_items.*.products_id')}}</th>
                                                            <th class="text-center">{{__('backend.subscription_orders.subscription_order_items.*.name')}}</th>
                                                            <th class="text-center">{{__('backend.subscription_orders.subscription_order_items.*.standard')}}</th>
                                                            <th class="text-center">{{__('backend.subscription_orders.subscription_order_items.*.size')}}</th>
                                                            <th class="text-center">{{__('backend.subscription_orders.subscription_order_items.*.pre_count')}}</th>
                                                            <th class="text-center">{{__('backend.subscription_orders.subscription_order_items.*.unit')}}</th>
                                                            <th class="text-center">{{__('backend.purchase_orders.no')}}</th>
                                                            <th class="text-center">採購序</th>
                                                            <th class="text-center">{{__('backend.subscription_orders.subscription_order_items.*.already_count')}}</th>
                                                            <th class="text-center">{{__('backend.subscription_orders.subscription_order_items.*.yet_count')}}</th>
                                                            <th class="text-center">{{__('backend.subscription_orders.subscription_order_items.*.income_count')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($item->purchase_order_items as $key => $purchase_order_item)
                                                        <tr>
                                                            <th class="text-center">{{($key + 1)}}</th>
                                                            <th class="text-center">{{($item->id)}}</th>
                                                            <th class="text-center">{{($item->product->product_serial)}}</th>
                                                            <th class="text-center">{{($item->name)}}</th>
                                                            <th class="text-center">{{($item->standard)}}</th>
                                                            <th class="text-center">{{($item->size)}}</th>
                                                            <th class="text-center">{{($item->count)}}</th>
                                                            <th class="text-center">{{($item->unit)}}</th>
                                                            <th class="text-center">{{$item->purchase_order_items?->first()?->sourceable?->no}}</th>
                                                            <th class="text-center">{{$item->purchase_order_items?->first()?->sourceable?->id}}</th>
                                                            <td class="text-center">{{number_format($purchase_order_item->count)}}</td>
                                                            <th class="text-center">{{number_format($item->count - $purchase_order_item->count)}}</th>
                                                            <td class="text-center">{{number_format($purchase_order_item->restock_order_items->sum('count'))}}</td>
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
<x-backend.product.product-number />
@endsection
@push('style')
<link rel="stylesheet" href="/css/order.css">
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
<script src="{{asset('js/rate.js?'.time())}}"></script>
<script src="{{asset('js/imageFile.js')}}"></script>
<script src="{{asset('js/order.js?'.time())}}"></script>
<script>
    var url = "{{route('backend.restock.pre_purchase_order.index')}}";
    var rate = new Rate({{$decimal_point}}, {{$tax_percentage}}, {{config('erp.calibration')}});
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
                $('input[name="phone"]').val(contact.mobile);
            }
        }
    });

    $(`input[name="quote_start_date"]`).change(function(){
        let date = new Date($(this).val());
        date = new Date(date.setMonth(date.getMonth() + 1));
        console.log(`${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, "0")}-${(date.getDate()).toString().padStart(2, "0")}`)
        $(`input[name="quote_end_date"]`).val(`${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, "0")}-${(date.getDate()).toString().padStart(2, "0")}`)
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
                $(`#product_stock_${item}`).text(result.data.stock);
                $(`input[name="items[${item}][unit]"]`).val(result.data.unit);
                $(`[id="number-items[${item}][subscription_count]"]`).val(result.data.least_count).trigger('keyup');
                $(`select[name="items[${item}][factory_id]"]`).val(result.data.customers_id).trigger('change');
                $(`select[name="items[${item}][products_id]"]`).attr('required', true);
                $(`#product-number-${item}`).html('');
            });
        }
        
    }).on('click', '.delete-template', function(){
        $(this).parents('.template_item').remove();
    });
    @else
        @if($detail->subscription_order_statuses_id == 1)
        $('#close').click(function() {
            var id = $(this).data('id');
            console.log(id)
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
</script>
@endpush