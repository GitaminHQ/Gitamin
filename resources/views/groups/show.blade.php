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
                <a class="btn btn-sm btn-success text-right" href="{{ route('dashboard.teams.edit', [$team->id]) }}">
                    {{ trans('forms.edit') }}
                </a>
                <a href="/dashboard/projects/teams/{{ $team->id }}/delete" class="btn btn-sm btn-danger text-right confirm-action" data-method="DELETE">
                {{ trans('forms.delete') }}
                </a>
                </div>
                
                <div class="clearfix"></div>
            </div>
            @include('dashboard.partials.errors')
            <div class="row">
                <div class="col-sm-12 striped-list" id="project-team-list">
                   
                    <div class="row striped-list-item" data-team-id="{{ $team->id }}">
                        <div class="col-xs-6">
                            <h4>
                                {{ $team->name }} ({{ $team->slug }})
                                <span class="label label-info">{{ $team->projects->count() }}</span>
                            </h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{ route('dashboard.projects.add',['team_id'=>$team->id]) }}" class="btn btn-sm btn-info">{{ trans('dashboard.projects.add.title') }}</a>
                        </div>
                    </div>
                    <div>
                    	<ul>
                    		@forelse($team->projects as $project)
                    		<li><a href="/{{ $team->slug }}/{{ $project->slug }}">{{ $project->name }}</a> ({{ $team->slug }}/{{ $project->slug }}.git)</li>
                    		@empty
                    		@endforelse
                    	</ul>
                    </div>
            
                </div>
            </div>
        </div>
    </div>
@stop
