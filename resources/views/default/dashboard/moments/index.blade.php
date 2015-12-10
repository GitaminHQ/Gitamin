@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-sliders"></i> {{ trans('dashboard.moments.moments') }}
                </span>
                <div class="clearfix"></div>
            </div>
            @include('dashboard.partials.errors')
            <div class="row">
                <div class="col-sm-12 striped-list" id="moment-list">
                    @forelse($moments as $moment)
                    <div class="row striped-list-item {{ !$moment->enabled ? 'bg-warning' : null }}" data-moment-id="{{ $moment->id }}">
                        <div class="col-xs-6">
                            <h4>
                                @if($moments->count() > 1)
                                <span class="drag-handle"><i class="fa fa-reorder"></i></span>
                                @endif
                                <a href="{{  $moment->id }}">{{ $moment->title }}</a> ({{ $moment->target_type }})
                            </h4>
                            @if($moment->data)
                            <p>{{ $moment->data }}</p>
                            @endif
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="/dashboard/moments/{{ $moment->id }}/edit" class="btn btn-default">{{ trans('forms.edit') }}</a>
                            <a href="/dashboard/moments/{{ $moment->id }}/delete" class="btn btn-danger confirm-action" data-method="DELETE">{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item text-danger">{{ trans('dashboard.moments.add.message') }}</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@stop
