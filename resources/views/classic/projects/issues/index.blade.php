@extends('layout.project')

@section('content')
    @include('dashboard.partials.breadcrumb')
    @include('dashboard.partials.errors')
<table class="table tree table-hover">
    <thead>
        <tr>
            <th width="80%">Title</th>
            <th width="10%">Author</th>
            <th width="10%">Comments</th>
        </tr>
    </thead>
    <tbody>
        @foreach($issues as $issue)
        <tr>
            <td><a href="{{ $issue->url }}">{{ $issue->title }}</a></td>
            <td><a href="{{ $issue->author->url }}">{{ $issue->author->username }}</a></td>
            <td><a href="" class="muted-link issue-comments-no-comment">
                <span aria-hidden="true" class="octicon octicon-comment"></span>
                    0
            </a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection