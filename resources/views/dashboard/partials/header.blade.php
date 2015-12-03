<div class="nav-header">
    <div class="nav-logo"><a href="{{ route('dashboard.index') }}"><img src="/img/dashboard-logo.png"></a></div>
		<div class="nav-greeting">
            <div class="nav-menu">
                <ul>
                    <li data-toggle="tooltip" data-placement="bottom" title="{{ trans('dashboard.logout') }}">
                        <a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out"></i></a>
                    </li>
                    <li data-toggle="tooltip" data-placement="bottom" title="{{ trans('gitamin.projects.new.title') }}">
                        <a href="{{ route('projects.new') }}"><i class="fa fa-plus"></i></a>
                    </li>
                </ul>
            </div>

			<div class="profile">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" id="profile-dropdown" data-toggle="dropdown" aria-expanded="true">
                        <span class="avatar"><img src="{{ $current_user->gravatar }}"></span> <span class="username">{{ $current_user->username }}</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="profile-dropdown">
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="{{ url('dashboard/user') }}">{{ trans('dashboard.profile') }}</a>
                        </li>
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="{{ route('auth.logout') }}">{{ trans('dashboard.logout') }}</a>
                        </li>
                    </ul>
                </div>
        	</div>
    </div>
    <div class="clearfix"></div>
</div>
