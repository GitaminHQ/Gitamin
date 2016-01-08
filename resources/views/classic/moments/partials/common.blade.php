<div class="moment delete simple"><div class="body"><!-- delete -->
<div class="simple">
  <span aria-label="Delete" class="octicon octicon-git-branch dashboard-event-icon"></span>

  <div class="title">
    <a href="{{ $moment->author->url }}" data-ga-click="News feed, event click, Event click type:DeleteEvent target:actor">{{ $moment->author->username }}</a> common event at <a href="#" data-ga-click="News feed, event click, Event click type:DeleteEvent target:repo">common event</a>
  </div>

  <div class="time">
    <time datetime="2016-01-08T02:32:25Z" is="relative-time" title="2016年1月8日 GMT+8上午10:32">{{ $moment->created_at_diff }}</time>
  </div>
</div>
</div></div>