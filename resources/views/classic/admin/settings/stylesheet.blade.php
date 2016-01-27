@extends('layout.master')

@section('content')

@include('admin.partials.sidebar')

<div class="col-xs-12 col-sm-9 main">
    @include('dashboard.partials.errors')
    <div class="panel panel-default">
    <div class="panel-heading">{{ trans('admin.settings.stylesheet.stylesheet') }}</div>
    <div class="panel-body">
        <form name="SettingsForm" class="form-horizontal" role="form" action="/admin/settings" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @include('dashboard.partials.errors')
            <fieldset>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('forms.settings.stylesheet.custom-css') }}</label>
                            <div class="col-sm-6">
                            <textarea class="form-control autosize" name="stylesheet" rows="10">{{ $app_stylesheet }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-actions text-center">
                        <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection
