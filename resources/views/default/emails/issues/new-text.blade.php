{!! trans('gitamin.subscriber.email.issue.text', ['app_name' => $app_name]) !!}

{!! $status !!}
@if($has_project)
({{ $project_name }})
@endif

{!! $text_content !!}

{!! trans('gitamin.subscriber.email.unsuscribe') !!} {{ $unsubscribe_link }}
