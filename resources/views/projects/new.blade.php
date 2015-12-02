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
                <form name="CreateProjectForm" class="form-horizontal" role="form" action="/projects/create" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="form-group">
                            <label class="control-label">{{ trans('forms.projects.slug') }}</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" name="project[slug]" class="form-control" required>
                                    <div class="input-group-addon">
                                        .git
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="project-name">{{ trans('forms.projects.name') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="project[name]" id="project-name" required>
                            </div>
                        </div>
                        @if($groups->count() > 0)
                        <div class="form-group">
                            <label class="control-label">{{ trans('forms.projects.namespace') }}</label>
                            <div class="col-sm-10">
                            <select name="project[namespace_id]" class="form-control">
                                <option value="0" selected></option>
                                @foreach($groups as $group)
                                <option value="{{ $group->id }}" {{ $group_id === $group->id ? 'selected' : null }}>{{ $group->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        @else
                        <input type="hidden" name="project[namespace_id]" value="0">
                        @endif
                        <div class="form-group">
                            <label class="control-label" for="project-import">{{ trans('forms.projects.import') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="project[import]" id="project-import">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{ trans('forms.projects.description') }}</label>
                            <div class="col-sm-10">
                                <textarea name="project[description]" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="project_visibility_level">{{ trans('forms.projects.visibility_level') }}</label>
                            <div class="col-sm-10">
                                <select name="project[visibility_level]" class="form-control">
                                    @foreach(trans('gitamin.projects.status') as $statusID => $status)
                                    <option value="{{ $statusID }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <input type="hidden" name="project[order]" value="0">

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">{{ trans('forms.create') }}</button>
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
