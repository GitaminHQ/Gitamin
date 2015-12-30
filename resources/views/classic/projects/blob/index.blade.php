@extends('layout.project')

@section('content')
    @include('dashboard.partials.breadcrumb')

    <div class="source-view">
        <div class="source-header">
            <div class="meta"></div>

            <div class="btn-group pull-right">
                <a href="{{ $project->url }}/raw/{{ $current_branch }}/{{ $file }}" class="btn btn-default btn-sm"><span class="fa fa-file-text-o"></span> Raw</a>
                <a href="{{ $project->url }}/blame/{{ $current_branch }}/{{ $file }}" class="btn btn-default btn-sm"><span class="fa fa-bullhorn"></span> Blame</a>
                <a href="{{ $project->url }}/commits/{{ $current_branch }}/{{ $file }}" class="btn btn-default btn-sm"><span class="fa fa-list"></span> History</a>
            </div>
        </div>
        <pre id="sourcecode" language="{{ $file_type }}">{{ $blob }}</pre>
    </div>
@endsection