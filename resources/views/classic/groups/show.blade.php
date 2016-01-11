@extends('layout.dashboard')

@section('body')
@include('dashboard.partials.navigation')

<div class="container">
<div class="row">
    <div class="col-xs-12 col-sm-9 main">
    @include('dashboard.partials.errors')
        <div class="panel panel-default">
        <div class="panel-heading">{{ trans('gitamin.groups.groups') }}</div>
        <div class="panel-body">
            @foreach($group->projects as $project)
            <a href="{{ $project->url }}" class="list-group-item">{{ $project->name }}</a>
            <p>{{ $project->description }}</p>
            @endforeach
        </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 sidebar">
        <div class="list-group">
            <div class="list-group-item active">Peoples</div>
            <a href="#" class="list-group-item">Admin</a>
        </div>

        <div class="list-group">
            <div class="list-group-item active">Settings</div>
            <a href="{{ $group->url }}/edit" class="list-group-item">Settings</a>
        </div>
    </div>
</div>
</div>
@endsection
