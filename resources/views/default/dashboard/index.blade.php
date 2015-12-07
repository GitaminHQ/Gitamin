@extends('layout.dashboard')

@section('content')
    
    <div class="content-wrapper">
        <div class="header sub-header">
        <div class="sidebar-toggler visible-xs">
            <i class="fa fa-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="fa fa-dashboard"></i> {{ trans('dashboard.dashboard') }}
        </span>
    </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="sub-header">{{ trans('dashboard.projects.projects') }}</h4>
                <div class="panel panel-default">
                    <div class="list-group">
                        @forelse($projects as $project)
                        <div class="list-group-item">
                            <form class='project-inline form-vertical' data-messenger="{{trans('dashboard.projects.edit.success')}}">
                                <div class="row striped-list-item">
                                    <div class="col-lg-4 col-md-3 col-sm-12">
                                        <h4>{{ $project->name }}</h4>
                                    </div>
                                    <div class="col-lg-8 col-md-9 col-sm-12 radio-items componet-inline-update">
                                        @foreach(trans('gitamin.projects.status') as $statusID => $status)
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="status" value="{{ $statusID }}" {{ (int) $project->status === $statusID ? 'checked' : null }}>
                                                {{ $status }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                            </form>
                        </div>
                        @empty
                        <div class="list-group-item"><a href="{{ route('projects.new') }}">{{ trans('dashboard.projects.new.message') }}</a></div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="stats-widget">
                    <div class="stats-top">
                        <span class="stats-value"><a href="{{ route('dashboard.issues.index') }}">{{ $issues->map(function($issue) { return count($issue); })->sum() }}</a></span>
                        <span class="stats-label">{{ trans('dashboard.issues.issues') }}</span>
                    </div>
                    <div class="stats-chart">
                        <div class="sparkline" data-type="line" data-resize="true" data-height="80" data-width="100%" data-line-width="2" data-min-spot-color="#e65100" data-max-spot-color="#ffb300" data-line-color="#3498db" data-spot-color="#00838f" data-fill-color="#3498db" data-highlight-line-color="#00acc1" data-highlight-spot-color="#ff8a65" data-spot-radius="false" data-data="[{{ $issues->map(function ($issue) { return count($issue); } )->implode(',') }}]"></div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-6">
                <div class="stats-widget">
                    <div class="stats-top">
                        <span class="stats-value"><a href="{{ route('dashboard.subscribers.index') }}">{{ $subscribers->map(function($subscribers) { return count($subscribers); })->sum() }}</a></span>
                        <span class="stats-label">{{ trans('dashboard.subscribers.subscribers') }}</span>
                    </div>
                    <div class="stats-chart">
                        <div class="sparkline" data-type="line" data-resize="true" data-height="80" data-width="100%" data-line-width="2" data-min-spot-color="#e65100" data-max-spot-color="#ffb300" data-line-color="#3498db" data-spot-color="#00838f" data-fill-color="#3498db" data-highlight-line-color="#00acc1" data-highlight-spot-color="#ff8a65" data-spot-radius="false" data-data="[{{ $subscribers->map(function ($subscriber) { return count($subscriber); } )->implode(',') }}]"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Session::get('setup.done'))
    @include('dashboard.partials.welcome-modal')
    <script>
        $(function() {
            $('#welcome-modal').modal('show');
        });
    </script>
    @endif
@stop
