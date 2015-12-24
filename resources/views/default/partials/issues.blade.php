<h4>{{ formatted_date($date) }}</h4>
<div class="timeline">
    <div class="content-wrapper">
        @forelse($issues as $issueID => $issue)
        <div class="moment {{ $issueID === 0 ? 'first' : null }}">
            <div class="row event clearfix">
                <div class="col-sm-1">
                    <div class="status-icon status-{{ $issue->status }}" data-toggle="tooltip" title="{{ $issue->human_status }}" data-placement="left">
                        <i class="{{ $issue->icon }}"></i>
                    </div>
                </div>
                <div class="col-xs-10 col-xs-offset-2 col-sm-11 col-sm-offset-0">
                    @include('partials.issue', ['issue' => $issue, 'with_link' => true])
                </div>
            </div>
        </div>
        @empty
        <div class="panel panel-message issue">
            <div class="panel-body">
                <p>{{ trans('gitamin.issues.none') }}</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
