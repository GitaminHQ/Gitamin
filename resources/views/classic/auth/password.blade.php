@extends('layout.dashboard')

@section('body')

<div class="login-panel">
        <div class="logo">
            <img src="/img/login-logo.png" />
        </div>
    <div class="form-bg">
        <div class="login-title">
            <strong>password reset</strong>
        </div>
        @include('dashboard.partials.errors')
        <form method="POST" action="/auth/password/email" accept-charset="UTF-8" autocomplete="off">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(Session::has('error'))
            <p class="alert alert-danger">{{ Session::get('error') }}</p>
            @endif
            <div class="form-group">
                <label class="control-label">{{ trans('gitamin.signin.password') }}</label>
                <input autocomplete="off" class="form-control login-input" placeholder="{{ trans('gitamin.signin.email') }}" required="required" name="email" type="email" value="">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info btn-lg">{{ trans('forms.submit') }}</button>
                <a class="btn btn-default pull-right" href="{{ route('auth.login') }}">{{ trans('gitamin.signin.signin') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
