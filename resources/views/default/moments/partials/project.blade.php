<div class="moment-block moment-item">
<div class="moment-item-timestamp">
<time class="time_ago js-timeago" data-container="body" data-placement="top" data-toggle="tooltip" datetime="2015-12-10T02:05:56Z" title="Dec 10, 2015 2:05am">{{ $moment->created_at }}</time>
</div>
<img alt="" class="avatar s46" src="{{ $moment->target->creator->gravatar }}">
<div class="moment-title">
<i class="{{ $moment->icon }}"></i> <span class="author_name"><a href="/u/root">{{ $moment->author->username }}</a></span>
<span class="event_label opened">
{{ $moment->actionName }} project
</span>
<strong><a href="{{ $moment->target->url }}">#{{ $moment->target_id }}</a></strong>
at
<a href="{{ $moment->target->url }}"><span class="namespace-name">{{ $moment->target->owner_path }} / </span><span class="project-name">{{ $moment->target->name }}</span></a>
</div>
<div class="moment-body">
<div class="moment-comment">
{!! $moment->formattedTarget !!} 
</div>
</div>

</div>