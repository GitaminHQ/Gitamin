<div class="moment issues_opened"><div class="body"><!-- issues -->
<span aria-label="Issue" class="mega-octicon octicon-issue-opened dashboard-event-icon"></span>

<div class="time">
  <time datetime="{{ $moment->created_at_iso }}" is="relative-time" title="{{ $moment->created_at_formatted }}">{{ $moment->created_at_diff }}</time>
</div>

<div class="title">
  <a href="{{ $moment->author->url }}">{{ $moment->author->username }}</a> opened issue <a href="{{ $moment->momentable->url }}" title="Icon Request : TextBox">{{ $moment->momentable->project->owner_path }}/{{ $moment->momentable->project->name }}#{{ $moment->momentable->id }}</a>
</div>

<div class="details">
  <a href="{{ $moment->author->url }}"><img alt="@{{ $moment->author->username }}" class="gravatar" height="30" src="{{ $moment->author->avatar }}" width="30"></a>
  <div class="message">
    <blockquote>
      {{ $moment->momentable->description }}
    </blockquote>
  </div>
</div>
</div></div>