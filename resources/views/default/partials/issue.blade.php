<div class="panel panel-message issue">
    <div class="panel-heading">
        @if($current_user)
        <div class="pull-right btn-group">
            <a href="{{ route('dashboard.issues.edit', ['id' => $issue->id]) }}" class="btn btn-default">{{ trans('forms.edit') }}</a>
            <a href="{{ route('dashboard.issues.delete', ['id' => $issue->id]) }}" class="btn btn-danger confirm-action" data-method='DELETE'>{{ trans('forms.delete') }}</a>
        </div>
        @endif
        @if($issue->project)
        <span class="label label-default">{{ $issue->project->name }}</span>
        @endif
        <strong>{{ $issue->name }}</strong>{{ $issue->isScheduled ? trans("gitamin.issues.scheduled_at", ["timestamp" => $issue->scheduled_at_diff]) : null }}
        <br>
        <small class="date">
            @if($with_link)
            <a href="{{ route('explore.issue', ['id' => $issue->id]) }}" class="links"><abbr class="timeago" data-toggle="tooltip" data-placement="right" title="{{ $issue->timestamp_formatted }}" data-timeago="{{ $issue->timestamp_iso }}"></abbr></a>
            @else
            <abbr class="timeago" data-toggle="tooltip" data-placement="right" title="{{ $issue->timestamp_formatted }}" data-timeago="{{ $issue->timestamp_iso }}"></abbr>
            @endif
        </small>
    </div>
    <div class="panel-body">
        {!! $issue->formattedMessage !!}
    </div>
</div>
