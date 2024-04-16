@extends('backend.layouts.main')
@section('content')
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">{{ __('list') }}</h3>
    </div>
    <div class="block-content block-content-full">
        <div class="block block-rounded row g-0 overflow-hidden border">
            <ul class="nav nav-tabs nav-tabs-block" role="tablist">
                @foreach($types as $key => $type)
                <li class="nav-item d-md-flex flex-md-column">
                    <button class="nav-link fs-sm text-md-start rounded-0 @if($key == 0) active @endif" id="type-{{$key}}-tab" data-bs-toggle="tab" data-bs-target="#type-{{$key}}" role="tab" aria-controls="type-{{$key}}" aria-selected="true" type="button">
                        <!-- <i class="fa fa-fw fa-home opacity-50 me-1 d-none d-sm-inline-block"></i> -->
                        <span>{{$type->name}}</span>
                    </button>
                </li>
                @endforeach
            </ul>
            <div class="tab-content col-12">
                @foreach($types as $key => $type)
                <div class="block-content tab-pane @if($key == 0) active @endif" id="type-{{$key}}" role="tabpanel" aria-labelledby="type-{{$key}}-tab" tabindex="0">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive" id="type-{{$key}}-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>型號順序</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($type->config as $sort => $config)
                            <tr>
                                <td>{{ ($sort + 1) }}</td>
                                <td>{{$config->name}}</td>
                                <td>
                                    <a class="read btn btn-sm btn-primary" href="{{route('backend.sales.standard.show', ['standard' => $config->id])}}">{{ __('read') }}</a>
                                    @if($config->edit)
                                    <a class="edit btn btn-sm btn-warning ms-2" href="{{route('backend.sales.standard.edit', ['standard' => $config->id])}}">{{ __('edit') }}</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
        </div>
        
    </div>
</div>
@endsection

@push('scripts')
@endpush