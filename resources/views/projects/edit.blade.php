@extends('layout.dashboard')

@section('content')
    <div class="header">
        <div class="sidebar-toggler visible-xs">
            <i class="icon ion-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="fa fa-cubes"></i> {{ trans('dashboard.projects.projects') }}
        </span>
        &gt; <small>{{ trans('dashboard.projects.edit.title') }}</small>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                @include('dashboard.partials.errors')
                <form name="CreateProjectForm" class="form-horizontal" role="form" action="{{ route('projects.project_update', ['namespace'=>$project->namespace, 'path'=>$project->path]) }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="form-group">
                            <label class="control-label">{{ trans('forms.projects.slug') }}</label>
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
                                <input type="text" class="form-control" name="project[tags]" id="project-tags" value="{{ $project->tagsList }}" required>
                                <p class="help-block">{{ trans('forms.projects.tags-help') }}</p>
                            </div>
                        </div>
                    </fieldset>
                    <input type="hidden" name="project[id]" value="{{ $project->id }}">
                    <input type="hidden" name="project[order]" value="0">

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                        <a class="btn btn-default" href="{{ route('dashboard.projects.index') }}">{{ trans('forms.cancel') }}</a>
                        <div class="pull-right">
                            <div class="light inline">
                            <div class="space-right">
                                Need a group for several dependent projects?
                            </div>
                            </div>
                            <a class="btn btn-default" href="/groups/new">Create a group</a>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
