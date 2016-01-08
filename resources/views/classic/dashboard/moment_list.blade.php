@foreach($moments as $moment)
@include('moments.partials.' . $moment->template)
@endforeach
<ul class="pager">
    @if($pager['current'] != 0)
    <li class="previous">
        <a href="?page={{ $pager['previous'] }}">&larr; Newer</a>
    </li>
    @endif
    @if($pager['current'] != $pager['last'])
    <li class="next">
        <a href="?page={{ $pager['next'] }}">Older &rarr;</a>
    </li>
    @endif
</ul>