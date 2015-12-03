@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-folder"></i> {{ trans_choice('gitamin.groups.groups', 2) }}
                </span>
                <a class="btn btn-success pull-right" href="{{ route('groups.new') }}">
                    <i class="fa fa-plus"></i> {{ trans('gitamin.groups.add.title') }}
                </a>
                <div class="clearfix"></div>
            </div>
            @include('dashboard.partials.errors')
            <div class="row">
                <div class="col-sm-12 striped-list" id="project-team-list">
                    @forelse($groups as $group)
                    <div class="row striped-list-item" data-team-id="{{ $group->id }}">
                        <div class="col-xs-6">
                            <h4>
                                @if($group->count() > 1)
                                <span class="drag-handle"><i class="fa fa-reorder"></i></span>
                                @endif
                                <a href="/{{ $group->slug }}">{{ $group->name }}</a> ({{ $group->path }})
                                <span class="label label-info">{{ $group->projects->count() }}</span>
                            </h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{ route('dashboard.projects.add',['namespace'=>$group->id]) }}" class="btn btn-sm btn-info">{{ trans('dashboard.projects.add.title') }}</a>
                            <a href="{{ route('groups.group_edit', ['namespace'=>$group->path]) }}" class="btn btn-sm btn-default">{{ trans('forms.edit') }}</a>
                            <a href="/dashboard/projects/teams/{{ $group->id }}/delete" class="btn btn-sm btn-danger confirm-action" data-method="DELETE">{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item text-danger">{{ trans('dashboard.teams.no_projects') }}</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@stop
