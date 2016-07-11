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
 * This is the main routes class.
 */
class Main
{
    /**
     * Define the status page routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    public function map(Registrar $router)
    {
        $router->group(['middleware' => ['web']], function (Registrar $router) {
            $router->get('/', [
                'as'   => 'home',
                'uses' => 'HomeController@index',
            ]);

            $router->get('/explore', [
                'as'   => 'explore',
                'uses' => 'HomeController@index',
            ]);

            $router->get('/refresh', [
                'as'    => 'refresh',
                'uses'  => 'HomeController@refresh',
            ]);

            $router->get('/captcha', [
                'as'    => 'captcha',
                'uses'  => 'CaptchaController@index',
            ]);

            $router->get('/notifications', [
                'as'    => 'notifications',
                'uses'  => 'HomeController@index',
            ]);

            $router->get('/{owner}', [
                'as'    => 'owner',
                'uses'  => 'OwnerController@index',
            ]);
        });
    }
}
