@extends('layout.emails')

@section('preheader')
{!! trans('gitamin.subscriber.email.verify.html-preheader', ['app_name' => $app_name]) !!}
@stop

@section('content')
    {!! trans('gitamin.subscriber.email.verify.html', ['app_name' => $app_name, 'link' => $link]) !!}

    @if($show_support)
    <p>{!! trans('gitamin.powered_by', ['app' => $app_name]) !!}</p>
    @endif
@stop
