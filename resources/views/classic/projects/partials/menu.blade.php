<ul class="nav nav-tabs">
    <li @if($active_item == 'project_show') class="active" @endif><a href="{{ $project->url }}/tree/{{ $current_branch }}">Files</a></li>
    <li @if($active_item == 'commits') class="active" @endif><a href="{{ $project->url }}/commits/{{ $current_branch }}">Commits</a></li>
    <li @if($active_item == 'stats') class="active" @endif><a href="{{ $project->url }}/stats/{{ $current_branch }}">Stats</a></li>
    <li @if($active_item == 'network') class="active" @endif><a href="{{ $project->url }}/network?branch={{ $current_branch }}">Network</a></li>
</ul>