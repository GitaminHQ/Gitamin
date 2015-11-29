@extends('layout.dashboard')

@section('content')
    <div class="header">
        <div class="sidebar-toggler visible-xs">
            <i class="icon ion-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="icon ion-android-alert"></i> {{ trans('dashboard.issues.issues') }}
        </span>
        &gt; <small>{{ trans('dashboard.issues.edit.title') }}</small>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                @include('dashboard.partials.errors')
                <form class="form-horizontal" name="IssueForm" role="form" method="POST" autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="form-group">
                            <label class="control-label" for="issue-name">{{ trans('forms.issues.name') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="issue-name" required value="{{$issue->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="issue-name">{{ trans('forms.issues.status') }}</label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{ ($issue->status == 1) ? "checked=checked" : "" }}>
                                    <i class="icon ion-flag"></i>
                                    {{ trans('gitamin.issues.status')[1] }}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="2" {{ ($issue->status == 2) ? "checked=checked" : "" }}>
                                    <i class="icon ion-alert-circled"></i>
                                    {{ trans('gitamin.issues.status')[2] }}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="3" {{ ($issue->status == 3) ? "checked=checked" : "" }}>
                                    <i class="icon ion-eye"></i>
                                    {{ trans('gitamin.issues.status')[3] }}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="4" {{ ($issue->status == 4) ? "checked=checked" : "" }}>
                                    <i class="icon ion-checkmark"></i>
                                    {{ trans('gitamin.issues.status')[4] }}
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="issue-visibility">{{ trans('forms.issues.visibility') }}</label>
                            <div class="col-sm-10">
                                <select name="visible" id="issue-visibility" class="form-control">
                                    <option value='1' {{ $issue->visible === 1 ? 'selected' : null }}>{{ trans('forms.issues.public') }}</option>
                                    <option value='0' {{ $issue->visible === 0 ? 'selected' : null }}>{{ trans('forms.issues.logged_in_only') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{ trans('forms.issues.message') }}</label>
                            <div class="col-sm-10 markdown-control">
                                <textarea name="message" class="form-control autosize" rows="5" required>{{ $issue->message }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{ trans('forms.issues.issue_time') }} <small class="text-muted">{{ trans('forms.optional') }}</small></label>
                            <div class="col-sm-10">
                                <input type="text" name="created_at" class="form-control" rel="datepicker-any" value="{{ $issue->created_at_datetimepicker }}">
                            </div>
                        </div>
                    </fieldset>

                    <input type="hidden" name="id" value={{$issue->id}}>

                    <div class="form-group">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success">{{ trans('forms.update') }}</button>
                            <a class="btn btn-default" href="{{ route('dashboard.issues.index') }}">{{ trans('forms.cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
