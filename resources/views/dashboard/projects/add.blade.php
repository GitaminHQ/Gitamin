@extends('layout.dashboard')

@section('content')
    <div class="header">
        <div class="sidebar-toggler visible-xs">
            <i class="icon ion-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="fa fa-cubes"></i> {{ trans('dashboard.projects.projects') }}
        </span>
        &gt; <small>{{ trans('dashboard.projects.add.title') }}</small>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                @include('dashboard.partials.errors')
                <form name="CreateProjectForm" class="form-horizontal" role="form" action="/dashboard/projects/add" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>  
                        <div class="form-group">
                            <label class="control-label" for="project-name">{{ trans('forms.projects.name') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="project[name]" id="project-name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{ trans('forms.projects.slug') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="project[slug]" class="form-control" required>
                            </div>
                        </div>
                        @if($teams->count() > 0)
                        <div class="form-group">
                            <label class="control-label">{{ trans('forms.projects.team') }}</label>
                            <div class="col-sm-10">
                            <select name="project[team_id]" class="form-control">
                                <option value="0" selected></option>
                                @foreach($teams as $team)
                                <option value="{{ $team->id }}" {{ $team_id === $team->id ? 'selected' : null }}>{{ $team->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        @else
                        <input type="hidden" name="project[team_id]" value="0">
                        @endif
                        <div class="form-group">
                            <label class="control-label">{{ trans('forms.projects.description') }}</label>
                            <div class="col-sm-10">
                                <textarea name="project[description]" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="project-status">{{ trans('forms.projects.status') }}</label>
                            <div class="col-sm-10">
                                <select name="project[status]" class="form-control">
                                    @foreach(trans('gitamin.projects.status') as $statusID => $status)
                                    <option value="{{ $statusID }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <hr>
                        <div class="form-group">
                            <label class="control-label">{{ trans('forms.projects.tags') }}</label>
                            <div class="col-sm-10">
                                <input name="project[tags]" class="form-control">
                                <span class="help-block">{{ trans('forms.projects.tags-help') }}</span>
                            </div>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="hidden" value="0" name="project[enabled]">
                                <input type="checkbox" value="1" name="project[enabled]" checked>
                                {{ trans('forms.projects.enabled') }}
                            </label>
                        </div>
                    </fieldset>

                    <input type="hidden" name="project[order]" value="0">

                    <div class="btn-group">
                        <button type="submit" class="btn btn-success">{{ trans('forms.create') }}</button>
                        <a class="btn btn-default" href="{{ route('dashboard.projects.index') }}">{{ trans('forms.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
