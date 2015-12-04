@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-clock-o"></i> {{ trans('dashboard.milestones.milestones') }}
                </span>
                <a class="btn btn-sm btn-success pull-right" href="{{ route('dashboard.milestones.index') }}">
                    {{ trans('dashboard.milestones.add.title') }}
                </a>
                <div class="clearfix"></div>
            </div>
            @include('dashboard.partials.errors')
            <div class="row">
                <div class="col-sm-12 striped-list" id="milestone-list">
                    @forelse($milestones as $milestone)
                    <div class="row striped-list-item {{ !$milestone->enabled ? 'bg-warning' : null }}" data-milestone-id="{{ $milestone->id }}">
                        <div class="col-xs-6">
                            <h4>
                                @if($milestones->count() > 1)
                                <span class="drag-handle"><i class="ion-drag"></i></span>
                                @endif
                                <a href="{{ route('dashboard.milestones.show', $milestone->id) }}">{{ $milestone->name }}</a> <small>{{ $milestone->humanStatus }}</small>
                            </h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="/dashboard/milestones/{{ $milestone->id }}/edit" class="btn btn-default">{{ trans('forms.edit') }}</a>
                            <a href="/dashboard/milestones/{{ $milestone->id }}/delete" class="btn btn-danger confirm-action" data-method="DELETE">{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item"><a href="{{ route('dashboard.milestones.index') }}">{{ trans('dashboard.milestones.add.message') }}</a></div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@stop
