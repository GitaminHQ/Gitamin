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

class Timezone
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string                   $type
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($tz = $request->header('Time-Zone')) {
            app('config')->set('gitamin.timezone', $tz);
        }

        return $next($request);
    }
}
