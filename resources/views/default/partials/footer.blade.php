<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <p>{!! trans('gitamin.powered_by', ['app' => $app_name]) !!}</p>
            </div>
            <div class="col-sm-7">
                <ul class="list-inline">
                    @if($current_user || Setting::get('dashboard_login_link'))
                    <li>
                        <a class="btn btn-link" href="/dashboard">{{ trans('dashboard.dashboard') }}</a>
                    </li>
                    @endif
                    @if($current_user)
                    <li>
                        <a href="/auth/logout">{{ trans('dashboard.logout') }}</a>
                    </li>
                    @else
                     <li>
                        <a href="/auth/login">{{ trans('gitamin.signin.signin') }}</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ route('feed.rss') }}">{{ trans('gitamin.rss-feed') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('feed.atom') }}">{{ trans('gitamin.atom-feed') }}</a>
                    </li>
                    @if(subscribers_enabled())
                    <li>
                        <a class="btn btn-success btn-outline" href="{{ route('subscribe.subscribe') }}">{{ trans('gitamin.subscriber.button') }}</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</footer>

