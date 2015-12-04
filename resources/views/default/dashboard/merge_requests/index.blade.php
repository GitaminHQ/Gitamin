@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-tasks"></i> {{ trans('dashboard.merge_requests.merge_requests') }}
                </span>
                <a class="btn btn-sm btn-success pull-right" href="{{ route('dashboard.merge_requests.index') }}">
                    {{ trans('dashboard.merge_requests.add.title') }}
                </a>
                <div class="clearfix"></div>
            </div>
            @include('dashboard.partials.errors')
            <div class="row">
                <div class="col-sm-12 striped-list" id="merge_request-list">
                    @forelse($merge_requests as $merge_request)
                    <div class="row striped-list-item {{ !$merge_request->enabled ? 'bg-warning' : null }}" data-merge_request-id="{{ $merge_request->id }}">
                        <div class="col-xs-6">
                            <h4>
                                @if($merge_requests->count() > 1)
                                <span class="drag-handle"><i class="ion-drag"></i></span>
                                @endif
                                <a href="{{ route('dashboard.merge_requests.show', $merge_request->id) }}">{{ $merge_request->name }}</a> <small>{{ $merge_request->humanStatus }}</small>
                            </h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="/dashboard/merge_requests/{{ $merge_request->id }}/edit" class="btn btn-default">{{ trans('forms.edit') }}</a>
                            <a href="/dashboard/merge_requests/{{ $merge_request->id }}/delete" class="btn btn-danger confirm-action" data-method="DELETE">{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item"><a href="{{ route('dashboard.merge_requests.index') }}">{{ trans('dashboard.merge_requests.add.message') }}</a></div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@stop
