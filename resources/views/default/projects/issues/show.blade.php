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

    <div class="row">
        <div class="col-sm-12">
            <div class="gray-content-block middle-block">
           {{ $issue->description }}
           </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <section class="col-md-9">
            <div class="issuable-discussion">
                <div class="comments">
                <ul class="comments main-comments-list timeline" id="comments-list">
                @forelse($issue->comments as $comment)
                <li class="comment comment-row-812342 timeline-entry" data-discussion="discussion-issue-120834-" id="comment_812342">
                    <div class="timeline-entry-inner">
                    <div class="timeline-icon">
                    <a href="{{ $comment->author->url }}">
                    <img alt="" class="avatar s40" src="{{ $comment->author->avatar }}">
                    </a>
                    </div>
                    <div class="timeline-content">
                    <div class="comment-header">
                    <a class="author_link" href="{{ $comment->author->url }}"><span class="author">{{ $comment->author->name }}</span></a>
                    <span class="author-username">
                    {{ '@' }}{{ $comment->author->username }}
                    </span>
                    <span class="comment-last-update">
                    <a href="#comment_812342" name="comment_812342" title="Link here">
                    <time class="comment_created_ago js-timeago" datetime="{{ $comment->created_at_iso }}" title="{{ $comment->created_at_iso }}" data-toggle="tooltip" data-placement="bottom" data-container="body">{{ $comment->created_at }}</time><script>
                    //<![CDATA[
                    $('.js-timeago-pending').removeClass('js-timeago-pending').timeago()
                    //]]>
                    </script>
                    </a>
                    </span>
                    </div>
                    <div class="comment-body">
                    <div class="comment-text">
                    {!! $comment->message !!}
                    </div>
                    </div>
                    <div class="clear"></div>
                    </div>
                    </div>
                </li>
                @empty
                @endforelse
                </ul>
                </div>
            </div>
            <hr>
            <form class="form-horizontal" name="CommentForm" action="{{ $issue->project->url }}/comments" method="POST">
            <input type="hidden" name="comment[commentable_type]" value="Issue">
            <input type="hidden" name="comment[commentable_id]" value="{{ $issue->id }}">
            <fieldset>
                <div class="form-group">
                    <label class="control-label">{{ trans('forms.issues.description') }}</label>
                    <div class="col-sm-10">
                        <div class='markdown-control'>
                            <textarea name="comment[message]" class="form-control autosize" rows="8" required>{{ Input::old('issue.description') }}</textarea>
                        </div>
                        <!--<div class="help-block pull-right">{{ trans('forms.issues.description-help') }}</div>-->
                    </div>
                </div>
                <div class="form-actions">
                     <button type="submit" class="btn btn-success">Add Comment</button>
                     <a class="btn btn-close" href="">Close issue</a>
                </div>
            </fieldset>
            </form>
        </section>
        <aside class="col-md-3">
            <div class="description-block subscribed">
            You're receiving notifications because you're subscribed to this thread.
            </div>
        </aside>
    </div>
</div>
@stop