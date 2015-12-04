@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-folder"></i> {{ trans_choice('dashboard.teams.teams', 2) }}
                </span>
                <div class="pull-right">
                <a class="btn btn-sm btn-success text-right" href="{{ route('groups.group_edit', ['namespace'=>$group->path]) }}">
                    {{ trans('forms.edit') }}
                </a>
                <a href="/dashboard/projects/teams/{{ $group->id }}/delete" class="btn btn-sm btn-danger text-right confirm-action" data-method="DELETE">
                {{ trans('forms.delete') }}
                </a>
                </div>
                
                <div class="clearfix"></div>
            </div>
            @include('dashboard.partials.errors')
            <div class="row">
                <div class="col-sm-12 striped-list" id="project-team-list">
                   
                    <div class="row striped-list-item" data-team-id="{{ $group->id }}">
                        <div class="col-xs-6">
                            <h4>
                                {{ $group->name }} ({{ $group->path }})
                                <span class="label label-info">{{ $group->projects->count() }}</span>
                            </h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{ route('projects.new',['namespace_id'=>$group->id]) }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> {{ trans('dashboard.projects.add.title') }}</a>
                        </div>
                    </div>
                    <div>
                    	<ul>
                    		@forelse($group->projects as $project)
                    		<li><a href="/{{ $project->namespace }}/{{ $project->path }}">{{ $project->name }}</a> ({{ $project->namespace }}/{{ $project->path }}.git)</li>
                    		@empty
                    		@endforelse
                    	</ul>
                    </div>
            
                </div>
            </div>
        </div>
    </div>
@stop
