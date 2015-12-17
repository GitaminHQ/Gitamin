@extends('layout.clean')

@section('bodyClass', 'login')

@section('content')



<div class="login-panel">
    <div class="logo">
            <img src="/img/login-logo.png" />
    </div> 
    <div class="form-bg">
         <div class="login-title">
            <strong>{{ trans('gitamin.signup.title') }}</strong>
        </div>
        @include('dashboard.partials.errors')
        <form action="{{ route('signup.signup') }}" method="post" class="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="username">{{ trans('gitamin.signup.username') }}</label>
                <input class="form-control" type="text" name="username" value="{{ Input::old('username',$username) }}">
            </div>
            <div class="form-group">
                <label for="email">{{ trans('gitamin.signup.email') }}</label>
                <input class="form-control" type="email" name="email" value="{{ Input::old('email',$email) }}">
            </div>
            <div class="form-group">
                <label for="password">{{ trans('gitamin.signup.password') }}</label>
                <input class="form-control" type="password" name="password">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">{{ trans('gitamin.signup.title') }}</button>
                <a class="btn btn-default pull-right" href="{{ route('auth.login') }}">{{ trans('gitamin.signin.signin') }}</a>
            </div>
        </form>
    </div>
</div>
@stop
