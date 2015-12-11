@extends('layout.clean')

@section('bodyClass', 'login')

@section('content')
<div class="container">
    <div class="login-panel">
        <div class="logo">
                <img src="/img/login-logo.png" />
            </div>
        <div class="form-bg">
            <form method="POST" action="{{ route('auth.login', [], false) }}" accept-charset="UTF-8" autocomplete="off" name="{{ str_random(10) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @if(Session::has('error'))
                <p>{{ Session::get('error') }}</p>
                @endif
                <div class="login-title">{{ trans('forms.login.title') }}</div>
                <div class="form-group">
                    <label class="control-label">{{ trans('forms.login.email') }}</label>
                    <input autocomplete="off" class="form-control login-input" placeholder="{{ trans('forms.login.email') }}" required="required" name="email" type="email" autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label">{{ trans('forms.login.password') }}</label>
                    <input autocomplete="off" class="form-control login-input" placeholder="{{ trans('forms.login.password') }}" required="required" name="password" type="password" value="">
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-xs-8 pull-left">
                            <button type="submit" class="btn btn-info btn-lg">{{ trans('dashboard.login.login') }}</button>
                        </div>
                        <div class="col-xs-4">
                            <a class="btn btn-default pull-right" href="{{ route('signup.invite','gitamin') }}">
                                <span class="text-center">
                                   {{ trans('dashboard.login.signup') }} 
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
