@extends('layout.dashboard')

@section('body')
@include('dashboard.partials.navigation')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('gitamin.signin.title') }}</div>
                <div class="panel-body">
                    @include('dashboard.partials.errors')
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                        {!! csrf_field() !!}
                        @if(Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                        @endif
                        <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('gitamin.signin.username') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="{{ trans('gitamin.signin.login') }}" required="required" name="login" value="{{ Input::old('login') }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('gitamin.signin.password') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" placeholder="{{ trans('gitamin.signin.password') }}" required="required" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ trans('gitamin.signin.remember-me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> {{ trans('forms.signin') }}
                                </button>
                                <a class="btn btn-link" href="{{ url('/password/email') }}">{{ trans('gitamin.signin.forgot-password') }}</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! trans('gitamin.signup.signup', ['link' => url('/auth/register')]) !!}
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection