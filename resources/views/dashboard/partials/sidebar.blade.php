<div class="sidebar">
    <div class="sidebar-inner">
        <ul>
            <li {!! set_active('dashboard') !!}>
                <a href="{{ route('dashboard.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('dashboard.dashboard') }}</span>
                </a>
            </li>
            <li {!! set_active('dashboard/projects*') !!}>
                <a href="{{ route('dashboard.projects.index') }}">
                    <i class="fa fa-cubes"></i>
                    <span>{{ trans('dashboard.projects.projects') }}</span>
                    <span class="label label-info">{{ $project_count }}</span>
                </a>
            </li>
            <li {!! set_active('dashboard/activit*') !!}>
                <a href="{{ route('dashboard.activities.index') }}">
                    <i class="fa fa-sliders"></i>
                    <span>{{ trans('dashboard.activities.activities') }}</span>
                </a>
            </li>
            <li {!! set_active('dashboard/teams*') !!}>
                <a href="{{ route('dashboard.teams.index') }}">
                    <i class="fa fa-group"></i>
                    <span>{{ trans('dashboard.teams.teams') }}</span>
                    <span class="label label-info">{{ $project_team_count }}</span>
                </a>
            </li>
            <li {!! set_active('dashboard/milestone*') !!}>
                <a href="{{ route('dashboard.milestones.index') }}">
                    <i class="fa fa-clock-o"></i>
                    <span>{{ trans('dashboard.milestones.milestones') }}</span>
                </a>
            </li>
            <li {!! set_active('dashboard/issues*') !!}>
                <a href="{{ route('dashboard.issues.index') }}">
                    <i class="fa fa-exclamation-circle"></i>
                    <span>{{ trans('dashboard.issues.issues') }}</span>
                    <span class="label label-info">{{ $issue_count }}</span>
                </a>
            </li>
            <li {!! set_active('dashboard/merge_request*') !!}>
                <a href="{{ route('dashboard.merge_requests.index') }}">
                    <i class="fa fa-tasks"></i>
                    <span>{{ trans('dashboard.merge_requests.merge_requests') }}</span>
                </a>
            </li>
            <li {!! set_active('dashboard/snippet*') !!}>
                <a href="{{ route('dashboard.snippets.index') }}">
                    <i class="fa fa-clipboard"></i>
                    <span>{{ trans('dashboard.snippets.snippets') }}</span>
                </a>
            </li>
            <li {!! set_active('dashboard/settings*') !!}>
                <a href="{{ route('dashboard.settings.general') }}">
                    <i class="fa fa-cogs"></i>
                    <span>
                        {{ trans('dashboard.settings.settings') }}
                    </span>
                </a>
            </li>
        </ul>
        
    </div>
</div>
