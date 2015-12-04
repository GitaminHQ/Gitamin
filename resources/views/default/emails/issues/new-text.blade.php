{!! trans('gitamin.subscriber.email.issue.text', ['app_name' => $app_name]) !!}

{!! $status !!}
@if($has_project)
({{ $project_name }})
@endif

{!! $text_content !!}

@if($show_support)
{!! trans('gitamin.powered_by', ['app' => $app_name]) !!}
@endif

{!! trans('gitamin.subscriber.email.unsuscribe') !!} {{ $unsubscribe_link }}
