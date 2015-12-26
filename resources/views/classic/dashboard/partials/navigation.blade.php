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
                <li><a href="/">Home</a></li>
                <li><a href="refresh">Refresh</a></li>
                @if (Auth::guest())
                <li><a href="{{ route('auth.login') }}">Login</a></li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->username }} <span class="caret"></span>
                    </a>
   
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('owners.owner_show', ['owner' => $current_user->username]) }}"><i class="fa fa-user"></i> {{ trans('dashboard.profile') }}</a></li>
                        <li><a href="{{ route('auth.logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>