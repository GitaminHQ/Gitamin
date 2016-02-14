<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class AppIsInstalled
{
    /**
     * Run the app is installed middleware.
     *
     * We're verifying that Gitamin is correctly installed. If it is, then we're
     * redirecting the user to the dashboard so they can use Gitamin.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Config::get('setting.app_name')) {
            return Redirect::home();
        }

        return $next($request);
    }
}
