<div class="row">
    <div class="col-sm-12">   
        <ul class="nav nav-tabs">
            <li class="{{ $active_item == 'project_show' ? 'active' : null }}"><a href="{{ route('projects.project_show', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-code"></i><span>Files</span></a></li>
            <li class="{{ $active_item == 'issues' ? 'active' : null }}"><a href="{{ route('projects.issue_index', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-exclamation-circle"></i><span>Issues</span></a></li>
            <li><a href="{{ route('projects.project_edit', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-code-fork"><span>Network</span></i></a>
            <li><a href="{{ route('projects.project_edit', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-area-chart"><span>Graphs</span></i></a>
            <li><a href="{{ route('projects.project_edit', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-code-fork"><span>Network</span></i></a>
            <li><a href="{{ route('projects.project_edit', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-clock-o"><span>Milestones</span></i></a>
            <li><a href="{{ route('projects.project_edit', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-tasks"></i><span>Pull Requests</span></a></li>
            <li><a href="{{ route('projects.project_edit', ['owner'=>$project->owner_path, 'project'=>$project->path]) }}"><i class="fa fa-gear"></i><span>Settings</span></a></li>
        </ul>
    </div>
</div>
<hr>