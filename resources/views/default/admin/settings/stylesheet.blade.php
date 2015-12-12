@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-magic"></i> {{ trans('admin.settings.stylesheet.stylesheet') }}
                </span>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form name="SettingsForm" class="form-horizontal" role="form" action="/admin/settings" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('dashboard.partials.errors')
                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label  class="control-label">{{ trans('forms.settings.stylesheet.custom-css') }}</label>
                                        <div class="col-sm-10">
                                        <textarea class="form-control autosize" name="stylesheet" rows="10">{{ $app_stylesheet }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
