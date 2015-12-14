@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-exclamation-circle"></i> {{ trans('dashboard.issues.issues') }}
                </span>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @include('dashboard.partials.errors')
                     @foreach($issue_projects as $project)
                    <div class="panel panel-default panel-small">
                        <div class="panel-heading">
                        <a href="{{ $project->url }}"><span class="namespace-name">{{ $project->owner->name }} / </span><span class="project-name">{{ $project->name }}</span></a>
                        <a class="pull-right" href="{{ $project->url }}/issues">show all</a>
                        </div>
                        <ul class="well-list issues-list">
                        @foreach($project->issues as $issue)
                        <li class="issue" id="issue_2" url="{{ $issue->url }}">
                        <div class="issue-title">
                        <span class="issue-title-text">
                        <a class="row_title" href="{{ $issue->url }}">{{ $issue->title }}</a>
                        </span>
                        <div class="issue-labels">
                        </div>
                        <div class="pull-right light">
                        <a class="author_link has_tooltip" data-original-title="Administrator" href="/u/root"><img alt="" class="avatar avatar-inline s16" src="https://avatars2.githubusercontent.com/u/15867969?v=3&s=40" width="16"></a>
                        &nbsp;
                        <span>
                        <i class="fa fa-comments"></i>
                        1
                        </span>
                        </div>
                        </div>
                        <div class="issue-info">
                        #{{ $issue->id }} opened <time class="time_ago js-timeago" data-container="body" data-placement="bottom" data-toggle="tooltip" datetime="2015-12-11T08:32:57Z" title="Dec 11, 2015 8:32am">3 days ago</time> by <a class="author_link" href="/u/{{ $issue->author['username'] }}"><span class="author">{{ $issue->author['username'] }}</span></a>
                        &nbsp;
                        <span>
                        <i class="fa fa-clock-o"></i>
                        v0.0.1
                        </span>
                        <div class="pull-right issue-updated-at">
                        <span>updated <time class="issue_update_ago js-timeago" data-container="body" data-placement="bottom" data-toggle="tooltip" datetime="2015-12-11T09:27:30Z" title="Dec 11, 2015 9:27am">3 days ago</time></span>
                        </div>
                        </div>
                        </li>
                         @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
