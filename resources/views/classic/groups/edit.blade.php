@extends('layout.dashboard')

@section('body')
@include('dashboard.partials.navigation')

<div class="container">
<div class="row">
    <div class="col-xs-6 col-sm-3 sidebar">
        <div class="list-group">
            <div class="list-group-item active">Settings</div>
            <a href="#" class="list-group-item">Member privileges</a>
            <a href="#" class="list-group-item">Team settings</a>
            <a href="#" class="list-group-item">Applications</a>
            <a href="#" class="list-group-item">Webhooks</a>
        </div>
    </div>
    <div class="col-xs-12 col-sm-9 main">
    @include('dashboard.partials.errors')
        <div class="panel panel-default">
        <div class="panel-heading">{{ trans('gitamin.groups.groups') }}</div>
        <div class="panel-body">
            <form name="CreateProjectTeamForm" class="form-horizontal js-requires-input" role="form" action="{{ route('groups.group_update', ['owner'=>$group->path])}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="group-path">{{ trans('forms.groups.path') }}</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-addon">{{ url('/') }}/</div>
                                <input type="text" class="form-control" name="group[path]" id="group-path" placeholder="open-source" value="{{ $group->path }}" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="group-name">{{ trans('forms.groups.name') }}</label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" name="group[name]" id="group-name" value="{{ $group->name }}" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">{{ trans('forms.groups.description') }}</label>
                        <div class="col-sm-6">
                            <textarea name="group[description]" class="form-control" rows="4">{{ $group->description }}</textarea>
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
                    <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                    <a class="btn btn-cancel" href="{{ back_url('owners.owner_show', ['owner' => $group->path]) }}">{{ trans('forms.cancel') }}</a>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
</div>
@endsection