@extends('layout.dashboard')

@section('content')
<div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
    <div class="content-wrapper">
        <div class="header sub-header">
            <i class="fa fa-edit"></i> {{ trans('dashboard.projects.yours') }}
            <div class="clearfix"></div>
        </div>
        @include('dashboard.partials.errors')
        <div class="row">
            <div class="col-sm-12 projects-list-holder" id="project-list">
                <div class="projects-search-form">
                    <div class="input-group">
                    <input class="projects-list-filter form-control" id="filter_projects" name="filter_projects" placeholder="Filter by name" spellcheck="false" type="search">
                    <span class="input-group-btn">
                    <a class="btn btn-green" href="{{ route('projects.new') }}"><i class="fa fa-plus"></i>
                    {{ trans('gitamin.projects.new.title') }}
                    </a></span>
                    </div>
                </div>
                <ul class="projects-list">
                    @forelse($projects as $project)
                    <li class="project-row">
                        <a class="project" href="{{ $project->url }}">
                        <div class="dash-project-avatar">
                        <div class="avatar project-avatar s46 identicon" style="background-color: #E0F2F1; color: #555">{{ $project->id }}</div>
                        </div>
                        <span class="project-full-name">
                        <span class="namespace-name">
                        {{ $project->owner->name }}
                        /
                        </span>
                        <span class="project-name filter-title">
                        {{ $project->name }}
                        </span>
                        </span>
                        </a><div class="project-controls">
                        <span>
                        <i class="fa fa-star"></i>
                        0
                        </span>
                        </div>
                        <div class="project-description">
                        <p>{{ $project->description }}</p>
                        </div>
                    </li>
                    @empty
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@stop
