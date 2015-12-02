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
 * This is the admin routes class.
 */
class AdminRoutes
{
    /**
     * Define the admin routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group([
            'middleware' => ['app.hasSetting'],
            'setting'    => 'app_name',
            'as'         => 'admin.',
        ], function ($router) {
            $router->get('admin', [
                'as'   => 'index',
                'uses' => 'Admin\\DashboardController@index',
            ]);

            
        });
    }
}