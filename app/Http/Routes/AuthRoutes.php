<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

/**
 * This is the auth routes class.
 */
class AuthRoutes
{
    /**
     * Define the auth routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group([
            'as' => 'auth.',
            'middleware' => 'app.hasSetting',
            'prefix' => 'auth',
            'setting' => 'app_name',
        ], function ($router) {
            $router->get('login', [
                'middleware' => 'guest',
                'as' => 'login',
                'uses' => 'AuthController@loginAction',
            ]);

            $router->post('login', [
                'middleware' => ['guest', 'csrf'],
                'uses' => 'AuthController@loginPost',
            ]);

            $router->get('logout', [
                'as' => 'logout',
                'uses' => 'AuthController@logoutAction',
                'middleware' => 'auth',
            ]);
        });
    }
}
