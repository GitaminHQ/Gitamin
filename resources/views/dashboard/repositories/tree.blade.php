@extends('layout.dashboard')

@section('content')
<div class="header">
    <div class="sidebar-toggler visible-xs">
        <i class="fa fa-navicon"></i>
    </div>
    <span class="uppercase">
        <i class="fa fa-cubes"></i> {{ trans('dashboard.projects.projects') }}
    </span>
    &gt; <small>{{ trans('dashboard.projects.show.title') }}</small>
</div>

<div class="content-wrapper">

    <div class="row">
        <div class="col-sm-12">   
            <ul class="nav nav-tabs">
                <li class="active"><a href="/{{ $repo }}/tree/{{ $repository->getCurrentBranch() }}"><i class="fa fa-code"></i><span>Code</span></a></li>
                <li><a href="/{{ $repo }}/issues"><i class="fa fa-exclamation-circle"></i><span>Issues</span></a></li>
                <li><a href="/{{ $repo }}/stats/dev-issues"><i class="fa fa-tasks"></i><span>Merge Requests</span></a></li>
            </ul>
        </div>

    </div>
    <hr>
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
                <input class="form-control" type="text" value="http://gitamin.com/{{$repo}}.git" style="margin-left:15px; padding-left: 15px; width:150px;">
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
