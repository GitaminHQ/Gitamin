@extends('layout.project')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('gitamin.groups.new.title') }}</div>
            <div class="panel-body">
                @include('dashboard.partials.errors')
                <form name="CreateProjectTeamForm" class="form-horizontal js-requires-input" role="form" action="/groups/create" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="group-path">{{ trans('forms.groups.path') }}</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-addon">{{ url('/') }}/</div>
                                <input type="text" class="form-control" name="group[path]" value="{{ Input::old('group.path') }}" id="group-path" placeholder="open-source" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="group-name">{{ trans('forms.groups.name') }}</label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" name="group[name]" value="{{ Input::old('group.name') }}" id="group-name"  required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">{{ trans('forms.groups.description') }}</label>
                        <div class="col-sm-6">
                            <textarea name="group[description]" class="form-control" rows="4">{{ Input::old('group.description') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="group-avatar">{{ trans('forms.groups.avatar') }}</label>
                        <div class="col-sm-6">
                        <input type="file" class="form-control" name="group[avatar]" id="group-avatar">
                        </div>
                    </div>
                </fieldset>
                <div class="form-actions text-center">
                <button type="submit" class="btn btn-success">{{ trans('forms.create') }}</button>
                <a class="btn btn-cancel" href="{{ back_url('dashboard.groups.index') }}">{{ trans('forms.cancel') }}</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection