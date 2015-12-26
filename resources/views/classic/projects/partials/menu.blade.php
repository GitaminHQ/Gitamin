<ul class="nav nav-tabs">
    <li @if($active_item == 'project_show') class="active" @endif><a href="/Baidu/api/tree/master/">Files</a></li>
    <li @if($active_item == 'commits') class="active" @endif><a href="/Baidu/api/commits/master">Commits</a></li>
    <li @if($active_item == 'stats') class="active" @endif><a href="/Baidu/api/stats/master">Stats</a></li>
    <li @if($active_item == 'network') class="active" @endif><a href="/Baidu/api/network?branch=master">Network</a></li>
</ul>