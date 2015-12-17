<div class="row">
    <div class="col-sm-12">   
        <ul class="nav nav-tabs">
            <li class="{{ $active_item == 'project_show' ? 'active' : null }}"><a href="{{ route('projects.project_show', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-code"></i> <span>Code</span></a></li>
            <li class="{{ $active_item == 'issues' ? 'active' : null }}"><a href="{{ route('projects.issue_index', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-exclamation-circle"></i> <span>Issues</span></a></li>
            <li class="{{ $active_item == 'pulls' ? 'active' : null }}"><a href="{{ route('projects.pull_index', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-tasks"></i> <span>Pull Requests</span></a></li>
            <li class="{{ $active_item == 'wiki' ? 'active' : null }}"><a href="{{ route('projects.wiki_index', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-code-fork"> <span>Wiki</span></i></a>
            <li class="{{ $active_item == 'pulse' ? 'active' : null }}"><a href="{{ route('projects.pulse_index', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-code-fork"> <span>Pulse</span></i></a>
            <li class="{{ $active_item == 'graphs' ? 'active' : null }}"><a href="{{ route('projects.graph_index', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-area-chart"> <span>Graphs</span></i></a>
            <li class="{{ $active_item == 'project_edit' ? 'active' : null }}"><a href="{{ route('projects.project_edit', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-gear"></i> <span>Settings</span></a></li>
        </ul>
    </div>
</div>
<div class="prepend-top-default"></div>