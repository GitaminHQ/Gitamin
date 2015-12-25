<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Fideloper\Proxy\TrustProxies',
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
    ];

    protected $middlewareGroups = [
        'web' => [
            'Illuminate\Cookie\Middleware\EncryptCookies',
            'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
            'Illuminate\Session\Middleware\StartSession',
            'Illuminate\View\Middleware\ShareErrorsFromSession',
            'Illuminate\Foundation\Http\Middleware\VerifyCsrfToken',
        ],
        'api' => [
            'Gitamin\Http\Middleware\Acceptable',
            'Gitamin\Http\Middleware\Timezone',
            'throttle:60,1',
        ],
    ];
    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'admin' => 'Gitamin\Http\Middleware\Admin',
        'auth' => 'Gitamin\Http\Middleware\Authenticate',
        'auth.api' => 'Gitamin\Http\Middleware\ApiAuthentication',
        'guest' => 'Gitamin\Http\Middleware\RedirectIfAuthenticated',
        'app.hasSetting' => 'Gitamin\Http\Middleware\HasSetting',
        'app.isInstalled' => 'Gitamin\Http\Middleware\AppIsInstalled',
        'app.subscribers' => 'Gitamin\Http\Middleware\SubscribersConfigured',
        'localize' => 'Gitamin\Http\Middleware\Localize',
        'timezone' => 'Gitamin\Http\Middleware\Timezone',
        'throttle' => 'Illuminate\Routing\Middleware\ThrottleRequests',
    ];
}
