@extends('layout.admin')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-gear"></i> {{ trans('admin.settings.general.general') }}
                </span>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form id="settings-form" name="SettingsForm" class="form-horizontal" role="form" action="/admin/settings" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('dashboard.partials.errors')
                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ trans('forms.settings.general.site-name') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="app_name" value="{{ $app_name }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ trans('forms.settings.general.site-url') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="app_domain" value="{{ $app_domain }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ trans('forms.settings.general.git-client-path') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="git_client_path" value="{{ $git_client_path }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ trans('forms.settings.general.git-repositories-path') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="git_repositories_path" value="{{ $git_repositories_path }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ trans('forms.settings.general.days-of-issues') }}</label>
                                        <div class="col-sm-10">
                                            <input type="number" max="100" name="app_issue_days" class="form-control" value="{{ Setting::get('app_issue_days', 7) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                        <input type="hidden" value="0" name="enable_subscribers">
                                        <input type="checkbox" value="1" name="enable_subscribers" {{ Setting::get('enable_subscribers') ? 'checked' : null }}>
                                        {{ trans('forms.settings.general.subscribers') }}
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="remove_banner" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
