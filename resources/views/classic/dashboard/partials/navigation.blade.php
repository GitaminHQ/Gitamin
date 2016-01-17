<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Gitamin</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                <li><a href="{{ url('/auth/login') }}">Login</a></li>
                @else
                <li><a href="{{ url('/') }}"><i class="octicon octicon-bell"></i> </a></li>
                @if (Auth::user()->is_admin)
                <li><a href="{{ url('/admin') }}"><i class="octicon octicon-gear"></i> Admin</a></li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-plus"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                    <li><a href="/projects/new"><i class="fa fa-cubes"></i> New Project</a></li>
                    <li><a href="/groups/new"><i class="fa fa-group"></i> New Group</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <img src="/img/no_user_avatar.png" style="width: 20px; height: 20px;"> {{ Auth::user()->username }} <span class="caret"></span>
                    </a>
   
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('owners.owner_show', ['owner' => $current_user->username]) }}"><i class="fa fa-user"></i> {{ trans('gitamin.profiles.profiles') }}</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a href="{{ url('/profile') }}"><i class="fa fa-gear"></i> {{ trans('gitamin.profiles.account') }}</a></li>
                        <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>