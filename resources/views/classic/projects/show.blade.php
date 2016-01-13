@extends('layout.project')

@section('content')
    @include('dashboard.partials.breadcrumb')
    <table class="table tree table-hover">
        <thead>
            <tr>
                <th width="25%">Name</th>
                <th width="50%">Message</th>
                <th width="25%">Last commit</th>
            </tr>
        </thead>
        <tbody>
            <tr><td colspan="2"><a href="#">{{ $revision->getCommit()->getAuthorName() }}</a> {{ $revision->getCommit()->getMessage() }} </td><td style="text-align: right;">{{ $revision->getCommit()->getCommitterDate()->format('Y-m-d H:i:s') }}</td></tr>
            @if($parent_path !== null)
            <tr><td colspan="3"><i class="fa fa-reply"></i> <a href="../">..</a></td></tr>
            @endif
            @foreach($files as $file)
            <tr>
                @if($file['type'] == 'folder')
                <td><span class="fa fa-folder-open"></span> <a href="{{ $project->url }}/tree/{{$current_branch}}/{{ $path }}{{ $file['name'] }}">{{ $file['name'] }}</a></td>
                @else
                <td><span class="fa fa-file"></span> <a href="{{ $project->url }}/blob/{{$current_branch}}/{{ $path }}{{ $file['name'] }}">{{ $file['name'] }}</a></td>
                @endif
                <td><a href="{{ $project->url }}/commit/{{ $file['hash'] }}">{{ $file['message'] }}</a></td>
                <td style="text-align: right;"></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="readme-view">
            <div class="md-header">
                <span class="meta">readme</span>
            </div>
            <div id="md-content">README</div>
        </div>
@endsection