@extends('layout.dashboard')

@section('content')
    <div class="header">
        <div class="sidebar-toggler visible-xs">
            <i class="icon ion-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="fa fa-cubes"></i> <a href="{{ route('dashboard.projects.index') }}">{{ trans('dashboard.projects.projects') }}</a>
        </span>
        &gt; <small>{{ trans('dashboard.projects.edit.title') }}</small>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                @include('dashboard.partials.errors')
                <form name="EditProjectForm" class="form-horizontal" role="form" action="/dashboard/projects/{{ $project->id }}/edit" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="form-group">
                            <label class="control-label" for="project-name">{{ trans('forms.projects.name') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="project[name]" id="project-name" required value="{{ $project->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="project-slug">{{ trans('forms.projects.slug') }}</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" name="project[slug]" class="form-control" value="{{ $project->slug }}">
                                    <div class="input-group-addon">.git</div>
                                </div>
                            </div>
                        </div>
                        @if($teams->count() > 0)
                        <div class="form-group">
                            <label class="control-label">{{ trans('forms.projects.team') }}</label>
                            <div class="col-sm-10">
                            <select name="project[team_id]" class="form-control">
                                <option value="0" {{ $project->team_id === null ? 'selected' : null }}></option>
                                @foreach($teams as $team)
                                <option value="{{ $team->id }}" {{ $project->team_id === $team->id ? 'selected' : null }}>{{ $team->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        @else
                        <input type="hidden" name="project[team_id]" value="0">
                        @endif
                        <div class="form-group">
                            <label class="control-label" for="project-description">{{ trans('forms.projects.description') }}</label>
                            <div class="col-sm-10">
                                <textarea name="project[description]" class="form-control" rows="5">{{ $project->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="project-status">{{ trans('forms.projects.status') }}</label>
                            <div class="col-sm-10">
                            <select name="project[status]" class="form-control">
                                @foreach(trans('gitamin.projects.status') as $statusID => $status)
                                <option value="{{ $statusID }}" {{ $statusID === $project->status ? "selected" : "" }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>   
                        <hr>
                        <div class="form-group">
                            <label class="control-label">{{ trans('forms.projects.tags') }}</label>
                            <div class="col-sm-10">
                                <input name="project[tags]" class="form-control" value="{{ $project->tagsList }}">
                                <span class="help-block">{{ trans('forms.projects.tags-help') }}</span>
                            </div>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="hidden" value="0" name="project[enabled]">
                                <input type="checkbox" value="1" name="project[enabled]" {{ $project->enabled ? "checked" : null }}>
                                {{ trans('forms.projects.enabled') }}
                            </label>
                        </div>
                    </fieldset>

                    <input type="hidden" name="project[user_id]" value="{{ $project->agent_id || $current_user->id }}">
                    <input type="hidden" name="project[order]" value="{{ $project->order or 0 }}">

                    <div class="btn-group">
                        <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                        <a class="btn btn-default" href="{{ route('dashboard.projects.index') }}">{{ trans('forms.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @stop
