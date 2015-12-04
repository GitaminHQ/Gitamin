<ul class="list-group projects">
    @if($project_teams->count() > 0)
    @foreach($project_teams as $projectTeam)
    @if($projectTeam->projects()->count() > 0)
    <li class="list-group-item group-name">
        <i class="fa fa-minus-square-o group-toggle"></i>
        <strong>{{ $projectTeam->name }}</strong>
    </li>

    <div class="group-items">
    @foreach($projectTeam->projects()->get() as $project)
    @include('partials.project', compact($project))
    @endforeach
    </div>
    @endif
    @endforeach
    @if($unteamed_projects->count() > 0)
    <li class="list-group-item break"></li>
    @endif
    @endif

    @if($unteamed_projects->count() > 0)
    @foreach($unteamed_projects as $project)
    @include('partials.project', compact($project))
    @endforeach
    @endif
</ul>
