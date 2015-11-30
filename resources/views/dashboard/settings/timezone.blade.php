@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <li class="fa fa-calendar"></li> {{ trans('dashboard.settings.timezone.timezone') }}
                </span>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form id="settings-form" name="SettingsForm" class="form-horizontal" role="form" action="/dashboard/settings" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('dashboard.partials.errors')
                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>{{ trans('forms.settings.timezone.site-timezone') }}</label>
                                        <div class="col-sm-10">
                                        <select name="app_timezone" class="form-control" required>
                                            <option value="">Select Timezone</option>
                                            @foreach($timezones as $region => $list)
                                                <optgroup label="{{ $region }}">
                                                    @foreach($list as $timezone => $name)
                                                        <option value="{{ $timezone }}" @if(Setting::get('app_timezone') == $timezone) selected @endif>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>
                                            {{ trans('forms.settings.timezone.date-format') }}
                                            <a href="http://php.net/manual/en/function.date.php" target="_blank"><i class="icon ion-help-circled"></i></a>
                                        </label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="date_format" value="{{ Setting::get('date_format') ?: 'Y-m-d' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>
                                            {{ trans('forms.settings.timezone.issue-date-format') }}
                                            <a href="http://php.net/manual/en/function.date.php" target="_blank"><i class="icon ion-help-circled"></i></a>
                                        </label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="issue_date_format" value="{{ Setting::get('issue_date_format') ?: 'Y-m-d H:i:s' }}">
                                        </div>
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
