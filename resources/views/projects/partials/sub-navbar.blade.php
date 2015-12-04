<div class="row">
    <div class="col-sm-12">   
        <ul class="nav nav-tabs">
            <li class="{{ $active_item == 'project_show' ? 'active' : null }}"><a href="{{ route('projects.project_show', ['namespace'=>$project->namespace, 'project'=>$project->path]) }}"><i class="fa fa-code"></i><span>Files</span></a></li>
            <li class="{{ $active_item == 'issues' ? 'active' : null }}"><a href="{{ route('projects.issue_index', ['namespace'=>$project->namespace, 'project'=>$project->path]) }}"><i class="fa fa-exclamation-circle"></i><span>Issues</span></a></li>
            <li><a href="{{ route('projects.project_edit', ['namespace'=>$project->namespace, 'project'=>$project->path]) }}"><i class="fa fa-code-fork"><span>Network</span></i></a>
            <li><a href="{{ route('projects.project_edit', ['namespace'=>$project->namespace, 'project'=>$project->path]) }}"><i class="fa fa-area-chart"><span>Graphs</span></i></a>
            <li><a href="{{ route('projects.project_edit', ['namespace'=>$project->namespace, 'project'=>$project->path]) }}"><i class="fa fa-code-fork"><span>Network</span></i></a>
            <li><a href="{{ route('projects.project_edit', ['namespace'=>$project->namespace, 'project'=>$project->path]) }}"><i class="fa fa-clock-o"><span>Milestones</span></i></a>
            <li><a href="{{ route('projects.project_edit', ['namespace'=>$project->namespace, 'project'=>$project->path]) }}"><i class="fa fa-tasks"></i><span>Merge Requests</span></a></li>
            <li><a href="{{ route('projects.project_edit', ['namespace'=>$project->namespace, 'project'=>$project->path]) }}"><i class="fa fa-gear"></i><span>Settings</span></a></li>
        </ul>
    </div>
</div>
<hr>