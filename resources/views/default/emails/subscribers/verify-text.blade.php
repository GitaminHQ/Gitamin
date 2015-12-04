{{ trans('gitamin.subscriber.email.verify.text', ['app_name' => $app_name, 'link' => $link]) }}

@if($show_support)
{!! trans('gitamin.powered_by', ['app' => $app_name]) !!}
@endif
