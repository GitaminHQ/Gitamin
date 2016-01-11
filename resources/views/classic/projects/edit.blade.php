@extends('layout.project')

@section('content')
<div class="row">
    <div class="col-xs-6 col-sm-3 sidebar">
        <div class="list-group">
            <div class="list-group-item active">Options</div>
            <a href="#" class="list-group-item">Collaborators & teams</a>
            <a href="#" class="list-group-item">Branches</a>
            <a href="#" class="list-group-item">Webhooks & services</a>
            <a href="#" class="list-group-item">Deploy keys</a>
        </div>
    </div>
    <div class="col-xs-12 col-sm-9 main">
    @include('dashboard.partials.errors')
        <div class="panel panel-default">
        <div class="panel-heading">{{ trans('gitamin.projects.edit.title') }}</div>
        <div class="panel-body">
        <form name="CreateProjectForm" class="form-horizontal js-requires-input" role="form" action="{{ route('projects.project_update', ['owner'=>$project->owner_path, 'path'=>$project->path]) }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>
                <div class="form-group">
                    <label class="col-md-4 control-label">{{ trans('forms.projects.path') }}</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" name="project[path]" class="form-control" value="{{ $project->path }}" required>
                            <div class="input-group-addon">
                                .git
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="project-name">{{ trans('forms.projects.name') }}</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="project[name]" id="project-name" value="{{ $project->name }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">{{ trans('forms.projects.description') }}</label>
                    <div class="col-sm-6">
                        <textarea name="project[description]" class="form-control" rows="4">{{ $project->description }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="project_visibility_level">{{ trans('forms.projects.visibility_level') }}</label>
                    <div class="col-sm-6">
                        <select name="project[visibility_level]" class="form-control">
                            @foreach(trans('gitamin.projects.status') as $statusID => $status)
                            <option value="{{ $statusID }}" {{ $statusID === $project->visibility_level ? "selected" : "" }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="project-tags">{{ trans('forms.projects.tags') }}</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="project[tags]" id="project-tags" value="{{ $project->tagsList }}">
                        <p class="help-block">{{ trans('forms.projects.tags-help') }}</p>
                    </div>
                </div>
            </fieldset>
            <input type="hidden" name="project[id]" value="{{ $project->id }}">
            <div class="form-actions text-center">
                <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                <a class="btn btn-cancel" href="{{ back_url('projects.project_show', ['owner' => $project->owner_path, 'project' => $project->path]) }}">{{ trans('forms.cancel') }}</a>
            </div>
        </form>
        </div>
        </div>
    </div>
</div>
@endsection
