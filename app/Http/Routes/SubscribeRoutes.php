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
 * This is the subscriber routes class.
 */
class SubscribeRoutes
{
    /**
     * Define the subscribe routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group([
            'middleware' => ['app.hasSetting', 'localize'],
            'setting' => 'app_name',
            'as' => 'subscribe.',
        ], function ($router) {
            $router->group(['middleware' => 'app.subscribers'], function ($router) {
                $router->get('subscribe', [
                    'as' => 'subscribe',
                    'uses' => 'SubscribeController@showSubscribe',
                ]);

                $router->post('subscribe', [
                    'uses' => 'SubscribeController@postSubscribe',
                ]);
            });

            $router->get('subscribe/verify/{code}', [
                'as' => 'verify',
                'uses' => 'SubscribeController@getVerify',
            ]);

            $router->get('unsubscribe/{code}', [
                'as' => 'unsubscribe',
                'uses' => 'SubscribeController@getUnsubscribe',
            ]);
        });
    }
}
