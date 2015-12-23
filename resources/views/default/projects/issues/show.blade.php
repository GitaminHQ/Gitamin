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

    <div class="detail-page-header">
        <div class="status-box status-box-closed">
        Closed
        </div>
        <span class="identifier">
        Issue #{{ $issue->id }}
        </span>
        <span class="creator">
        ·
        opened by <a class="author_link" href="/u/beyondliu"><img width="24" class="avatar avatar-inline s24" alt="" src="{{ $issue->author->avatar }}"><span class="author">{{ $issue->author->username }}</span></a>
        ·
        <time class="issue_created_ago js-timeago" datetime="{{ $issue->created_at }}" title="" data-toggle="tooltip" data-placement="bottom" data-container="body" data-original-title="{{ $issue->created_at_iso }}">{{ $issue->created_at_diff }}</time>
        <script>
        //<![CDATA[
        $('.js-timeago-pending').removeClass('js-timeago-pending').timeago()
        //]]>
        </script>
        <span>
        ·
        <i title="edited" class="fa fa-edit"></i>
        <time class="issue_edited_ago js-timeago" datetime="{{ $issue->updated_at }}" title="{{ $issue->updated_at_iso }}" data-toggle="tooltip" data-placement="bottom" data-container="body">{{ $issue->updated_at_diff }}</time><script>
        //<![CDATA[
        $('.js-timeago-pending').removeClass('js-timeago-pending').timeago()
        //]]>
        </script>
        </span>
        </span>
        <div class="pull-right">
        <a class="btn btn-grouped new-issue-link" title="New Issue" id="new_issue_link" href="{{ $issue->project->url }}/issues/new"><i class="fa fa-plus"></i>
        New Issue
        </a></div>
    </div>
    @include('partials.issuable.discussion')
</div>
@stop