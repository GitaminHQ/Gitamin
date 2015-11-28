@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-cubes"></i> {{ trans('dashboard.projects.projects') }}
                </span>
                <a class="btn btn-sm btn-success pull-right" href="{{ route('dashboard.projects.add') }}">
                    {{ trans('dashboard.projects.add.title') }}
                </a>
                <div class="clearfix"></div>
            </div>
            @include('dashboard.partials.errors')
            <div class="row">
                <div class="col-sm-12 striped-list" id="project-list">
                    @forelse($projects as $project)
                    <div class="row striped-list-item {{ !$project->enabled ? 'bg-warning' : null }}" data-project-id="{{ $project->id }}">
                        <div class="col-xs-6">
                            <h4>
                                @if($projects->count() > 1)
                                <span class="drag-handle"><i class="fa fa-reorder"></i></span>
                                @endif
                                <a href="/{{ $project->path }}">{{ $project->name }}</a> <small>(<a href="/{{ $project->path }}">{{ $project->path }}.git</a>){{ $project->humanStatus }}</small>
                            </h4>
                            @if($project->team)
                            <p><small><a href="/{{ $project->team->slug }}">{{ trans('dashboard.projects.listed_team', ['name' => $project->team->name]) }} </a></small></p>
                            @endif
                            @if($project->description)
                            <p>{{ $project->description }}</p>
                            @endif
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{ route('dashboard.issues.index', ['project_id'=>$project->id]) }}" class="btn btn-sm btn-default">{{ trans('dashboard.issues.issues') }}</a>
                            <a href="/dashboard/projects/{{ $project->id }}/edit" class="btn btn-sm btn-info">{{ trans('forms.edit') }}</a>
                            <a href="/dashboard/projects/{{ $project->id }}/delete" class="btn btn-sm btn-danger confirm-action" data-method="DELETE">{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item"><a href="{{ route('dashboard.projects.add') }}">{{ trans('dashboard.projects.add.message') }}</a></div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@stop
