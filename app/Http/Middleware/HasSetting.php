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
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class HasSetting
{
    /**
     * Run the has setting middleware.
     *
     * We're verifying that the given setting exists in our database. If it
     * doesn't, then we're sending the user to the install page so that they can
     * complete the installation of Gitamin on their server.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $settingName = $this->getSettingName($request);

        if (! Config::get('setting.'.$settingName)) {
            return Redirect::to('install');
        }

        return $next($request);
    }

    /**
     * Get the setting from the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    private function getSettingName($request)
    {
        $actions = $request->route()->getAction();

        return $actions['setting'];
    }
}
