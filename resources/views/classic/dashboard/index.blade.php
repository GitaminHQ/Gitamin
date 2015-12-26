@extends('layout.dashboard')

@section('body')
    @include('dashboard.partials.navigation')
    <div class="container">

    @foreach($projects as $project)
    <div class="repository">
        <div class="repository-header">
            <span class="fa fa-folder-open"></span>  <a href="{{ $project->url }}">{{ $project->name }}</a>
            <a href=""><span class="fa fa-rss rss-icon pull-right"></span></a>
        </div>
        <div class="repository-body">
            @if($project->description)
            <p>{{ $project->description }}</p>
            @else
            <p>There is no repository description file. Please, create one to remove this message.</p>
            @endif
        </div>
    </div>
    @endforeach

    <hr />
    @include('dashboard.partials.footer')
@stop