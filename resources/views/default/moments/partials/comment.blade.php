<div class="moment-block moment-item">
<div class="moment-item-timestamp">
<time class="time_ago js-timeago" data-container="body" data-placement="top" data-toggle="tooltip" datetime="{{ $moment->created_at_iso }}" title="{{ $moment->created_at_formatted }}">{{ $moment->created_at_diff }}</time>
</div>
<img alt="" class="avatar s46" src="https://avatars0.githubusercontent.com/u/83008?v=3&amp;s=60">
<div class="moment-title">
<i class="{{ $moment->icon }}"></i> <span class="author_name"><a href="/u/root">{{ $moment->author->username }}</a></span>
<span class="event_label opened">
{{ $moment->actionName }}
</span>
<strong> {{ $moment->target->target_type }} <a href="{{ $moment->target->target->url }}">#{{ $moment->target->target_id }}</a></strong>
at
<a href="{{ $moment->target->project->url }}"><span class="namespace-name">{{ $moment->target->project->owner_path }} / </span><span class="project-name">{{ $moment->target->project->name }}</span></a>
</div>
<div class="moment-body">
<div class="moment-comment">
{{ $moment->target->message }} 
</div>
</div>

</div>