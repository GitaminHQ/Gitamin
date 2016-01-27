@extends('layout.master')

@section('content')

@include('admin.partials.sidebar')

<div class="col-xs-12 col-sm-9 main">
    @include('dashboard.partials.errors')
    <div class="panel panel-default">
    <div class="panel-heading">{{ trans('admin.settings.timezone.timezone') }}</div>
    <div class="panel-body">
        <form id="settings-form" name="SettingsForm" class="form-horizontal" role="form" action="/admin/settings" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('forms.settings.timezone.site-timezone') }}</label>
                            <div class="col-sm-6">
                            <select name="app_timezone" class="form-control select2" required>
                                <option value="">Select Timezone</option>
                                @foreach($timezones as $region => $list)
                                    <optgroup label="{{ $region }}">
                                        @foreach($list as $timezone => $name)
                                            <option value="{{ $timezone }}" @if(Config::get('setting.app_timezone') == $timezone) selected @endif>
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
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="col-md-4 control-label">
                                {{ trans('forms.settings.timezone.date-format') }}
                                <a href="http://php.net/manual/en/function.date.php" target="_blank"><i class="fa fa-question-circle"></i></a>
                            </label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="date_format" value="{{ Config::get('setting.date_format') ?: 'Y-m-d' }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="col-md-4 control-label">
                                {{ trans('forms.settings.timezone.issue-date-format') }}
                                <a href="http://php.net/manual/en/function.date.php" target="_blank"><i class="fa fa-question-circle"></i></a>
                            </label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="issue_date_format" value="{{ Config::get('setting.issue_date_format') ?: 'Y-m-d H:i:s' }}">
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
