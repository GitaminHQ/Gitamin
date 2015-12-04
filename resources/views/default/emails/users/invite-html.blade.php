@extends('layout.emails')

@section('preheader')
{!! trans('gitamin.users.email.invite.html-preheader', ['app_name' => $app_name]) !!}
@stop

@section('content')
    {!! trans('gitamin.users.email.invite.html', ['app_name' => $app_name, 'link' => $link]) !!}

    @if($show_support)
    <p>{!! trans('gitamin.powered_by', ['app' => $app_name]) !!}</p>
    @endif
@stop
