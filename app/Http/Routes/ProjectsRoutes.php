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
 * This is the projects routes class.
 */
class ProjectsRoutes
{
    /**
     * Define the projects routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group([
            'middleware' => ['app.hasSetting'],
            'setting'    => 'app_name',
            'prefix'     => 'projects',
            'as'         => 'projects.',
        ], function ($router) {
            $router->get('/', [
                'as'   => 'index',
                'uses' => 'ProjectsController@index',
            ]);
            $router->get('new', [
                'as'    => 'new',
                'uses'  => 'ProjectsController@new',
            ]);

            $router->post('create', [
                'as'    => 'create',
                'uses'  => 'ProjectsController@create',
            ]);

            
        });
    }
}
