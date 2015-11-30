@extends('layout.dashboard')

@section('content')
    <div class="header">
        <div class="sidebar-toggler visible-xs">
            <i class="icon ion-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="icons ion-ios-keypad"></i> {{ trans_choice('dashboard.teams.teams', 2) }}
        </span>
        &gt; <small>{{ trans('dashboard.teams.edit.title') }}</small>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                @include('dashboard.partials.errors')
                <form name="EditProjectTeamForm" class="form-horizontal" role="form" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="form-group">
                            <label class="control-label" for="team-name">{{ trans('forms.projects.teams.name') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="team-name" value="{{ $team->name }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="team-slug">{{ trans('forms.projects.teams.slug') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="slug" id="team-slug" value="{{ $team->slug }}" required>
                            </div>
                        </div>
                    </fieldset>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                        <a class="btn btn-default" href="{{ route('dashboard.teams.index') }}">{{ trans('forms.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
