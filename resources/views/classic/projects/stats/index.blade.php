@extends('layout.project')

@section('content')
    @include('dashboard.partials.breadcrumb')
<table class="table stats">
        <thead>
            <tr>
                <th width="30%"><span class="fa fa-file-text"></span> File extensions ({{ sizeof($stats['extensions']) }})</th>
                <th width="40%"><span class="fa fa-users"></span> Authors (1)</th>
                <th width="30%"><span class="fa fa-star"></span> Other</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <ul>
                    @foreach($stats['extensions'] as $ext => $count)
                        <li><strong>{{ $ext }}</strong>: {{ $count }} files</li>
                    @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                    @foreach($authors as $author)
                        <li><strong><a href="mailto:{{ $author['email'] }}">{{ $author['name'] }}</a></strong>: {{ $author['commits'] }} commits</li>
                    @endforeach
                    </ul>
                </td>
                <td>
                    <p>
                        <strong>Total files:</strong> {{ $stats['files'] }}
                    </p>

                    <p>
                        <strong>Total bytes:</strong> {{ $stats['size'] }} bytes ({{ formated_filesize($stats['size']) }})
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
@stop