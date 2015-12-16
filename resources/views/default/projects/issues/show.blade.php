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
        {{ $issue->title }}
        <a href="{{ $issue->url }}/edit" class="btn btn-sm btn-success pull-right">{{ trans('forms.edit') }}</a> 
        <a href="new" class="btn btn-sm btn-close pull-right">Close</a>
        </div>
    </div>
    <hr>
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
            <div class="striped-list">
                @forelse($issue->comments() as $comment)
                <div class="row striped-list-item">
                    <div class="col-xs-6">
                    <p>#{{ $comment->id }} {{ $comment->message }}</p>
                    </div>
                    <div class="col-xs-6 text-right">
                        <a href="{{ $issue->url }}/delete" class="btn btn-sm btn-danger confirm-action" data-method='DELETE'>{{ trans('forms.delete') }}</a>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
            <hr>
            <form class="form-horizontal" name="CommentForm" action="{{ $issue->project->url }}/comments" method="POST">
            <input type="hidden" name="comment[target_type]" value="Issue">
            <input type="hidden" name="comment[target_id]" value="{{ $issue->id }}">
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