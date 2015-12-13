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
use Gitamin\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiAuthenticate
{
    /**
     * The authentication guard instance.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new api authenticate middleware instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($apiToken = $request->header('X-Gitamin-Token')) {
                try {
                    $this->auth->onceUsingId(User::findByApiToken($apiToken)->id);
                } catch (ModelNotFoundException $e) {
                    throw new HttpException(401);
                }
            } elseif ($request->getUser()) {
                if ($this->auth->onceBasic() !== null) {
                    throw new HttpException(401);
                }
            } else {
                throw new HttpException(401);
            }
        }

        return $next($request);
    }
}
