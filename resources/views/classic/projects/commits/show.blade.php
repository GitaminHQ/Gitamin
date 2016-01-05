@extends('layout.project')

@section('content')
    @include('dashboard.partials.breadcrumb')

<div class="commit-view">
        <div class="commit-header">
            <span class="pull-right">
                <a class="btn btn-default btn-sm" href="{{ $project->url }}/tree/{{ $commit->getHash() }}" title="Browse code at this point in history"><span class="fa fa-list-alt"></span> Browse code</a></span>
            <h4>{{ $commit->getMessage() }}</h4>
        </div>
        <div class="commit-body">
            <p>{{ $commit->getBody() }}</p>
                        <img src="/img/no_user_avatar.png" style="width:40px; height:32px;" class="pull-left space-right">
            <span>
                <a href="mailto:{{ $commit->getAuthor()->getEmail() }}">{{ $commit->getAuthor()->getName() }}</a> authored on 111
                                <br>Showing {{ $commit->getChangedFiles() }} changed files
            </span>
        </div>
    </div>
@endsection