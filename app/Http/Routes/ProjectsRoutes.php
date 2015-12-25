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
            'middleware' => ['web', 'app.hasSetting'],
            'setting' => 'app_name',
            'prefix' => 'projects',
            'as' => 'projects.',
        ], function ($router) {
            $router->get('/', [
                'as' => 'index',
                'uses' => 'ProjectsController@indexAction',
            ]);
            $router->get('new', [
                'as' => 'new',
                'uses' => 'ProjectsController@newAction',
            ]);
            $router->post('create', [
                'as' => 'create',
                'uses' => 'ProjectsController@createAction',
            ]);
        });

        // Project Sub-routes
        $router->group([
            'middleware' => ['web', 'app.hasSetting'],
            'setting' => 'app_name',
            'as' => 'projects.',
        ], function ($router) {
           $router->get('{owner_path}/{project_path}', [
                'as' => 'project_show',
                'uses' => 'ProjectsController@showAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

           $router->get('{owner_path}/{project_path}/edit', [
                'as' => 'project_edit',
                'uses' => 'ProjectsController@editAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');
            $router->post('{owner_path}/{project_path}', [
                'as' => 'project_update',
                'uses' => 'ProjectsController@updateAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //Issues
            $router->get('{owner_path}/{project_path}/issues', [
                'as' => 'issue_index',
                'uses' => 'Projects\\IssuesController@indexAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');
            //new
            $router->get('{owner_path}/{project_path}/issues/new', [
                'as' => 'issue_new',
                'uses' => 'Projects\\IssuesController@newAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');
            //create
            $router->post('{owner_path}/{project_path}/issues', [
                'as' => 'issue_create',
                'uses' => 'Projects\\IssuesController@createAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');
            //show
            $router->get('{owner_path}/{project_path}/issues/{issue}', [
                'as' => 'issue_show',
                'uses' => 'Projects\\IssuesController@showAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');
             //edit
            $router->get('{owner_path}/{project_path}/issues/{issue}/edit', [
                'as' => 'issue_edit',
                'uses' => 'Projects\\IssuesController@editAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');
            //update
            $router->post('{owner_path}/{project_path}/issues/{issue}', [
                'as' => 'issue_update',
                'uses' => 'Projects\\IssuesController@updateAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //Pull Requests
            $router->get('{owner_path}/{project_path}/pulls', [
                'as' => 'pull_index',
                'uses' => 'Projects\\PullRequestsController@indexAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //Wiki
            $router->get('{owner_path}/{project_path}/wiki', [
                'as' => 'wiki_index',
                'uses' => 'Projects\\WikiController@indexAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //Pulse
            $router->get('{owner_path}/{project_path}/pulse', [
                'as' => 'pulse_index',
                'uses' => 'Projects\\PulseController@indexAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //Graphs
            $router->get('{owner_path}/{project_path}/graphs', [
                'as' => 'graph_index',
                'uses' => 'Projects\\GraphsController@indexAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //Comments
            //create
            $router->post('{owner_path}/{project_path}/comments', [
                'as' => 'comment_create',
                'uses' => 'Projects\\CommentsController@createAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');
        });
    }
}
