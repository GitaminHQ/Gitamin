@extends('layout.dashboard')

@section('content')
<div class="content-panel">
    <div class="content-wrapper">
        <div class="header sub-header">
                <i class="fa fa-folder"></i> {{ trans_choice('dashboard.groups.groups', 2) }}
            <div class="clearfix"></div>
        </div>
        @include('dashboard.partials.errors')
        <div class="row">
            <div class="header-with-avatar clearfix">
                <img alt="No group avatar" class="avatar group-avatar s90" src="/img/no_group_avatar.png">
                <h3>
                {{ $group->name }}
                </h3>
                <div class="username">
                {!! '@' !!}{{ $group->path }}
                </div>
                <div class="description">
                <p>{{ $group->description }}</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <section class="activities col-md-7">
            <div class="hidden-xs">

            <div class="pull-right">
            <a class="btn rss-btn" href="" title="Feed"><i class="fa fa-rss"></i>
            </a></div>
            <div class="btn-group btn-group-next event-filter">
            <a class="event-filter-link btn btn-default" href="{{ $group->url }}" id="push_event_filter" title="Filter by push events"><span> Push events</span></a>
            <a class="event-filter-link btn btn-default" href="{{ $group->url }}" id="merged_event_filter" title="Filter by merge events"><span> Merge events</span></a>
            </div>

            <hr>
            </div>
            <div class="content_list">
            @forelse($moments as $moment)
                @if($moment->target)
                    @include('moments.partials.'.strtolower($moment->target_type))
                @endif
            @empty
            @endforelse
            
            <div class="loading hide" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>
            </section>
            <aside class="side col-md-5">
            <div class="panel panel-default projects-list-holder">
            <div class="panel-heading clearfix">
            <div class="input-group">
            <input class="projects-list-filter form-control" id="filter_projects" name="filter_projects" placeholder="Filter by name" spellcheck="false" type="search">
            <span class="input-group-btn">
            <a class="btn btn-green" href="{{ route('projects.new', ['owner'=>$group->path]) }}"><i class="fa fa-plus"></i>
            New Project
            </a></span>
            </div>
            </div>
            <ul class="projects-list">
                @forelse ($group->projects as $project)
                <li class="project-row">
                    <a class="project" href="{{ $project->url }}"><div class="dash-project-avatar">
                    <div class="avatar project-avatar s46 identicon" style="background-color: #E0F2F1; color: #555">{{ $project->id }}</div>
                    </div>
                    <span class="project-full-name">
                    <span class="namespace-name">
                    </span>
                    <span class="project-name filter-title">
                    {{ $project->name }}
                    </span>
                    </span>
                    </a><div class="project-controls">
                    </div>
                    <div class="project-description">
                    <p>{{ $project->description }}</p>
                    </div>
                </li>
                @empty
                @endforelse
            </ul>
            

            </div>

            </aside>
            </div>
    </div>
</div>
@stop
