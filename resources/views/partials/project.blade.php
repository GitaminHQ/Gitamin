<li class="list-group-item {{ $project->team_id ? "sub-project" : "project" }}">
    @if($project->slug)
    <a href="{{ $project->team->slug }}/{{ $project->slug }}" target="_blank" class="links">{{ $project->name }}</a>
    @else
    {{ $project->name }}
    @endif

    @if($project->description)
    <i class="ion-ios-help-outline help-icon" data-toggle="tooltip" data-title="{{ $project->description }}"></i>
    @endif

    <div class="pull-right">
        <small class="text-project-{{ $project->status }} {{ $project->status_color }}">{{ $project->humanStatus }}</small>
    </div>
</li>
