@extends('layout.project')

@section('content')
    @include('dashboard.partials.breadcrumb')
    <table class="table tree table-hover">
        <thead>
            <tr>
                <th width="80%">Name</th>
                <th width="10%">Mode</th>
                <th width="10%">Size</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
            <tr>
                @if($file['type'] == 'folder')
                <td><span class="fa fa-folder-open"></span> <a href="/Baidu/api/tree/{{$current_branch}}/{{ $path }}{{ $file['name'] }}">{{ $file['name'] }}</a></td>
                @else
                <td><span class="fa fa-file"></span> <a href="/Baidu/api/blob/{{$current_branch}}/{{ $path }}{{ $file['name'] }}">{{ $file['name'] }}</a></td>
                @endif
                <td>040000</td>
                <td></td>
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

        <hr />
@stop