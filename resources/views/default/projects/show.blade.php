@extends('layout.dashboard')

@section('content')

<div class="content-wrapper">
    <div class="header sub-header">
        <div class="sidebar-toggler visible-xs">
            <i class="fa fa-navicon"></i>
        </div>
        <i class="fa fa-cubes"></i> {{ trans('dashboard.projects.projects') }}
        &gt; <small>{{ $project->name }}</small>
    </div>

    @include('projects.partials.sub-navbar')
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-left space-right">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Branch: <strong>{{$current_branch}}</strong> <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">Branches</li>
                    @forelse($branches as $branch)
                    <li><a href="/{{$repo}}/tree/{{ $branch }}/">{{$branch}}</a></li>
                    @empty
                    @endforelse
                </ul>
            </div>
            
            <div class="btn-group pull-right">
                <a href="/{{ $repo }}/blame/master/.bowerrc" class="btn btn-default btn-sm"><span class="fa fa-history"></span> 200 Commits</a>
                <a href="/{{ $repo }}/raw/master/.bowerrc" class="btn btn-default btn-sm"><span class="fa fa-branch"></span> {{ sizeof($branches) }} Branches</a>
                <a href="/{{ $repo }}/commits/master/.bowerrc" class="btn btn-default btn-sm"><span class="fa fa-tag"></span> 3 Releases</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
        <table class="table tree">
        <thead>
            <tr>
                <th width="80%">Name</th>
                <th width="10%">Mode</th>
                <th width="10%">Size</th>
            </tr>
        </thead>
        <tbody>
            @if($parent_path)
            <tr>
            <td><a href="/{{ $repo }}/tree/{{ $current_branch }}/{{ $parent_path}}">..</a></td>
            <td></td>
            <td></td>
            </tr>
            @endif
            @forelse($files as $file)
            <tr>
                <td>
                @if($file['type'] == 'folder')
                <span class="fa fa-folder-open"></span> <a href="/{{ $repo }}/tree/{{ $branch }}/{{ $path }}{{ $file['name'] }}">{{ $file['name'] }}</a>
                @else
                <span class="fa fa-file-text-o"></span> <a href="/{{ $repo }}/blob/{{ $branch }}/{{ $path }}{{ $file['name'] }}">{{ $file['name'] }}</a>
                @endif
                </td>
                <td>{{ $file['mode'] }}</td>
                <td>{{ $file['size'] }}</td>
            </tr>
            @empty
            @endforelse
            </tbody>
    </table>
        </div>
    </div>
</div>
@stop
