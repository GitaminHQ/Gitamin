@extends('layout.dashboard')

@section('content')
    
<div class="content-wrapper">
    <div class="header sub-header">
        <div class="sidebar-toggler visible-xs">
            <i class="fa fa-navicon"></i>
        </div>
        <i class="fa fa-cubes"></i> {{ trans('dashboard.projects.projects') }}
        &gt; <small>{{ trans('dashboard.projects.edit.title') }}</small>
    </div>
    @include('projects.partials.sub-navbar')
    <div class="row">
        <div class="col-sm-12">
            @include('dashboard.partials.errors')
            <form name="CreateProjectForm" class="form-horizontal" role="form" action="{{ route('projects.project_update', ['owner'=>$project->owner_path, 'path'=>$project->path]) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                    <div class="form-group">
                        <label class="control-label">{{ trans('forms.projects.path') }}</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" name="project[path]" class="form-control" value="{{ $project->path }}" required>
                                <div class="input-group-addon">
                                    .git
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="project-name">{{ trans('forms.projects.name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="project[name]" id="project-name" value="{{ $project->name }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{ trans('forms.projects.description') }}</label>
                        <div class="col-sm-10">
                            <textarea name="project[description]" class="form-control" rows="4">{{ $project->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="project_visibility_level">{{ trans('forms.projects.visibility_level') }}</label>
                        <div class="col-sm-10">
                            <select name="project[visibility_level]" class="form-control">
                                @foreach(trans('gitamin.projects.status') as $statusID => $status)
                                <option value="{{ $statusID }}" {{ $statusID === $project->visibility_level ? "selected" : "" }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="project-tags">{{ trans('forms.projects.tags') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="project[tags]" id="project-tags" value="{{ $project->tagsList }}">
                            <p class="help-block">{{ trans('forms.projects.tags-help') }}</p>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="features">
                    <legend>Features:</legend>
                    <div class="form-group">
                        <label class="control-label"></label>
                        <div class="col-sm-10">
                            <input {!! $project->issues_enabled ? 'checked="checked"' : null !!} type="checkbox" name="project[issues_enabled]" value="1">
                            <strong>Issues</strong> - Lightweight issue tracking system for this project.
                        </div>
                    </div>
                     <div class="form-group">  
                     <label class="control-label"></label> 
                        <div class="col-sm-10">    
                            <input {!! $project->pull_requests_enabled ? 'checked="checked"' : null !!} checked="checked" type="checkbox" name="project[pull_requests_enabled]" value="1">
                            <strong>Pull Requests</strong> - Submit changes to be merged upstream.
                        </div>
                    </div>
                    <div class="form-group">  
                     <label class="control-label"></label> 
                        <div class="col-sm-10">    
                            <input {!! $project->snippets_enabled ? 'checked="checked"' : null !!} checked="checked" type="checkbox" name="project[snippets_enabled]" value="1">
                            <strong>Snippets</strong> - Share code pastes with others out of git repository.
                        </div>
                    </div>

                </fieldset>
                <input type="hidden" name="project[id]" value="{{ $project->id }}">
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                    <a class="btn btn-cancel" href="{{ back_url('projects.project_show', ['owner' => $project->owner_path, 'project' => $project->path]) }}">{{ trans('forms.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-12">
        <div class='panel panel-default panel panel-danger'>
            <div class='panel-heading'>Remove project</div>
                <div class='panel-body'>
                    <form class="form-horizontal" action="{{ route('projects.project_update', ['owner'=>$project->owner_path, 'path'=>$project->path]) }}" accept-charset="UTF-8" method="post">
                    <input name="utf8" type="hidden" value="&#x2713;" />
                    <input type="hidden" name="_method" value="delete" />
                    <p>
                    Removing the project will delete its repository and all related resources including issues, merge requests etc.
                    <br>
                    <strong>Removed projects cannot be restored!</strong>
                    </p>
                    <div class='form-actions'>
                    <form class="button_to" method="post" action="#">
                    <input class="btn btn-remove js-confirm-danger" data-confirm-danger-message="You are going to remove {{ $project->owner_path }} / {{ $project->path }}.
                     Removed project CANNOT be restored!
                     Are you ABSOLUTELY sure?" type="submit" value="Remove project" />
                     </form>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('partials.confirm_modal', ['phrase' => $project->path])
</div>
@stop
