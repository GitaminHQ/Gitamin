@extends('layout.dashboard')

@section('content')
    <div class="header">
        <div class="sidebar-toggler visible-xs">
            <i class="icon ion-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="icon ion-android-alert"></i> {{ trans('dashboard.issues.issues') }}
        </span>
        &gt; <small>{{ trans('dashboard.issues.add.title') }}</small>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                @include('dashboard.partials.errors')
                <form class="form-vertical" name="IssueForm" role="form" method="POST" autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="form-group">
                            <label for="issue-name">{{ trans('forms.issues.name') }}</label>
                            <input type="text" class="form-control" name="name" id="issue-name" required value="{{ Input::old('issue.name') }}">
                        </div>
                        <div class="form-group">
                            <label for="issue-name">{{ trans('forms.issues.status') }}</label><br>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="1">
                                <i class="icon ion-flag"></i>
                                {{ trans('gitamin.issues.status')[1] }}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="2">
                                <i class="icon ion-alert-circled"></i>
                                {{ trans('gitamin.issues.status')[2] }}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="3">
                                <i class="icon ion-eye"></i>
                                {{ trans('gitamin.issues.status')[3] }}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="4">
                                <i class="icon ion-checkmark"></i>
                                {{ trans('gitamin.issues.status')[4] }}
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="issue-name">{{ trans('forms.issues.visibility') }}</label>
                            <select name='visible' class="form-control">
                                <option value='1' selected>{{ trans('forms.issues.public') }}</option>
                                <option value='0'>{{ trans('forms.issues.logged_in_only') }}</option>
                            </select>
                        </div>
                        @if(!$projects_in_teams->isEmpty() || !$projects_out_teams->isEmpty())
                        <div class="form-group">
                            <label>{{ trans('forms.issues.project') }}</label>
                            <select name='project_id' class='form-control'>
                                <option value='0' selected></option>
                                @foreach($projects_in_teams as $team)
                                <optgroup label="{{ $team->name }}">
                                    @foreach($team->projects as $project)
                                    <option value='{{ $project->id }}'>{{ $project->name }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                                @foreach($projects_out_teams as $project)
                                <option value='{{ $project->id }}'>{{ $project->name }}</option>
                                @endforeach
                            </select>
                            <span class='help-block'>{{ trans('forms.optional') }}</span>
                        </div>
                        @endif
                        <div class="form-group hidden" id="project-status">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="radio-items">
                                        @foreach(trans('gitamin.projects.status') as $statusID => $status)
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="project_status" value="{{ $statusID }}">
                                                {{ $status }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('forms.issues.message') }}</label>
                            <div class='markdown-control'>
                                <textarea name="message" class="form-control autosize" rows="5" required>{{ Input::old('issue.message') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('forms.issues.issue_time') }}</label> <small class="text-muted">{{ trans('forms.optional') }}</small>
                            <input type="text" name="created_at" class="form-control" rel="datepicker-any">
                        </div>
                        @if(subscribers_enabled())
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="notify" value="1" checked="{{ Input::old('issue.message', 'checked') }}">
                                {{ trans('forms.issues.notify_subscribers') }}
                            </label>
                        </div>
                        @endif
                    </fieldset>

                    <div class="form-group">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success">{{ trans('forms.add') }}</button>
                            <a class="btn btn-default" href="{{ route('dashboard.issues.index') }}">{{ trans('forms.cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
