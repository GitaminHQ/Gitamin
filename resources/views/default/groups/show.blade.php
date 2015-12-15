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
            <div class="content_list"><div class="event-block event-item">
            <div class="event-item-timestamp">
            <time class="time_ago js-timeago" data-container="body" data-placement="top" data-toggle="tooltip" datetime="2015-12-11T09:04:59Z" title="Dec 11, 2015 9:04am">2 days ago</time>
            </div>
            <img alt="" class="avatar s46" src="https://avatars2.githubusercontent.com/u/15867969?v=3&s=40">
            <div class="event-title">
            <span class="author_name"><a href="/u/root">Administrator</a></span>
            <span class="event_label">
            commented on
            <a href="/baidu/good/issues/2#note_8">issue #2</a>
            at
            </span>
            <a href="/baidu/good"><span class="namespace-name">baidu / </span><span class="project-name">good</span></a>
            </div>
            <div class="event-body">
            <div class="event-note">
            <div class="md">
            <p>comment test.</p>
            </div>
            </div>
            </div>

            </div>
            <div class="event-block event-item">
            <div class="event-item-timestamp">
            <time class="time_ago js-timeago" data-container="body" data-placement="top" data-toggle="tooltip" datetime="2015-12-10T15:35:48Z" title="Dec 10, 2015 3:35pm">3 days ago</time>
            </div>
            <img alt="" class="avatar s46" src="https://avatars2.githubusercontent.com/u/15867969?v=3&s=40">
            <div class="event-title">
            <span class="author_name"><a href="/u/root">Administrator</a></span>
            <span class="event_label">
            commented on
            <a href="/baidu/good/merge_requests/1#note_7">merge request #1</a>
            at
            </span>
            <a href="/baidu/good"><span class="namespace-name">baidu / </span><span class="project-name">good</span></a>
            </div>
            <div class="event-body">
            <div class="event-note">
            <div class="md">
            <p>comment</p>
            </div>
            </div>
            </div>

            </div>
            <div class="event-block event-item">
            <div class="event-item-timestamp">
            <time class="time_ago js-timeago" data-container="body" data-placement="top" data-toggle="tooltip" datetime="2015-12-10T02:04:32Z" title="Dec 10, 2015 2:04am">3 days ago</time>
            </div>
            <img alt="" class="avatar s46" src="https://avatars2.githubusercontent.com/u/15867969?v=3&s=40">
            <div class="event-title">
            <span class="author_name"><a href="/u/root">Administrator</a></span>
            <span class="event_label">
            commented on
            <a href="/baidu/good/issues/1#note_3">issue #1</a>
            at
            </span>
            <a href="/baidu/good"><span class="namespace-name">baidu / </span><span class="project-name">good</span></a>
            </div>
            <div class="event-body">
            <div class="event-note">
            <div class="md">
            <p>reopen test.</p>
            </div>
            </div>
            </div>

            </div>


            </div>
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
