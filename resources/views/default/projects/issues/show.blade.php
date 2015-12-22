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
    <div class="issue-details issuable-details">
        <div class="row">
            <div class="col-sm-12">
                <div class="detail-page-description gray-content-block second-block">
                <h2 class="title">{{ $issue->title }}</h2>
                <div class="description">
                   {!! $issue->formattedMessage !!}
                </div>
               </div>
            </div>
        </div>

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
                    <form class="new_note common-comment-form gfm-form js-main-target-form js-requires-input" action="{{ $issue->project->url }}/comments" method="POST">
                        <input type="hidden" name="comment[commentable_type]" value="Issue">
                        <input type="hidden" name="comment[commentable_id]" value="{{ $issue->id }}">
                        <fieldset>
                            <div class="form-group">
                                <label class="control-label">{{ trans('forms.comments.message') }}</label>
                                <textarea name="comment[message]" class="comment_text js-comment-text js-quick-submit js-gfm-input markdown-area" required="required">{{ Input::old('comment.message') }}</textarea>
                            </div>
                            <div class="comment-form-actions clearfix">
                                 <button type="submit" class="btn btn-create comment-btn btn-grouped js-comment-button">Add Comment</button>
                            </div>
                        </fieldset>
                    </form>
                    </div>
                </div>
            </section>
            <aside class='col-md-3'>
                <div class='issuable-sidebar issuable-affix'>
                    <form class="issuable-context-form inline-update js-issuable-update" id="edit_issue_120834" action="/gitlab-org/gitlab-ce/issues/1052" accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="_method" value="patch" /><div class='block assignee'>
                    <div class='title'>
                    <label>
                    Assignee
                    </label>
                    </div>
                    <div class='value'>
                    <div class='light'>None</div>
                    </div>
                    <div class='selectbox'>
                    <input type="hidden" name="issue[assignee_id]" id="issue_assignee_id" value="" class="ajax-users-select custom-form-control js-select2 js-assignee" data-placeholder="Select assignee" data-null-user="true" data-any-user="false" data-email-user="false" data-first-user="hifone" data-current-user="true" data-push-code-to-protected-branches="null" data-project-id="13083" />
                    </div>
                    </div>
                    <div class='block milestone'>
                    <div class='title'>
                    <label>
                    Milestone
                    </label>
                    </div>
                    <div class='value'>
                    <div class='light'>None</div>
                    </div>
                    <div class='selectbox'>
                    <select class="select2 select2-compact js-select2 js-milestone" data-placeholder="Select milestone" name="issue[milestone_id]" id="issue_milestone_id"><option value=""></option>
                    <option value="0">No Milestone</option>
                    <option value="35029">8.7</option>
                    <option value="31262">8.6</option>
                    <option value="22434">Support</option>
                    <option value="20976">8.1</option></select>
                    <input type="hidden" name="issuable_context" id="issuable_context" />
                    <input type="submit" name="commit" value="Update Issue" class="btn hide" />
                    </div>
                    </div>
                    <div class='block'>
                    <div class='title'>
                    <label>Labels</label>
                    </div>
                    <div class='value issuable-show-labels'>
                    <a href="{{ $issue->url }}"><span class="label color-label" style="background-color: #fca327; color: #FFFFFF">feature proposal</span></a>
                    </div>
                    <div class='selectbox'>
                    <input name="issue[label_ids][]" type="hidden" value="" />
                    <select multiple="multiple" class="select2 js-select2" data-placeholder="Select labels" name="issue[label_ids][]" id="issue_label_ids">
                    @foreach($issue->labels as $label)
                    <option value="{{ $label->id }}">{{ $label->title }}</option>
                    @endforeach
                    </select>
                    </div>
                    </div>
                    <div class='block weight'>
                    <div class='title'>
                    <label>Weight</label>
                    </div>
                    <div class='value'>
                    <div class='light'>None</div>
                    </div>
                    <div class='selectbox'>
                    <select class="select2 js-select2" data-placeholder="Select weight" name="issue[weight]" id="issue_weight"><option value=""></option>
                    <option value="">Any</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option></select>
                    </div>
                    </div>
                    <div class='block'>
                    <div class='title'>
                    Cross-project reference
                    </div>
                    <div class='cross-project-reference'>
                    <span id='cross-project-reference'>
                    <a href="{{ $issue->project->url }}">{{ $issue->project->name }}</a>
                    </span>
                    <button class="btn btn-xs btn-clipboard" data-clipboard-target="span#cross-project-reference" type="button"><i class="fa fa-clipboard"></i></button>
                    </div>
                    </div>
                    <div class='block participants'>
                    <div class='title'>
                    1 participants
                    </div>
                    <a class="author_link has_tooltip" data-original-title="{{ $issue->author->username }}" data-container="body" href="{{ $issue->author->url }}"><img width="24" class="avatar avatar-inline s24" alt="" src="{{ $issue->author->avatar }}" /></a>
                    </div>

                    <div class='block light'>
                    <div class='title'>
                    <label class='light'>Notifications</label>
                    </div>
                    <button class='btn btn-block btn-gray subscribe-button' type='button'>
                    <span>Unsubscribe</span>
                    </button>
                    <div class='subscription-status' data-status='subscribed'>
                    <div class='hidden unsubscribed'>
                    You're not receiving notifications from this thread.
                    </div>
                    <div class='subscribed'>
                    You're receiving notifications because you're subscribed to this thread.
                    </div>
                    </div>
                    </div>
                    </form>
                </div>
            </aside>
        </div>
    </div>
</div>
@stop