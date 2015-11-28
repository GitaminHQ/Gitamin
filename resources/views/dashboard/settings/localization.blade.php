@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <li class="fa fa-language"></li> {{ trans('dashboard.settings.localization.localization') }}
                </span>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form id="settings-form" name="SettingsForm" class="form-vertical" role="form" action="/dashboard/settings" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('dashboard.partials.errors')
                        <fieldset>            
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>{{ trans('forms.settings.localization.site-locale') }}</label>
                                        <select name="app_locale" class="form-control" required>
                                            <option value="">{{ trans('forms.settings.localization.select-language') }}</option>
                                            @foreach($langs as $lang => $name)
                                                <option value="{{ $lang }}" @if($app_locale === $lang) selected @endif>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
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
