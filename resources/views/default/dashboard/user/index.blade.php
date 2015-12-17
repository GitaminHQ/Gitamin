@extends('layout.dashboard')

@section('content')
    <div class="header">
        <div class="sidebar-toggler visible-xs">
            <i class="fa fa-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="fa fa-user"></i> {{ trans('dashboard.profile') }}
        </span>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                @include('dashboard.partials.errors')
                <form name="UserForm" class="form-horizontal" role="form" action="/dashboard/user" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-1">
                                <a href="https://gravatar.com"><img src="{{ $current_user->gravatar }}" class="img-responsive img-thumbnail" title="{{ trans('forms.user.gravatar') }}" data-toggle="tooltip"></a>
                            </div>
                            <div class="col-sm-11">
                                <div class="form-group">
                                    <label>{{ trans('forms.user.username') }}</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" value="{{ $current_user->username }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('forms.user.email') }}</label>
                                    <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" value="{{ $current_user->email }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('forms.user.password') }}</label>
                                    <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" value="">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>{{ trans('forms.user.api-token') }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="api_key" disabled value="{{ $current_user->api_key }}">
                                        <a href="/dashboard/user/{{ $current_user->id }}/api/regen" class="input-group-addon btn btn-danger">{{ trans('gitamin.api.regenerate') }}</a>
                                    </div>
                                    <span class="help-block">{{ trans('forms.user.api-token-help') }}</span>
                                </div>
                                <hr>
                                <div class="form-actions">
                                <button type="submit" class="btn btn-success">{{ trans('forms.update') }}</button>
                                <a class="btn btn-default" href="{{ back_url('home') }}">{{ trans('forms.cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
