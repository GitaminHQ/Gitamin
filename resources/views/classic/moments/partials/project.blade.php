<div class="moment update simple"><div class="body"><!-- update -->
<div class="simple">
  <span aria-label="Update" class="octicon octicon-repo dashboard-event-icon"></span>

  <div class="title">
    <a href="{{ $moment->author->url }}">{{ $moment->author->username }}</a> {{ $moment->actionName }} project at <a href="{{ $moment->momentable->url }}" data-ga-click="News feed, event click, Event click type:DeleteEvent target:repo">{{ $moment->momentable->name }}</a>
  </div>

  <div class="time">
    <time datetime="{{ $moment->created_at_iso }}" is="relative-time" title="{{ $moment->created_at }}">{{ $moment->created_at_diff }}</time>
  </div>
</div>
</div></div>