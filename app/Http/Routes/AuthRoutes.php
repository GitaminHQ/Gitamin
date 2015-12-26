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
            'namespace' => 'Auth',
            'as' => 'auth.',
            'middleware' => ['web', 'app.hasSetting'],
            'prefix' => 'auth',
            'setting' => 'app_name',
        ], function ($router) {
            $router->get('login', [
                'middleware' => 'guest',
                'as' => 'login',
                'uses' => 'AuthController@loginAction',
            ]);

            $router->post('login', [
                'middleware' => ['guest', 'throttle:10,10'],
                'uses' => 'AuthController@loginPost',
            ]);

            $router->get('logout', [
                'as' => 'logout',
                'uses' => 'AuthController@logoutAction',
                'middleware' => 'auth',
            ]);

            $router->get('password', [
                'middleware' => 'guest',
                'as' => 'password',
                'uses' => 'PasswordController@getEmail',
            ]);

            $router->post('password/email', [
                'middleware' => 'guest',
                'uses' => 'PasswordController@postEmail'
            ]);
            $router->get('password/reset/{token}', [
                'middleware' => 'guest',
                'uses' => 'PasswordController@getReset',
            ]);
            $router->post('password/reset', [
                'middleware' => 'guest',
                'uses' => 'PasswordController@postReset',
            ]);

        });
    }
}
