@extends('layout.dashboard')

@section('content')
    <div class="header">
        <div class="sidebar-toggler visible-xs">
            <i class="icon ion-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="icon ion-person"></i> {{ trans('dashboard.group.group') }}
        </span>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                @include('dashboard.partials.errors')
                <form name="UserForm" class="form-vertical" role="form" action="/dashboard/group/add" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="form-group">
                            <label>{{ trans('forms.user.username') }}</label>
                            <input type="text" class="form-control" name="username" value="{{ Input::old('username') }}" required>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('forms.user.email') }}</label>
                            <input type="email" class="form-control" name="email" value="{{ Input::old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('forms.user.password') }}</label>
                            <input type="password" class="form-control" name="password" value="">
                        </div>
                        @if($current_user->isAdmin)
                        <div class="form-group">
                            <label>{{ trans('forms.user.user_level') }}</label>
                            <select name="level" class="form-control">
                                <option value="2" selected>{{ trans('forms.user.levels.user') }}</option>
                                <option value="1">{{ trans('forms.user.levels.admin') }}</option>
                            </select>
                        </div>
                        @endif
                    </fieldset>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ trans('forms.add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
