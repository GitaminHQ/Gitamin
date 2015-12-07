@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-user"></i> {{ trans('gitamin.profiles.profiles') }}
                </span>
                <div class="clearfix"></div>
            </div>
            @include('dashboard.partials.errors')
            <div class="row">
                <div class="col-sm-12 striped-list" id="project-team-list">
                   
                    <div class="list-group-item text-danger">{{ trans('dashboard.teams.no_projects') }}</div>
                </div>
            </div>
        </div>
    </div>
@stop
