@extends('layout.master')

@section('content')


@include('dashboard.partials.errors')

<div class="panel panel-meassage">
    <div class="panel-heading">
        <strong>{{ trans('gitamin.signup.title') }}</strong>
    </div>
    <div class="panel-body">
        <form action="{{ route('auth.signup') }}" method="post" class="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="username">{{ trans('gitamin.signup.username') }}</label>
                <input class="form-control" type="text" name="username" value="{{ $username }}">
            </div>
            <div class="form-group">
                <label for="email">{{ trans('gitamin.signup.email') }}</label>
                <input class="form-control" type="email" name="email" value="{{ $email }}">
            </div>
            <div class="form-group">
                <label for="password">{{ trans('gitamin.signup.password') }}</label>
                <input class="form-control" type="password" name="password">
            </div>
            <button type="submit" class="btn btn-success">{{ trans('forms.signup') }}</button>
        </form>
    </div>
</div>
@stop
