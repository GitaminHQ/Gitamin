@extends('layout.project')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('gitamin.projects.new.title') }}</div>
            <div class="panel-body">
                @include('dashboard.partials.errors')
                <form name="CreateProjectForm" class="form-horizontal js-requires-input" role="form" action="/projects/create" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('forms.projects.path') }}</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" name="project[path]" class="form-control" value="{{ Input::old('project.path') }}" required="required">
                                    <div class="input-group-addon">
                                        .git
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="project-name">{{ trans('forms.projects.name') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="project[name]"  value="{{ Input::old('project.name') }}" id="project-name" required="required">
                            </div>
                        </div>
                        @if($owners->count() > 0)
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('forms.projects.owner') }}</label>
                            <div class="col-sm-6">
                            <select name="project[owner_id]" class="form-control select2" tableindex="2">
                                <optgroup label="Users">
                                @foreach($owners as $owner)
                                @if($owner->type == 'User')
                                <option value="{{ $owner->id }}" {!! $current_user->id == $owner->user_id ? 'selected="selected"' : null !!}>{{ $owner->name }}</option>
                                @endif
                                @endforeach
                                </optgroup>
                                <optgroup label="Groups">
                                @foreach($owners as $owner)
                                @if($owner->type == 'Group')
                                <option value="{{ $owner->id }}" {{ Input::old('project.owner_id') == $owner->id ? 'selected' : null }}>{{ $owner->name }}</option>
                                @endif
                                @endforeach
                                </optgroup> 
                            </select>
                            </div>
                        </div>
                        @else
                        <input type="hidden" name="project[owner_id]" value="0">
                        @endif
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="project-import">{{ trans('forms.projects.import') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="project[import]"  value="{{ Input::old('project.import') }}" id="project-import">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('forms.projects.description') }}</label>
                            <div class="col-sm-6">
                                <textarea name="project[description]" class="form-control" rows="4">{{ Input::old('project.description') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="project_visibility_level">{{ trans('forms.projects.visibility_level') }}</label>
                            <div class="col-sm-6">
                                <select name="project[visibility_level]" class="form-control">
                                    @foreach(trans('gitamin.projects.status') as $statusID => $status)
                                    <option value="{{ $statusID }}" {{ Input::old('project.visibility_level') == $statusID ? 'selected' : null}}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">{{ trans('forms.create') }}</button>
                            <a class="btn btn-default" href="{{ back_url('dashboard.projects.index') }}">{{ trans('forms.cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection