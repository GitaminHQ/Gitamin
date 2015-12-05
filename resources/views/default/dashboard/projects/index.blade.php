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
                    <div class="row striped-list-item {{ !$project->wall_enabled ? 'bg-warning' : null }}" data-project-id="{{ $project->id }}">
                        <div class="col-xs-6">
                            @if($projects->count() > 1)
                            <span class="drag-handle"><i class="fa fa-reorder"></i></span>
                            @endif
                            <a href="{{ route('projects.project_show',['namespace'=>$project->namespace,'project'=>$project->path]) }}">{{ $project->namespace}} / {{ $project->name }}</a> <small>{{ $project->humanStatus }}</small>
                           
                            <!--
                            @if($project->team)
                            <p><small><a href="/{{ $project->team->slug }}">{{ trans('dashboard.projects.listed_team', ['name' => $project->team->name]) }} </a></small></p>
                            @endif
                            -->
                            @if($project->description)
                            <p>{{ $project->description }}</p>
                            @endif
                        </div>
                        <div class="col-xs-6 text-right">
                            <i class="fa fa-star"></i> 0
                        </div>
                    </div>
                    @empty
                    <div class="row">
                        <div class="col-xs-8">
                            <i class="fa fa-bookmark-o"></i> {{ trans('dashboard.projects.new.message') }}
                            </div>
                        <div class="col-xs-4">
                            <a class="btn btn-success" href="{{ route('projects.new') }}"><i class="fa fa-plus"></i> {{ trans('dashboard.projects.new.title') }}</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-8">
                            <i class="fa fa-users"></i> {{ trans('dashboard.groups.new.message') }}
                        </div>
                        <div class="col-xs-4">
                            <a class="btn btn-success" href="{{ route('groups.new') }}"><i class="fa fa-plus"></i> {{ trans('dashboard.groups.new.title') }}</a>
                        </div>
                    </div>
                    <hr>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@stop
