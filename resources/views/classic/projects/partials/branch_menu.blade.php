<div class="btn-group pull-left space-right">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Branch: <strong>{{ $current_branch or 'master' }}</strong> <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li class="dropdown-header">Branches</li>
        @foreach($branches as $branch)
        <li><a href="{{ $project->url }}/tree/{{ $branch }}">@if($branch == $current_branch)<i class="octicon octicon-check"></i> @endif {{ $branch }}</a></li>
        @endforeach
    </ul>
</div>