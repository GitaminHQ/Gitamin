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
        // Project Area
        $router->group([
            'middleware' => ['app.hasSetting'],
            'setting'    => 'app_name',
            'prefix'     => 'projects',
            'as'         => 'projects.',
        ], function ($router) {
            $router->get('/', [
                'as'   => 'index',
                'uses' => 'ProjectsController@indexAction',
            ]);
            $router->get('new', [
                'as'    => 'new',
                'uses'  => 'ProjectsController@newAction',
            ]);
            $router->post('create', [
                'as'    => 'create',
                'uses'  => 'ProjectsController@createAction',
            ]);
        });

        // Project Sub-routes
        $router->group([
            'middleware' => ['app.hasSetting'],
            'setting'    => 'app_name',
            'as'         => 'projects.',
        ], function ($router) {
           $router->get('{owner_path}/{project_path}', [
                'as'   => 'project_show',
                'uses' => 'ProjectsController@showAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

           $router->get('{owner_path}/{project_path}/edit', [
                'as'   => 'project_edit',
                'uses' => 'ProjectsController@editAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');
            $router->post('{owner_path}/{project_path}/update', [
                'as'    => 'project_update',
                'uses'  => 'ProjectsController@updateAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //Issues
            $router->get('{owner_path}/{project_path}/issues', [
                'as'   => 'issue_index',
                'uses' => 'Projects\\IssuesController@index',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //new
            $router->get('{owner_path}/{project_path}/issues/new', [
                'as'   => 'issue_new',
                'uses' => 'Projects\\IssuesController@add',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //create
            $router->post('{owner_path}/{project_path}/issues', [
                'as'   => 'issue_create',
                'uses' => 'Projects\\IssuesController@create',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //show
            $router->get('{owner_path}/{project_path}/issues/{issue}', [
                'as'   => 'issue_show',
                'uses' => 'Projects\\IssuesController@show',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //update
            $router->post('{owner_path}/{project_path}/issues/{issue}', [
                'as'   => 'issue_update',
                'uses' => 'Projects\\IssuesController@update',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');
        });
    }
}
