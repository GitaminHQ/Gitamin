<ul class="nav nav-tabs">
    <li @if($active_item == 'project_show') class="active" @endif><a href="{{ $project->url }}/tree/{{ $current_branch }}"><i class="fa fa-code"></i> Files</a></li>
    <li @if($active_item == 'issues') class="active" @endif><a href="{{ $project->url }}/issues"><i class="fa fa-exclamation-circle"></i> Issues</a></li>
    <li @if($active_item == 'commits') class="active" @endif><a href="{{ $project->url }}/commits/{{ $current_branch }}"><i class="fa fa-history"></i> Commits</a></li>
    <li @if($active_item == 'stats') class="active" @endif><a href="{{ $project->url }}/stats/{{ $current_branch }}"><i class="fa fa-line-chart"></i> Stats</a></li>
<!--    <li @if($active_item == 'network') class="active" @endif><a href="{{ $project->url }}/network?branch={{ $current_branch }}">Network</a></li> -->
    <li @if($active_item == 'project_edit') class="active" @endif><a href="{{ $project->url }}/edit"><i class="fa fa-cog"></i> Settings</a></li>
</ul>