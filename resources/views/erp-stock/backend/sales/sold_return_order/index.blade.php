@extends('backend.layouts.main')
@section('content')
{{-- <div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">查詢</h3>
    </div>
    <div class="block-content block-content-full">
        <form name="search">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <x-backend::input 
                        :tag="$fields['date']['tag']" 
                        :type="$fields['date']['type']" 
                        :text="$fields['date']['text']" 
                        :name="$fields['date']['name']" 
                        :placeholder="$fields['date']['placeholder']"
                        :required="false"
                        :disabled="false"
                        value="" />
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <x-backend::select 
                        :children="($fields['sales_sold_return_order_statuses_id']['children']??[])" 
                        :options="$fields['sales_sold_return_order_statuses_id']['options']" 
                        :text="$fields['sales_sold_return_order_statuses_id']['text']" 
                        :name="$fields['sales_sold_return_order_statuses_id']['name']" 
                        :placeholder="$fields['sales_sold_return_order_statuses_id']['placeholder']"
                        :required="false"
                        :disabled="false"
                        :multiple="false"
                        value="" />
                </div>
                <div class="row">
                    <div>
                        <button type="submit" class="btn btn-primary">查詢</button>
                        <button type="reset" class="btn btn-info">清除</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> --}}
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">{{ __('list') }}</h3>
        <a href="{{ route('backend.sales.sold_return_order.create') }}" class="btn btn-primary create">{{ __('create') }}</a>
    </div>
    <div class="block-content block-content-full">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive" id="data-table">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    var url = "{{route('backend.sales.sold_return_order.index',[],false)}}";
    var search = makeDataTable(
        "#data-table",
        url,
        "GET",
        function(d) {
            let temp = {};
            $('form[name="search"]').serialize().split('&').map((item) => {
                let data = item.split('=');
                if(data[1]) {
                    temp[data[0]] = data[1];
                }
            });
            d.extraParam = temp;
        },
        [
            {
                data: "id",
                className: "text-md-center",
                title: "#",
                render: (data, type, full, meta) => {
                    return meta.row + 1 + meta.settings._iDisplayStart;
                },
                searchable:false,
            },
            {
                data: "date",
                className: "text-md-center fw-semibold",
                title: "{{__('erp-stock::backend.sales_sold_return_orders.date')}}"
            },
            {
                data: "no",
                className: "text-md-center",
                title: "{{__('erp-stock::backend.sales_sold_return_orders.no')}}"
            },
            {
                data: "project.name",
                className: "text-md-center",
                title: "{{__('erp-stock::backend.sales_sold_return_orders.name')}}"
            },
            {
                data: "staff.name",
                className: "text-md-center",
                title: "{{__('erp-stock::backend.sales_sold_return_orders.staff_id')}}"
            },
            {
                data: "department.name",
                className: "text-md-center",
                title: "{{__('erp-stock::backend.sales_sold_return_orders.departments_id')}}"
            },
            {
                data: "status.name",
                className: "text-md-center",
                title: "{{__('erp-stock::backend.sales_sold_return_orders.sales_sold_return_order_statuses_id')}}",
                render:(data,type,row,meta) => {
                    switch (row.status.id) {
                        case 1:
                            str = `<span class="badge bg-warning">${data}</span>`;
                            break;
                        case 2:
                            str = `<span class="badge bg-primary">${data}</span>`;
                            break;
                        case 3:
                            str = `<span class="badge bg-danger">${data}</span>`;
                            break;
                    }
                    return str;
                }
            },
            {
                data: "id",
                className: "text-md-center",
                title: '{{ __('option') }}',
                orderable:false,
                searchable:false,
                render: (data,type,row,meta) => {
                    return `<a class="read btn btn-sm btn-primary" href="${url}/${ data }">{{ __('read') }}</a>
                            <a class="edit btn btn-sm btn-warning ms-2" href="${url}/${ data }/edit">{{ __('edit') }}</a>
                            <a data-id="${ data }" class="delete btn btn-sm btn-danger ms-2 d-none" href="javascript:;">{{ __('delete') }}</a>`;
                }
            },
        ],
        function(){
        },
        {
            ordering:true,
            order:[[2,'desc']]
        }
    );
    $('form[name="search"]').submit(function(){
        Codebase.block('state_toggle','.block-rounded');
        search.ajax.reload(function(){
            Codebase.block('state_toggle','.block-rounded');
        });
        return false;
    })

    $(document).on('click','.delete',function(){
        let id = $(this).data('id');
        var deleteId = $(this).data('id');
        Swal.fire({
            title:'{{__('admin::backend.common.confirmDelete')}}',
            icon:'warning',
            showCancelButton: true, 
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{__('admin::backend.common.confirm')}}',
            cancelButtonText: '{{__('admin::backend.common.cancel')}}',
        }).then(function(result){
            if(result.isConfirmed) {
                Codebase.block('state_toggle','.block-rounded');
                sendApi(`${url}/${deleteId}`,"DELETE",{}).then(function(){
                    search.ajax.reload(function(){
                        Codebase.block('state_toggle','.block-rounded');
                    });
                });
            }
        })
    });
</script>
@endpush