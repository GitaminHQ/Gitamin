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
 * This is the profile routes class.
 */
class ProfileRoutes
{
    /**
     * Define the profile routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group([
            'middleware' => ['app.hasSetting'],
            'setting'    => 'app_name',
            'as'         => 'profile.',
        ], function ($router) {
            $router->get('profile', [
                'as'   => 'index',
                'uses' => 'Profile\\ProfileController@index',
            ]);

            
        });
    }
}
