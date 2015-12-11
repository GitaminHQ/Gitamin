<div class="sidebar">
    <div class="sidebar-inner">
        <ul>
            <li {!! set_active('dashboard') !!}{!! set_active('/') !!}>
                <a href="{{ route('dashboard.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('dashboard.dashboard') }}</span>
                </a>
            </li>
            <li {!! set_active('*projects*') !!}>
                <a href="{{ route('dashboard.projects.index') }}">
                    <i class="fa fa-cubes"></i>
                    <span>{{ trans('dashboard.projects.projects') }}</span>
                    <!-- <span class="label label-info">{{ $project_count }}</span> -->
                </a>
            </li>
            <li {!! set_active('dashboard/moment*') !!}>
                <a href="{{ route('dashboard.moments.index') }}">
                    <i class="fa fa-sliders"></i>
                    <span>{{ trans('dashboard.moments.moments') }}</span>
                    <span class="label label-info">{{ $moment_count }}</span>
                </a>
            </li>
            <li {!! set_active('*groups*') !!}>
                <a href="{{ route('dashboard.groups.index') }}">
                    <i class="fa fa-group"></i>
                    <span>{{ trans('gitamin.groups.groups') }}</span>
                    <!-- <span class="label label-info">{{ $group_count }}</span> -->
                </a>
            </li>
            <li {!! set_active('dashboard/milestone*') !!}>
                <a href="{{ route('dashboard.milestones.index') }}">
                    <i class="fa fa-clock-o"></i>
                    <span>{{ trans('dashboard.milestones.milestones') }}</span>
                </a>
            </li>
            <li {!! set_active('*issues*') !!}>
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
            <hr>
            <li {!! set_active('profile*') !!}>
                <a href="{{ route('profile.index') }}">
                    <i class="fa fa-user"></i>
                    <span>
                        {{ trans('gitamin.profiles.profiles') }}
                    </span>
                </a>
            </li>
        </ul>
        
    </div>
</div>
