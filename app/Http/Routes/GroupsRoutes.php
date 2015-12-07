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
 * This is the groups routes class.
 */
class GroupsRoutes
{
    /**
     * Define the groups routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group([
            'middleware' => ['app.hasSetting'],
            'setting'    => 'app_name',
            'prefix'     => 'groups',
            'as'         => 'groups.',
        ], function ($router) {
            $router->get('/', [
                'as'   => 'index',
                'uses' => 'GroupsController@indexAction',
            ]);
            $router->get('new', [
                'as'    => 'new',
                'uses'  => 'GroupsController@newAction',
            ]);

            $router->post('create', [
                'as'    => 'create',
                'uses'  => 'GroupsController@createAction',
            ]);   
        });

        // Project Sub-routes groups.group_show, groups.group_edit
        $router->group([
            'middleware' => ['app.hasSetting'],
            'setting'    => 'app_name',
            'as'         => 'groups.',
        ], function ($router) {
           $router->get('{namespace}', [
                'as'   => 'group_show',
                'uses' => 'GroupsController@showAction',
            ])->where('namespace', '[a-zA-z.0-9_\-]+');

           $router->get('{namespace}/edit', [
                'as'   => 'group_edit',
                'uses' => 'GroupsController@editAction',
            ])->where('namespace', '[a-zA-z.0-9_\-]+');
            $router->post('{namespace}/update', [
                'as'    => 'group_update',
                'uses'  => 'GroupsController@updateAction',
            ])->where('namespace', '[a-zA-z.0-9_\-]+');
            
        });
    }
}
