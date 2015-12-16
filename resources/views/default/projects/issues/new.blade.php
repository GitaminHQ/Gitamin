@extends('layout.dashboard')

@section('content')
    
<div class="content-wrapper">
    <div class="header sub-header">
        <div class="sidebar-toggler visible-xs">
            <i class="fa fa-navicon"></i>
        </div>
        <i class="fa fa-exclamation-circle"></i> {{ trans('dashboard.issues.issues') }}
        &gt; <small>{{ trans('dashboard.issues.add.title') }}</small>
    </div>
    @include('projects.partials.sub-navbar')
    <div class="row">
        <div class="col-md-12">
            @include('dashboard.partials.errors')
            <form class="form-horizontal" name="IssueForm" action="{{ route('projects.issue_index', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}" role="form" method="POST" autocomplete="off">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                    <div class="form-group">
                        <label class="control-label" for="issue-title">{{ trans('forms.issues.title') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="issue[title]" id="issue-title" required value="{{ Input::old('issue.title') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{ trans('forms.issues.description') }}</label>
                        <div class="col-sm-10">
                            <div class='markdown-control'>
                                <textarea name="issue[description]" class="form-control autosize" rows="8" required>{{ Input::old('issue.description') }}</textarea>
                            </div>
                            <!--<div class="help-block pull-right">{{ trans('forms.issues.description-help') }}</div>-->
                        </div>
                    </div>
                    <!--
                    <div class="form-group">
                        <label class="control-label" for="issue_assignee_id"><i class="fa fa-user"></i> {{ trans('forms.issues.assign_to') }}</label>
                        <div class="col-sm-4">
                        <select name='issue[assignee_id]' class="form-control select2">
                            <option></option>
                            <option value='1' selected>{{ trans('forms.issues.public') }}</option>
                            <option value='0'>{{ trans('forms.issues.logged_in_only') }}</option>
                        </select>
                        
                        </div>
                        <div class="col-sm-6">
                            <a class="btn assign-to-me-link" href="#">{{ trans('forms.issues.assign_to_me')}}</a>
                        </div>
                    </div>
                    -->
                    
                </fieldset>

                <div class="form-actions">
                        <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                        <a class="btn btn-cancel" href="{{ back_url('projects.issue_index', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}">{{ trans('forms.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
