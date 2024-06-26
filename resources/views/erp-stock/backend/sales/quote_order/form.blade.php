@extends('backend.layouts.main')
@section('options')
    @if(($show??false))
    <div class="row mb-2">
        <div class="col-12">
            <button class="btn @if($detail->status?->id == 1) btn-warning @elseif($detail->status?->id == 2) btn-primary @else btn-danger @endif" type="button" id="close" data-id="{{$detail->id}}">{{$detail->status->name}}</button>
            <a href="{{route('backend.sales.quote_order.create',['quote_order' => request()->quote_order])}}" class="btn btn-primary">議價</a>
            @if($detail->status?->id == 1 && !$detail->contract_order)
            <a href="{{route('backend.sales.order.create',['sourceable_type' => \App\Models\SalesQuoteOrder::class, 'sourceable_id' => $detail->id])}}" class="btn btn-success">轉訂購單</a>
            @else
                @if($detail->order)
                <a href="{{route('backend.sales.order.show', ['contract_order' => $detail->contract_order->id])}}" class="btn btn-info" target="_blank">訂購單</a>
                @endif
            @endif
        </div>
    </div>
    @endif
@endsection
@section('content')
<main id="main-container">
<!-- Page Content -->
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{$form['title']}}</h3>
            </div>
            <div class="block-content pb-4">
                <x-backend::tab-form :form="$form" :fields="$fields" :show="$show??false" :detail="$detail??[]" :table="$table??''" />
            </div>
        </div>
    </div>
    <x-backend.product.product-number />
