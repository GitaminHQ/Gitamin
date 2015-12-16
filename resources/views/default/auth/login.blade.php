@extends('layout.clean')

@section('bodyClass', 'login')

@section('content')

<div class="login-panel">
        <div class="logo">
            <img src="/img/login-logo.png" />
        </div>
    <div class="form-bg">
        <div class="login-title">
            <strong>{{ trans('gitamin.signin.title') }}</strong>
        </div>
        @include('dashboard.partials.errors')
        <form method="POST" action="{{ route('auth.login', [], false) }}" accept-charset="UTF-8" autocomplete="off" name="{{ str_random(10) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(Session::has('error'))
            <p>{{ Session::get('error') }}</p>
            @endif
            <div class="form-group">
                <label class="control-label">{{ trans('gitamin.signin.email') }}</label>
                <input autocomplete="off" class="form-control login-input" placeholder="{{ trans('gitamin.signin.email') }}" required="required" name="email" type="email" autofocus>
            </div>
            <div class="form-group">
                <label class="control-label">{{ trans('gitamin.signin.password') }}</label>
                <input autocomplete="off" class="form-control login-input" placeholder="{{ trans('gitamin.signin.password') }}" required="required" name="password" type="password" value="">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info btn-lg">{{ trans('gitamin.signin.title') }}</button>
                <a class="btn btn-default pull-right" href="{{ route('signup.invite','gitamin') }}">{{ trans('gitamin.signup.signup') }}</a>
            </div>
        </form>
    </div>
</div>
@stop
