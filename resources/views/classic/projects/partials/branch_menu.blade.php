<div class="btn-group pull-left space-right">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">browsing: <strong>{{ $current_branch }}</strong> <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li class="dropdown-header">Branches</li>
        @foreach($branches as $branch)
        <li><a href="{{ $project->url }}/tree/{{ $branch }}">{{ $branch }}</a></li>
        @endforeach
    </ul>
</div>