<!-- END Page Content -->
</main>
@endsection
@push('style')
<link rel="stylesheet" href="{{asset(Universal::version('/css/order.css'))}}">
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
<script src="{{asset(Universal::version('js/rate.js'))}}"></script>
<script src="{{asset(Universal::version('js/imageFile.js'))}}"></script>
<script src="{{asset(Universal::version('js/order.js'))}}"></script>
<script>

    $(`input[name="quote_start_date"]`).change(function(){
        let date = new Date($(this).val());
        date = new Date(date.setMonth(date.getMonth() + 1));
        console.log(`${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, "0")}-${(date.getDate()).toString().padStart(2, "0")}`)
        $(`input[name="quote_end_date"]`).val(`${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, "0")}-${(date.getDate()).toString().padStart(2, "0")}`)
    });

    $(document).on('change', 'select[name$="[products_id]"]', function(){
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
                if(!$(`select[name="sourceable_id"]`).val()) {
                    $(`#product_stock_${item}`).text(result.data.stock);
                }
                $(`#product_test_${item}`).prop('checked', result.data.test);
                $(`input[name="items[${item}][type]"]`).val(1);
                $(`select[name="items[${item}][products_id]"]`).attr('required', true);
                $(`#product-number-${item}`).html('');
            });
        }
        
    }).on('click', '.makeNo', function(){
        target = `#${$(this).data('target')}`;
        item = $(this).data('item');
    });

    var init = true;
    var url = "{{route('backend.sales.quote_order.index')}}";
    var rate = new Rate({{$decimal_point}}, {{$tax_percentage}}, {{config('erp.calibration')}});
    // $(`select[name="sourceable_type"]`).change(function(){
    //     if($(this).val() != '') {
    //         sendApi(`${url}`,"GET",{
    //             action: "sourceable_type",
    //             type: $(this).val()
    //         },function(result) {
    //             let str = '<option value=""></option>';
    //             result.data.map((item) => {
    //                 str += `<option value="${item.value}">${item.name}</option>`
    //             });
    //             $(`select[name="sourceable_id"]`).html(str);
    //             if(init) {
    //                 $(`select[name="sourceable_id"]`).val('{{addslashes(request()->sourceable_id)}}').trigger('change');
    //                 init = false;
    //             }
    //         });
    //     }
    // });
    // $(`select[name="sourceable_id"]`).change(function(){
    //     let id = $(this).val();
    //     if(id) {
    //         sendApi(`${url}`,"GET",{
    //             action: "sourceable_id",
    //             type: $(`select[name="sourceable_type"]`).val(),
    //             id: id,
    //         },function(result) {
    //             $('#items_area').html('');
    //             if(result.data.file) {
    //                 let file = result.data.file;
    //                 let name = file.split('/');
    //                 getFileFromURL('{{asset('storage')}}/'+file, name.pop())
    //                     .then(file => {
    //                         const dataTransfer = new DataTransfer();
    //                         dataTransfer.items.add(file);
    //                         $(`input[name="file"]`)[0].files = dataTransfer.files;
    //                         $(`input[name="file"]`).trigger('change')
    //                         // 可以將其用於你的程式邏輯中
    //                     });
    //             }
    //             // $(`select[name="projects_id"]`).val(result.data.projects_id).trigger('change');
    //             $(`select[name="customers_id"]`).attr('transfer', true).val(result.data.customers_id).trigger('change').attr('transfer', false);
    //             $(`select[name="staff_id"]`).val(result.data.customer_staff_id).trigger('change');
    //             $(`input[name="delivery_date"]`).val(result.data.delivery_date);
    //             setTimeout(function() {
    //                 $(`select[name="currencies_id"]`).val(result.data.currencies_id).trigger('change');
    //                 $(`input[name="invoice_types_id"][value="${result.data.invoice_types_id}"]`).prop("checked", true).trigger("change");
    //                 $(`input[name="invoice_methods_id"][value="${result.data.invoice_methods_id}"]`).prop("checked", true).trigger("change");
    //                 $(`input[name="invoice_categories_id"][value="${result.data.invoice_categories_id}"]`).prop("checked", true).trigger("change");                
    //             }, 500);
    //             $(`textarea[name="remark"]`).val(result.data.remark);
    //             $(`textarea[name="remark"]`).text(result.data.remark)
    //             result.data.items.map((item, key) => {
    //                 let i = key + 1;
    //                 $(`#items_template_add`).click();
    //                 setTimeout(() => {
    //                     $(`select[name="items[${i}][products_id]"]`).attr('transfer', true).val(item.products_id).trigger('change');
    //                     $(`input[name="items[${i}][name]"]`).val(item.name);
    //                     $(`input[name="items[${i}][standard]"]`).val(item.standard);
    //                     $(`input[name="items[${i}][size]"]`).val(item.size);
    //                     $(`input[name="items[${i}][unit]"]`).val(item.unit);
    //                     $(`select[name="items[${i}][depots_id]"]`).val(item.depots_id).trigger('change');
    //                     $(`input[data-name="items[${i}][unit_amount]"]`).val(item.unit_amount).trigger('keyup');
    //                     $(`input[data-name="items[${i}][factory_hours]"]`).val(item.factory_hours).trigger('keyup');
    //                     $(`input[data-name="items[${i}][count]"]`).val(item.count).trigger('keyup');
    //                     $(`input[name="items[${i}][remark]"]`).val(item.remark);
    //                     $(`input[name="items[${i}][file]"]`)
    //                     if(item.file) {
    //                         let name = item.file.split('/');
    //                         getFileFromURL('{{asset('storage')}}/'+item.file, name.pop())
    //                         .then(file => {
    //                             const dataTransfer = new DataTransfer();
    //                             dataTransfer.items.add(file);
    //                             $(`input[name="items[${i}][file]"]`)[0].files = dataTransfer.files;
    //                             $(`input[name="items[${i}][file]"]`).trigger('change')
    //                             // 可以將其用於你的程式邏輯中
    //                         });
    //                     }
    //                     $(`select[name="items[${i}][products_id]"]`).removeAttr('transfer')
    //                 }, 300);
    //             });
    //         });
    //     }
    // });
    @if(!($show??false))
    
    main_calibration = Math.pow(10, {{config('erp.calibration')}});
    setMainCurrency(`input[id="number-main_amount"]`,`input[id="number-amount"]`);
    setMainCurrency(`input[id="number-main_tax"]`,`input[id="number-tax"]`);
    setMainCurrency(`input[id="number-main_total_amount"]`,`input[id="number-total_amount"]`);
    @else
        @if($detail->sales_quote_order_statuses_id == 1)
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
    // @if(request()->sourceable_id)
    //     $(`select[name="sourceable_id"]`).val('{{addslashes(request()->sourceable_id)}}').trigger('change');
    // @endif

</script>
@endpush