@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                    <i class="fa fa-group"></i> {{ trans_choice('gitamin.groups.groups', 2) }}
                <div class="clearfix"></div>
            </div>
            @include('dashboard.partials.errors')
            <div class="row">
                <div class="gray-content-block">
                    <span class="pull-right hidden-xs">
                    <a class="btn btn-new" href="{{ route('groups.new') }}"><i class="fa fa-plus"></i>
                    {{ trans('gitamin.groups.add.title') }}
                    </a></span>
                    <div class="title">Welcome to the groups!</div>
                    Group members have access to all group projects.
                </div>
                <ul class="content-list">
                    @forelse($groups as $group)
                    <li>
                        <div class="controls hidden-xs">
                        <a class="btn-sm btn btn-grouped" href="{{ $group->url }}/edit"><i class="fa fa-cogs"></i>
                        </a><a class="btn-sm btn btn-grouped" data-confirm="Are you sure you want to leave &quot;baidu&quot; group?" data-method="delete" href="" rel="nofollow" title="Leave this group"><i class="fa fa-sign-out"></i>
                        </a></div>
                        <img alt="No group avatar" class="avatar s46 hidden-xs" src="/img/no_group_avatar.png">
                        <a class="group-name" href="{{ $group->url }}"><strong>{{ $group->name }}</strong>
                        </a>as
                        <span>Owner</span>
                        <div class="light">
                        {{ $group->projects->count() }} project, 2 users
                        </div>
                    </li>
                    @empty
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@stop
