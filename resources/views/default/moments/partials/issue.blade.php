<div class="moment-block moment-item">
<div class="moment-item-timestamp">
<time class="time_ago js-timeago" data-container="body" data-placement="top" data-toggle="tooltip" datetime="{{ $moment->created_at_iso }}" title="{{ $moment->created_at_formatted }}">{{ $moment->created_at_diff }}</time>
</div>
<i class="{{ $moment->icon }} icon s32"></i>
<div class="moment-title">
<span class="author_name"><a href="{{ $moment->author->url }}">{{ $moment->author->username }}</a></span>
<span class="event_label opened">
{{ $moment->actionName }} issue
</span>
<strong><a href="{{ $moment->momentable->url }}">#{{ $moment->momentable_id }}</a></strong>
at
<a href="{{ $moment->momentable->project->url }}"><span class="namespace-name">{{ $moment->momentable->project->owner_path }} / </span><span class="project-name">{{ $moment->momentable->project->name }}</span></a>
</div>
<div class="moment-body">
<a href="{{ $moment->author->url }}"><img class="avatar s32" src="{{ $moment->author->avatar }}"></a>
<div class="moment-comment">
{!! $moment->momentable->description !!} 
</div>
</div>

</div>