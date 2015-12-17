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
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'csrf' => 'Illuminate\Foundation\Http\Middleware\VerifyCsrfToken',
        'role' => 'Zizaco\Entrust\Middleware\EntrustRole',
        'permission' => 'Zizaco\Entrust\Middleware\EntrustPermission',
        'ability' => 'Zizaco\Entrust\Middleware\EntrustAbility',
        'accept' => 'Gitamin\Http\Middleware\Acceptable',
        'admin' => 'Gitamin\Http\Middleware\Admin',
        'app.hasSetting' => 'Gitamin\Http\Middleware\HasSetting',
        'app.isInstalled' => 'Gitamin\Http\Middleware\AppIsInstalled',
        'app.subscribers' => 'Gitamin\Http\Middleware\SubscribersConfigured',
        'auth' => 'Gitamin\Http\Middleware\Authenticate',
        'auth.api' => 'Gitamin\Http\Middleware\ApiAuthenticate',
        'auth.api.optional' => 'Gitamin\Http\Middleware\ApiOptionalAuthenticate',
        'guest' => 'Gitamin\Http\Middleware\RedirectIfAuthenticated',
        'localize' => 'Gitamin\Http\Middleware\Localize',
        'timezone' => 'Gitamin\Http\Middleware\Timezone',
    ];
}
