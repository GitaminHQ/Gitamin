<div class="sub-sidebar">
    <div class="sidebar-toggler visible-xs">
        <i class="fa fa-navicon"></i>
    </div>
    <h3>{{ $sub_title }}</h3>
    <ul class="menu">
        @foreach($sub_menu as $key => $item)
        @if($key == '<hr>')
        <hr>
        @else
        <li><a href="{{ $item['url'] }}" class="{{ $item['active'] ? 'active' : null }}"><i class="{{ $item['icon'] }}"></i> {{ $item['title'] }}</a></li>
        @endif
        @endforeach
    </ul>
</div>
