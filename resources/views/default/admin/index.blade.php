@extends('layout.admin')

@section('content')

<div class="content-panel">
    
<div class="content-wrapper">
    @include('dashboard.partials.errors')
    <div class="header sub-header">
        <span class="uppercase">
            <i class="fa fa-wrench"></i> {{ trans('admin.overview') }}
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
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                    <span class="stats-value"><a href="{{ route('dashboard.issues.index') }}">1</span>
                    <span class="stats-label">{{ trans('dashboard.issues.issues') }}</span>
                </div>
                <div class="stats-chart">
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-6">
            <div class="stats-widget">
                <div class="stats-top">
                    <span class="stats-value"><a href="{{ route('dashboard.subscribers.index') }}">1</a></span>
                    <span class="stats-label">{{ trans('dashboard.subscribers.subscribers') }}</span>
                </div>
                <div class="stats-chart">
                </div>
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
