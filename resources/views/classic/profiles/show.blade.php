@extends('layout.dashboard')

@section('body')
@include('dashboard.partials.navigation')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('gitamin.profiles.profiles') }}</div>
                <div class="panel-body">
                {{ $current_user->username }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection