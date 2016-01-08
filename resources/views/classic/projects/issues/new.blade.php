@extends('layout.project')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-9 main">
    @include('dashboard.partials.errors')
        <div class="panel panel-default">
        <div class="panel-heading">{{ trans('dashboard.issues.new.title') }}</div>
        <div class="panel-body">
        <form name="CreateProjectForm" class="form-horizontal" role="form" action="{{ route('projects.issue_index', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="issue-title">{{ trans('forms.issues.title') }}</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="issue[title]" id="issue-title" value="{{ Input::old('issue.title') }}" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">{{ trans('forms.issues.description') }}</label>
                    <div class="col-sm-6">
                        <textarea name="issue[description]" class="form-control" rows="4">{{ Input::old('issue.description') }}</textarea>
                    </div>
                </div>
            </fieldset>
            <div class="form-actions text-center">
                <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                <a class="btn btn-cancel" href="{{ back_url('projects.issue_index', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}">{{ trans('forms.cancel') }}</a>
            </div>
        </form>
        </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 sidebar">
        <div class="list-group">
            <div class="list-group-item active">Options</div>
            <a href="#" class="list-group-item">Lables</a>
            <a href="#" class="list-group-item">Milestones</a>
            <a href="#" class="list-group-item">Assignee</a>
        </div>
    </div>
</div>
@endsection
