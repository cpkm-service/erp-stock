@extends('backend.layouts.main')
@section('content')
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">{{ __('list') }}</h3>
        <a href="{{ route('backend.sales.sold_order.create') }}" class="btn btn-primary create">{{ __('create') }}</a>
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
    var url = "{{route('backend.sales.sold_order.index',[],false)}}";
    var search = makeDataTable(
        "#data-table",
        url,
        "GET",
        function() {
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
                title: "{{__('erp-stock::backend.sales_sold_orders.date')}}"
            },
            {
                data: "no",
                className: "text-md-center",
                title: "{{__('erp-stock::backend.sales_sold_orders.no')}}"
            },
            {
                data: "staff.name",
                className: "text-md-center",
                title: "{{__('erp-stock::backend.sales_sold_orders.staff_id')}}"
            },
            {
                data: "department.name",
                className: "text-md-center",
                title: "{{__('erp-stock::backend.sales_sold_orders.departments_id')}}"
            },
            {
                data: "customer.name",
                className: "text-md-center",
                title: "{{__('erp-stock::backend.sales_sold_orders.customers_id')}}"
            },
            {
                data: "project.name",
                className: "text-md-center",
                title: "{{__('erp-stock::backend.sales_sold_orders.name')}}"
            },
            {
                data: "status.name",
                className: "text-md-center",
                title: "{{__('erp-stock::backend.sales_sold_orders.sales_quote_order_statuses_id')}}",
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
                    let str = `<a class="read btn btn-sm btn-primary" href="${url}/${ data }">{{ __('read') }}</a>
                            <a class="edit btn btn-sm btn-warning ms-2" href="${url}/${ data }/edit">{{ __('edit') }}</a>`;
                    if(!row.close) {
                        str += `<a data-id="${ data }" class="delete btn btn-sm btn-danger ms-2" href="javascript:;">{{ __('delete') }}</a>`;
                    }
                    return str;
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

    $(document).on('click','.delete',function(){
        let id = $(this).data('id');
        var deleteId = $(this).data('id');
        Swal.fire({
            title:'{{__('backend.common.confirmDelete')}}',
            icon:'warning',
            showCancelButton: true, 
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{__('backend.common.confirm')}}',
            cancelButtonText: '{{__('backend.common.cancel')}}',
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