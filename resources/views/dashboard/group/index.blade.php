@extends('layout.dashboard')

@section('content')
    <div class="header">
        <div class="sidebar-toggler visible-xs">
            <i class="fa fa-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="fa fa-group"></i> {{ trans('dashboard.group.group') }}
        </span>
        @if($current_user->isAdmin)
        <div class="button-group pull-right">
            <a class="btn btn-sm btn-success" href="{{ route('dashboard.group.invite') }}">
                {{ trans('dashboard.group.invite.title') }}
            </a>
            <a class="btn btn-sm btn-success" href="{{ route('dashboard.group.add') }}">
                {{ trans('dashboard.group.add.title') }}
            </a>
        </div>
        @endif
        <div class="clearfix"></div>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <p class="lead">{{ trans('dashboard.group.description') }}</p>

                <div class="user-grid">
                    @foreach($group_members as $member)
                    <div class="user col-sm-3 col-xs-6">
                        <a href="@if($current_user->id == $member->id) {{ url('dashboard/user') }} @else /dashboard/team/{{ $member->id }} @endif">
                            <img src="{{ $member->gravatar }}">
                        </a>
                        <div class="name">{{ $member->username }}</div>
                        <div class="email">{{ $member->email }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
