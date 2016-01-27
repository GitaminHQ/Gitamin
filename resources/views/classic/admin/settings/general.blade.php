@extends('layout.master')

@section('content')

@include('admin.partials.sidebar')

<div class="col-xs-12 col-sm-9 main">
    @include('dashboard.partials.errors')
    <div class="panel panel-default">
    <div class="panel-heading">{{ trans('admin.title') }}</div>
    <div class="panel-body">
        <form id="settings-form" name="SettingsForm" class="form-horizontal" role="form" action="/admin/settings" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="remove_banner" value="">
            <fieldset>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('forms.settings.general.site-name') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="app_name" value="{{ $app_name }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('forms.settings.general.site-url') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="app_domain" value="{{ $app_domain }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('forms.settings.general.git-client-path') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="git_client_path" value="{{ $git_client_path }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('forms.settings.general.git-repositories-path') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="git_repositories_path" value="{{ $git_repositories_path }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('forms.settings.general.days-of-issues') }}</label>
                            <div class="col-sm-6">
                                <input type="number" max="100" name="app_issue_days" class="form-control" value="{{ Config::get('setting.app_issue_days', 7) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                            <input type="hidden" value="0" name="enable_subscribers">
                            <input type="checkbox" value="1" name="enable_subscribers" {{ Config::get('setting.enable_subscribers') ? 'checked' : null }}>
                            {{ trans('forms.settings.general.subscribers') }}
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-actions text-center">
                        <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection
