@extends('layout.dashboard')

@section('content')
    
<div class="content-wrapper">
    <div class="header sub-header">
        <div class="sidebar-toggler visible-xs">
            <i class="fa fa-navicon"></i>
        </div>
        <i class="fa fa-group"></i> {{ trans_choice('gitamin.groups.groups', 2) }}
        &gt; <small>{{ trans('gitamin.groups.add.title') }}</small>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @include('dashboard.partials.errors')
            <form name="CreateProjectTeamForm" class="form-horizontal" role="form" action="/groups/create" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                    <div class="form-group">
                        <label class="control-label" for="group-path">{{ trans('forms.groups.path') }}</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-addon">{{ url() }}/</div>
                                <input type="text" class="form-control" name="group[path]" value="{{ Input::old('group.path') }}" id="group-path" placeholder="open-source" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="group-name">{{ trans('forms.groups.name') }}</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="group[name]" value="{{ Input::old('group.name') }}" id="group-name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{ trans('forms.groups.description') }}</label>
                        <div class="col-sm-10">
                            <textarea name="group[description]" class="form-control" rows="4">{{ Input::old('group.description') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="group-avatar">{{ trans('forms.groups.avatar') }}</label>
                        <div class="col-sm-10">
                        <input type="file" class="form-control" name="group[avatar]" id="group-avatar">
                        </div>
                    </div>

                </fieldset>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">{{ trans('forms.create') }}</button>
                    <a class="btn btn-cancel" href="{{ back_url('dashboard.groups.index') }}">{{ trans('forms.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
