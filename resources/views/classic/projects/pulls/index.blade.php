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
        <tr>
            <td><a href="#">1</a></td>
            <td><a href="#">1</a></td>
            <td><a href="" class="muted-link issue-comments-no-comment">
                <span aria-hidden="true" class="octicon octicon-comment"></span>
                    0
            </a></td>
        </tr>
    </tbody>
</table>
@endsection