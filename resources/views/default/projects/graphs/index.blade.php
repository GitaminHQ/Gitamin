@extends('layout.dashboard')

@section('content')

<div class="content-wrapper">
    <div class="header sub-header">
    <div class="sidebar-toggler visible-xs">
        <i class="fa fa-navicon"></i>
    </div>
    <i class="fa fa-cubes"></i> {{ trans('dashboard.projects.projects') }}
    &gt; <small>{{ $project->name }}</small>&gt; <small>{{ trans('dashboard.issues.issues') }}</small>
    </div>
    @include('projects.partials.sub-navbar')
    <div class="row">
        <div class="col-sm-12">
         <a href="issues/new" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> {{ trans('dashboard.issues.add.title') }}</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            @include('dashboard.partials.errors')
            <div class="striped-list">
                graphs here.
            </div>
        </div>
    </div>
</div>
@stop