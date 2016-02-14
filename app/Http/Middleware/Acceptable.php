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
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

class Acceptable
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
    public function handle(Request $request, Closure $next, $type = null)
    {
        if (! $request->accepts($type ?: 'accept:application/json')) {
            throw new NotAcceptableHttpException();
        }

        return $next($request);
    }
}
