@extends('layout.dashboard')

@section('content')
    <div class="header">
        <div class="sidebar-toggler visible-xs">
            <i class="fa fa-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="fa fa-exclamation-circle"></i> {{ trans('dashboard.issues.issues') }}
        </span>
        &gt; <small>{{ trans('dashboard.issues.add.title') }}</small>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                @include('dashboard.partials.errors')
                <form class="form-horizontal" name="IssueForm" role="form" method="POST" autocomplete="off">
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
                                    <textarea name="issue['description]" class="form-control autosize" rows="8" required>{{ Input::old('issue.description') }}</textarea>
                                </div>
                                <div class="help-block pull-right">{{ trans('forms.issues.description-help') }}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="issue-visible">{{ trans('forms.issues.visibility') }}</label>
                            <div class="col-sm-10">
                            <select name='visible' class="form-control">
                                <option value='1' selected>{{ trans('forms.issues.public') }}</option>
                                <option value='0'>{{ trans('forms.issues.logged_in_only') }}</option>
                            </select>
                            </div>
                        </div>
                        
                    </fieldset>

                    <div class="form-actions">
                            <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                            <a class="btn btn-cancel" href="{{ route('projects.issue_index', ['namespace'=>$project->namespace, 'project'=>$project->path]) }}">{{ trans('forms.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
