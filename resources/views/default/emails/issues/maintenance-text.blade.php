{!! trans('gitamin.subscriber.email.maintenance.text', ['app_name' => $app_name]) !!}

{{ $scheduled_at }}

{!! $status !!}

{!! $text_content !!}

@if($show_support)
{!! trans('gitamin.powered_by', ['app' => $app_name]) !!}
@endif

{!! trans('gitamin.subscriber.email.unsubscribe') !!} {{ $unsubscribe_link }}
