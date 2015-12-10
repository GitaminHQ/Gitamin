@extends('layout.emails')

@section('preheader')
{!! trans('gitamin.subscriber.email.issue.html-preheader', ['app_name' => $app_name]) !!}
@stop

@section('content')
    {!! trans('gitamin.subscriber.email.issue.html-preheader', ['app_name' => $app_name]) !!}

    <p>
        {!! $status !!}
        @if($has_project)
        ({{ $project_name }})
        @endif
    </p>

    <p>
        {!! $html_content !!}
    </p>
    <p>
        <small><a href="{{ $unsubscribe_link }}">{!! trans('gitamin.subscriber.email.unsubscribe') !!}</a></small>
    </p>
@stop
