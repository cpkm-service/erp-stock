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
                                <div class="col-12">
                                    @if(!($show??false) && $detail->insert)
                                    <button class="btn btn-success btn-sm add-template mb-3" data-target="category" type="button">新增</button>
                                    @endif
                                    <div class="table-responsive">
                                        <table class="table table-striped table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center" style="width:250px;"><span class="text-danger">*</span>{{__('backend.sales_order_item_categories.sales_order_item_options.*.name')}}</th>
                                                    @foreach($detail->settings as $setting)
                                                    <th class="text-center" style="width:350px;">{{$setting->name}}</th>
                                                    @endforeach
                                                    <th class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="category_area" data-name="categorys">
                                                @foreach($detail->items??[] as $key => $item)
                                                <tr class="category_item template_item ui-sortable-handle">
                                                    <td class="text-center align-top">
                                                        {{( $key + 1 )}}
                                                        <input type="hidden" name="items[{{($key+1)}}][id]" value="{{$item['id']}}">
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
                                                            :value="($item->name??'')" />
                                                    </td>
                                                    @foreach($detail->settings as $setting)
                                                    <td class="text-center align-top">
                                                        <div class="row item_options">
                                                            <div class="col-1" data-id="plus" data-item="{{ $key +1 }}" data-target="option_{{$setting->id}}">
                                                                @if(!($show??false))
                                                                <a href="javascript:void(0)" class="text-success">
                                                                    <i class="fa fa-plus"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                            <div class="col-11 option_{{$setting->id}}_area">
                                                                @foreach($item->options()->where('sales_order_item_option_settings_id', $setting->id)->get() as $j => $option)
                                                                <div class="row option_{{$setting->id}}_items">
                                                                    @if(!($show??false))
                                                                    <div class="col-1" data-id="delete">
                                                                        <a href="javascript:void(0)" class="text-danger option_items_delete" data-target="option_{{$setting->id}}">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>
                                                                    </div>
                                                                    @endif
                                                                    <div class="col-10">
                                                                        <input type="hidden" name="items[{{( $key + 1 )}}][options][{{$setting->id}}][{{$j}}][id]" value="{{$option['id']}}">
                                                                        <div class="d-none">
                                                                            <x-backend.input 
                                                                                :tag="$form['fields']['items']['options']['sales_order_item_option_settings_id']['tag']" 
                                                                                :type="$form['fields']['items']['options']['sales_order_item_option_settings_id']['type']" 
                                                                                :text="$form['fields']['items']['options']['sales_order_item_option_settings_id']['text']" 
                                                                                :name="(str_replace('$setting', $setting->id,(str_replace('$j', $j,str_replace('$i', ( $key + 1 ), $form['fields']['items']['options']['sales_order_item_option_settings_id']['name'])))))" 
                                                                                :placeholder="$form['fields']['items']['options']['sales_order_item_option_settings_id']['placeholder']"
                                                                                :required="($form['fields']['items']['options']['sales_order_item_option_settings_id']['required']??false)"
                                                                                :disabled="($form['fields']['items']['options']['sales_order_item_option_settings_id']['disabled']??false)"
                                                                                :value="$setting->id" />
                                                                        </div>
                                                                        <x-backend.input 
                                                                            :tag="$form['fields']['items']['options']['name']['tag']" 
                                                                            :type="$form['fields']['items']['options']['name']['type']" 
                                                                            :text="$form['fields']['items']['options']['name']['text']" 
                                                                            :name="(str_replace('$setting', $setting->id,(str_replace('$j', $j,str_replace('$i', ( $key + 1 ), $form['fields']['items']['options']['name']['name'])))))" 
                                                                            :placeholder="$form['fields']['items']['options']['name']['placeholder']"
                                                                            :required="($form['fields']['items']['options']['name']['required']??false)"
                                                                            :disabled="($form['fields']['items']['options']['name']['disabled']??false)"
                                                                            :value="($option->name??'')" />
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </td>
                                                    @endforeach
                                                    <td class="text-center align-top">
                                                    @if(!($show??false) && $detail->insert)
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
            <tr class="category_item template_item ui-sortable-handle" id="category_template">
                <td class="text-center align-top">
                    $i
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
                @foreach($detail->settings as $setting)
                <td class="text-center align-top">
                    <div class="row item_options">
                        <div class="col-1" data-id="plus" data-item="$i" data-target="option_{{$setting->id}}">
                            @if(!($show??false))
                            <a href="javascript:void(0)" class="text-success">
                                <i class="fa fa-plus"></i>
                            </a>
                            @endif
                        </div>
                        <div class="col-11 option_{{$setting->id}}_area">
                        </div>
                    </div>
                </td>
                @endforeach
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
<div id="option_template_area" class="d-none">
    @foreach($detail->settings as $setting)
        <div class="row option_{{$setting->id}}_items">
            <div class="col-1" data-id="delete">
                <a href="javascript:void(0)" class="text-danger option_items_delete d-none" data-target="option_{{$setting->id}}">
                    <i class="fa fa-trash"></i>
                </a>
            </div>
            <div class="col-10">
                <div class="d-none">
                    <x-backend.input 
                        :tag="$form['fields']['items']['options']['sales_order_item_option_settings_id']['tag']" 
                        :type="$form['fields']['items']['options']['sales_order_item_option_settings_id']['type']" 
                        :text="$form['fields']['items']['options']['sales_order_item_option_settings_id']['text']" 
                        :name="(str_replace('$setting', $setting->id, $form['fields']['items']['options']['sales_order_item_option_settings_id']['name']))" 
                        :placeholder="$form['fields']['items']['options']['sales_order_item_option_settings_id']['placeholder']"
                        :required="($form['fields']['items']['options']['sales_order_item_option_settings_id']['required']??false)"
                        :disabled="($form['fields']['items']['options']['sales_order_item_option_settings_id']['disabled']??false)"
                        :value="$setting->id" />
                </div>
                <x-backend.input 
                    :tag="$form['fields']['items']['options']['name']['tag']" 
                    :type="$form['fields']['items']['options']['name']['type']" 
                    :text="$form['fields']['items']['options']['name']['text']" 
                    :name="(str_replace('$setting', $setting->id, $form['fields']['items']['options']['name']['name']))" 
                    :placeholder="$form['fields']['items']['options']['name']['placeholder']"
                    :required="($form['fields']['items']['options']['name']['required']??false)"
                    :disabled="($form['fields']['items']['options']['name']['disabled']??false)"
                    value="" />
            </div>
        </div>
    @endforeach
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
    [data-id="plus"] {
        margin-top: 7px;
    }
    [data-id="delete"] {
        margin-top: 7px;
    }
</style>
@endpush
@push('javascript')
<script>
    $(document).on('click', '.add-template', function(){
        let target = $(this).data('target');
        let template = $(`#${target}_template`).clone().removeAttr('id');
        let length = $(`#${target}_area .${target}_item`).length + 1;
        $(`#${target}_area`).append(template[0].outerHTML.replace(/\$i/g, length));
        $(`#${target}_area`).find('select').select2({
            allowClear: true,
        });
    }).on('click', '.delete-template', function(){
        $(this).parents('.template_item').remove();
    }).on('click', '.option_items_delete', function(){
        let id = $(this).data('target');
        $(this).parents(`.${id}_items`).remove();
    })
    .on('click', `[data-id="plus"]`, function(){
        let sort = $(this).data('item');
        let id = $(this).data('target');
        let sign_item = $(this).parents('.item_options');
        let length = sign_item.find(`.${id}_items`).length;
        let target = $('#option_template_area').find(`.${id}_items`).clone();
        target.find('.option_items_delete').removeClass('d-none');
        html = target[0].outerHTML.replace(/\$i/g, sort).replace(/\$j/g, length);
        console.log(sign_item.find(`.${id}_area`));
        sign_item.find(`.${id}_area`).append(html);
    })
</script>
@endpush