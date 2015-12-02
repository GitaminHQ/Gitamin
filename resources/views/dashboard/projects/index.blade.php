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
                <a class="btn btn-success pull-right" href="{{ route('projects.new') }}">
                    <i class="fa fa-plus"></i>
                    {{ trans('gitamin.projects.new.title') }}
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
                                <a href="/{{ $project->path }}">{{ $project->name }}</a> <small>(<a href="/{{ $project->path }}">{{ $project->path }}.git</a>) {{ $project->humanStatus }}</small>
                            </h4>
                            <!--
                            @if($project->team)
                            <p><small><a href="/{{ $project->team->slug }}">{{ trans('dashboard.projects.listed_team', ['name' => $project->team->name]) }} </a></small></p>
                            @endif
                            @if($project->description)
                            <p>{{ $project->description }}</p>
                            @endif
                            -->
                        </div>
                        <div class="col-xs-6 text-right">
                            <i class="fa fa-star"></i> 0
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
