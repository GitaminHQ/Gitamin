<div class="moment create simple"><div class="body"><!-- update -->
<div class="simple">
  <span aria-label="Create" class="octicon octicon-repo dashboard-event-icon"></span>

  <div class="title">
    <a href="{{ $moment->author->url }}">{{ $moment->author->username }}</a> {{ $moment->actionName }} account <a href="{{ $moment->author->url }}">{{ $moment->momentable->name }}</a>
  </div>

  <div class="time">
    <time datetime="{{ $moment->created_at_iso }}" is="relative-time" title="{{ $moment->created_at }}">{{ $moment->created_at_diff }}</time>
  </div>
</div>
</div></div>