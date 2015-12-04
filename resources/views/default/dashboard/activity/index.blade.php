@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-sliders"></i> {{ trans('dashboard.activity.activity') }}
                </span>
                <div class="clearfix"></div>
            </div>
            @include('dashboard.partials.errors')
            <div class="row">
                <div class="col-sm-12 striped-list" id="activity-list">
                    @forelse($activities as $activity)
                    <div class="row striped-list-item {{ !$activity->enabled ? 'bg-warning' : null }}" data-activity-id="{{ $activity->id }}">
                        <div class="col-xs-6">
                            <h4>
                                @if($activities->count() > 1)
                                <span class="drag-handle"><i class="fa fa-reorder"></i></span>
                                @endif
                                <a href="{{ route('dashboard.activity.show', $activity->id) }}">{{ $activity->name }}</a> <small>{{ $activity->humanStatus }}</small>
                            </h4>
                            @if($activity->team)
                            <p><small>{{ trans('dashboard.activity.listed_team', ['name' => $activity->team->name]) }}</small></p>
                            @endif
                            @if($activity->description)
                            <p>{{ $activity->description }}</p>
                            @endif
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="/dashboard/activity/{{ $activity->id }}/edit" class="btn btn-default">{{ trans('forms.edit') }}</a>
                            <a href="/dashboard/activity/{{ $activity->id }}/delete" class="btn btn-danger confirm-action" data-method="DELETE">{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item text-danger">{{ trans('dashboard.activity.add.message') }}</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@stop
