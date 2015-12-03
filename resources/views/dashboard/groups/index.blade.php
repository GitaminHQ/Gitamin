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
                    <i class="fa fa-plus"></i>
                    {{ trans('gitamin.groups.add.title') }}
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
                                @if($groups->count() > 1)
                                <span class="drag-handle"><i class="fa fa-reorder"></i></span>
                                @endif
                                <a href="/{{ $group->path }}">{{ $group->name }}</a> ({{ $group->path }})
                                <span class="label label-info">{{ $group->projects->count() }}</span>
                            </h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{ route('groups.group_edit',['namespace'=>$group->path]) }}" class="btn btn-sm btn-info">{{ trans('gitamin.groups.edit.title') }}</a>
                        </div>
                    </div>
                    @empty
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
