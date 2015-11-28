@extends('layout.clean')

@section('pageTitle', trans('install.install'))

@section('content')
<div class="install-page">
    <div class="text-center">
        <img class="logo" height="90" src="/img/install-logo.png" alt="Gitamin">
        <h4>{{ trans('install.title') }}</h4>
        <br>
    </div>
    <div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2">
        <div class="steps">
            <div class="step active">
                {{ trans('install.env') }}
                <span></span>
            </div>
            <div class="step">
                {{ trans('install.site') }}
                <span></span>
            </div>
            <div class="step">
                {{ trans("install.admin_account") }}
                <span></span>
            </div>
            <div class="step">
                {{ trans("install.complete") }}
                <span></span>
            </div>
        </div>
        <div class="clearfix"></div>
        <form class="form-horizontal" name="InstallForm" method="POST" id="install-form" role="form">
            <div class="step block-1">
                <fieldset>
                    <div class="form-group">
                        <label>{{ trans('forms.install.cache_driver') }}</label>
                        <div class="col-sm-10">
                        <select name="env[cache_driver]" class="form-control" required>
                            <option disabled>{{ trans('forms.install.cache_driver') }}</option>
                            @foreach($cache_drivers as $driver => $driverName)
                            <option value="{{ $driver }}" {{ Input::old('env.cache_driver') == $driver ? "selected" : null }}>{{ $driverName }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('env.cache_driver'))
                        <span class="text-danger">{{ $errors->first('env.cache_driver') }}</span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('forms.install.session_driver') }}</label>
                        <div class="col-sm-10">
                        <select name="env[session_driver]" class="form-control" required>
                            <option disabled>{{ trans('forms.install.session_driver') }}</option>
                            @foreach($cache_drivers as $driver => $driverName)
                            <option value="{{ $driver }}" {{ Input::old('env.session_driver') == $driver ? "selected" : null }}>{{ $driverName }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('env.session_driver'))
                        <span class="text-danger">{{ $errors->first('env.session_driver') }}</span>
                        @endif
                        </div>
                    </div>
                </fieldset>
                <hr>
                <div class="form-group text-center">
                    <span class="wizard-next btn btn-success" data-current-block="1" data-next-block="2" data-loading-text="<i class='icon ion-load-c'></i>">
                        {{ trans('install.next') }}
                    </span>
                </div>
            </div>
            <div class="step block-2 hidden">
                <fieldset>
                    <div class="form-group">
                        <label>{{ trans('forms.install.site_name') }}</label>
                        <div class="col-sm-10">
                        <input type="text" name="settings[app_name]" class="form-control" placeholder="{{ trans('forms.install.site_name') }}" value="{{ Input::old('settings.app_name', 'Gitamin') }}" required>
                        @if($errors->has('settings.app_name'))
                        <span class="text-danger">{{ $errors->first('settings.app_name') }}</span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('forms.install.site_domain') }}</label>
                        <div class="col-sm-10">
                        <input type="text" name="settings[app_domain]" class="form-control" placeholder="{{ trans('forms.install.site_domain') }}" value="{{ Input::old('settings.app_domain', url()) }}" required>
                        @if($errors->has('settings.app_domain'))
                        <span class="text-danger">{{ $errors->first('settings.app_domain') }}</span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('forms.install.git_client_path') }}</label>
                        <div class="col-sm-10">
                        <input type="text" name="settings[git_client_path]" class="form-control" placeholder="{{ trans('forms.install.git_client_path') }}" value="{{ Input::old('settings.git_client_path', '/usr/bin/git') }}" required>
                        @if($errors->has('settings.git_client_path'))
                        <span class="text-danger">{{ $errors->first('settings.git_client_path') }}</span>
                        @endif
                        </div>
                    </div>
                     <div class="form-group">
                        <label>{{ trans('forms.install.git_repositories_path') }}</label>
                        <div class="col-sm-10">
                        <input type="text" name="settings[git_repositories_path]" class="form-control" placeholder="{{ trans('forms.install.git_repositories_path') }}" value="{{ Input::old('settings.git_repositories_path', '/Users/guanshiliang/Code') }}" required>
                        @if($errors->has('settings.git_repositories_path'))
                        <span class="text-danger">{{ $errors->first('settings.git_repositories_path') }}</span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('forms.install.site_timezone') }}</label>
                        <div class="col-sm-10">
                        <select name="settings[app_timezone]" class="form-control" required>
                            <option value="">Select Timezone</option>
                            @foreach($timezones as $region => $list)
                            <optgroup label="{{ $region }}">
                            @foreach($list as $timezone => $name)
                            <option value="{{ $timezone }}" @if(Input::old('settings.app_timezone') == $timezone) selected @endif>
                                {{ $name }}
                            </option>
                            @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                        @if($errors->has('settings.app_timezone'))
                        <span class="text-danger">{{ $errors->first('settings.app_timezone') }}</span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('forms.install.site_locale') }}</label>
                        <div class="col-sm-10">
                        <select name="settings[app_locale]" class="form-control" required>
                            <option value="">Select Language</option>
                            @foreach($langs as $lang => $name)
                            <option value="{{ $lang }}" @if(Input::old('settings.app_locale') == $lang || $user_language == $lang) selected @endif>
                                {{ $name }}
                            </option>
                            @endforeach
                        </select>
                        @if($errors->has('settings.app_locale'))
                        <span class="text-danger">{{ $errors->first('settings.app_locale') }}</span>
                        @endif
                        </div>
                    </div>
                    <hr>
                    <div class="form-group text-center">
                        <span class="wizard-next btn btn-info" data-current-block="2" data-next-block="1">
                            {{ trans('install.previous') }}
                        </span>
                        <span class="wizard-next btn btn-success" data-current-block="2" data-next-block="3" data-loading-text="<i class='icon ion-load-c'></i>">
                            {{ trans('install.next') }}
                        </span>
                    </div>
                </fieldset>
            </div>
            <div class="step block-3 hidden">
                <fieldset>
                    <div class="form-group">
                        <label>{{ trans("forms.install.username") }}</label>
                        <div class="col-sm-10">
                        <input type="text" name="user[username]" class="form-control" placeholder="{{ trans('forms.install.username') }}" value="{{ Input::old('user.username', '') }}" required>
                        @if($errors->has('user.username'))
                        <span class="text-danger">{{ $errors->first('user.username') }}</span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans("forms.install.email") }}</label>
                        <div class="col-sm-10">
                        <input type="text" name="user[email]" class="form-control" placeholder="{{ trans('forms.install.email') }}" value="{{ Input::old('user.email', '') }}" required>
                        @if($errors->has('user.email'))
                        <span class="text-danger">{{ $errors->first('user.email') }}</span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans("forms.install.password") }}</label>
                        <div class="col-sm-10">
                        <input type="password" name="user[password]" class="form-control" placeholder="{{ trans('forms.install.password') }}" value="{{ Input::old('user.password', '') }}" required>
                        @if($errors->has('user.password'))
                        <span class="text-danger">{{ $errors->first('user.password') }}</span>
                        @endif
                        </div>
                    </div>
                </fieldset>
                <hr >
                <div class="form-group text-center">
                    <input type="hidden" name="settings[app_issue_days]" value="7" >
                    <span class="wizard-next btn btn-info" data-current-block="3" data-next-block="2">
                        {{ trans('install.previous') }}
                    </span>
                    <span class="wizard-next btn btn-success" data-current-block="3" data-next-block="4" data-loading-text="<i class='icon ion-load-c'></i>">
                        {{ trans("install.complete") }}
                    </span>
                </div>
            </div>
            <div class="step block-4 hidden">
                <div class="install-success">
                    <i class="ion-checkmark-circled"></i>
                    <h3>
                        {{ trans("install.completed") }}
                    </h3>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-default">
                        <span>{{ trans("install.finish") }}</span>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
