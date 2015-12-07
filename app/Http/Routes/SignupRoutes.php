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
 * This is the signup routes class.
 */
class SignupRoutes
{
    /**
     * Define the signup routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group([
            'middleware' => ['app.hasSetting', 'guest'],
            'setting'    => 'app_name',
            'as'         => 'signup.',
        ], function ($router) {

            $router->get('signup', [
                'as'   => 'user/signup',
                'uses' => 'SignupController@getSignup',
            ]);

            $router->get('signup/invite/{code}', [
                'as'   => 'invite',
                'uses' => 'SignupController@getSignup',
            ]);

            $router->post('signup/invite/{code}', [
                'uses' => 'SignupController@postSignup',
            ]);
        });
    }
}
