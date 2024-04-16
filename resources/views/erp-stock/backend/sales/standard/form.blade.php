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
                                <div class="col-12 col-md-6 col-lg-4">
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
                                <div class="col-12">
                                    @if(!($show??false) && $detail->edit)
                                    <button class="btn btn-success btn-sm add-template mb-3" data-target="items" type="button">新增</button>
                                    @endif
                                    <div class="table-responsive">
                                        <table class="table table-striped table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width:50px;">#</th>
                                                    <th class="text-center" style="width:250px;"><span class="text-danger">*</span>{{__('backend.sales_standard_config_items.code')}}</th>
                                                    <th class="text-center" style="width:450px;"><span class="text-danger">*</span>{{__('backend.sales_standard_config_items.name')}}</th>
                                                    <th class="text-center" style="width:50px;"></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="items_area" data-name="items">
                                                @foreach($detail->items??[] as $key => $item)
                                                <tr class="items_item template_item ui-sortable-handle">
                                                    <td class="text-center align-top">
                                                        {{( $key + 1 )}}
                                                        <input type="hidden" name="items[{{( $key + 1 )}}][id]" value="{{$item['id']}}">
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                            :tag="$form['fields']['items_code']['tag']" 
                                                            :type="$form['fields']['items_code']['type']" 
                                                            :text="$form['fields']['items_code']['text']" 
                                                            :name="(str_replace('$i', ( $key + 1 ), $form['fields']['items_code']['name']))" 
                                                            :placeholder="$form['fields']['items_code']['placeholder']"
                                                            :required="($form['fields']['items_code']['required']??false)"
                                                            :disabled="((($form['fields']['items_code']['disabled']??false) || ($show??false)) || !$detail->edit)"
                                                            :value="$item->code" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                        <x-backend.input 
                                                            :tag="$form['fields']['items_name']['tag']" 
                                                            :type="$form['fields']['items_name']['type']" 
                                                            :text="$form['fields']['items_name']['text']" 
                                                            :name="(str_replace('$i', ( $key + 1 ), $form['fields']['items_name']['name']))" 
                                                            :placeholder="$form['fields']['items_name']['placeholder']"
                                                            :required="($form['fields']['items_name']['required']??false)"
                                                            :disabled="((($form['fields']['items_name']['disabled']??false) || ($show??false)) || !$detail->edit)"
                                                            :value="$item->name" />
                                                    </td>
                                                    <td class="text-center align-top">
                                                    @if(!($show??false))
                                                        <button class="btn btn-danger btn-sm delete-template mb-4">
                                                            <i class="fa fa-x"></i>
                                                        </button>
                                                    @endif
                                                    </td>
                                                    <td></td>
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
                        <div id="template_area" class="d-none">
                            <table class="table table-striped table-vcenter">
                                <tbody>
                                    <tr class="items_item template_item ui-sortable-handle" id="items_template">
                                        <td class="text-center align-top">
                                            $i
                                        </td>
                                        <td class="text-center align-top">
                                            <x-backend.input 
                                                    :tag="$form['fields']['items_code']['tag']" 
                                                    :type="$form['fields']['items_code']['type']" 
                                                    :text="$form['fields']['items_code']['text']" 
                                                    :name="$form['fields']['items_code']['name']" 
                                                    :placeholder="$form['fields']['items_code']['placeholder']"
                                                    :required="($form['fields']['items_code']['required']??false)"
                                                    :disabled="($form['fields']['items_code']['disabled']??false)"
                                                    :value="($form['fields']['items_code']['value']??'')" />
                                        </td>
                                        <td class="text-center align-top">
                                            <x-backend.input 
                                                :tag="$form['fields']['items_name']['tag']" 
                                                :type="$form['fields']['items_name']['type']" 
                                                :text="$form['fields']['items_name']['text']" 
                                                :name="$form['fields']['items_name']['name']" 
                                                :placeholder="$form['fields']['items_name']['placeholder']"
                                                :required="($form['fields']['items_name']['required']??false)"
                                                :disabled="($form['fields']['items_name']['disabled']??false)"
                                                :value="($form['fields']['items_name']['value']??'')" />
                                        </td>
                                        <td class="text-center align-top">
                                        @if(!($show??false))
                                            <button class="btn btn-danger btn-sm delete-template mb-4">
                                                <i class="fa fa-x"></i>
                                            </button>
                                        @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
@endsection
@push('style')
<style>
    .table {
        width:max-content;
    }
    th,td {
        white-space:nowrap;
    }
</style>
@endpush
@push('javascript')
<script>
    $(document)
    .on('click', '.add-template', function(){
        let target = $(this).data('target');
        let template = $(`#${target}_template`).clone().removeAttr('id');
        let length = $(`#${target}_area .${target}_item`).length + 1;
        $(`#${target}_area`).append(template[0].outerHTML.replace(/\$i/g, length));
        $(`#${target}_area`).find('select').select2({
            allowClear: true,
        });
    })
    .on('click', '.delete-template', function(){
        $(this).parents('.template_item').remove();
    });

    // @if(!($show??false))
    // $("tbody").sortable({
    //     cursor: 'row-resize',
    //     placeholder: 'ui-state-highlight',
    //     opacity: '0.55',
    //     items: '.ui-sortable-handle',
    //     update: function( event, ui ) {
    //         let table = $(event.target);
    //         let name = table.data('name');
    //         let trs = table.find('tr');
    //         $(this).find('select').select2('destroy');
    //         table.html('');
    //         trs.each(function(sort){
    //             sort = sort +1;
    //             let regexp = new RegExp(`"${name}\\[\\d+\\]`,'gm');
    //             let html = ($(this)[0].outerHTML).replace(regexp,`"${name}[${sort}]`).replace(/item_template_\d+_/gm, `item_template_${sort}_`).replace(/data-item="\d+"/gm, `data-item="${sort}"`);
    //             table.append(html);
    //         });
    //         $(this).find('select').select2({
    //             allowClear: true,
    //         });
    //     }
    // }).disableSelection();
    // @endif

    // $('form[name="{{$form['name']}}"] button[type="submit"]').click(function(){
    //     $('form[name="{{$form['name']}}"]').find('.tab-pane').each(function(){
    //         var valid = true;
    //         var id = $(this).attr('id');
    //         $(this).find('input, select, textarea').each(function(){
    //             if(!$(this)[0].checkValidity()) {
    //                 valid = false;
    //                 $(`button[data-bs-target="#${id}"]`).click();
    //                 $(this)[0].reportValidity();
    //                 event.preventDefault();
    //                 return false;
    //             }
    //         })
    //         if(!valid) {
                
    //             return false;
    //         }
    //     });
    // });
</script>
@endpush
