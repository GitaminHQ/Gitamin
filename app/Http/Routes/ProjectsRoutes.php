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

             // Tree
            $router->get('{owner_path}/{project_path}/tree/{postfix}', [
                'as' => 'tree_index',
                'uses' => 'ProjectsController@showAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+')->where('postfix', '.*');

            // Namespace Projects
            //Issues
            $router->get('{owner_path}/{project_path}/issues', [
                'namespace' => 'Projects',
                'as' => 'issue_index',
                'uses' => 'IssuesController@indexAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');
            //new
            $router->get('{owner_path}/{project_path}/issues/new', [
                'namespace' => 'Projects',
                'as' => 'issue_new',
                'uses' => 'IssuesController@newAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');
            //create
            $router->post('{owner_path}/{project_path}/issues', [
                'namespace' => 'Projects',
                'as' => 'issue_create',
                'uses' => 'IssuesController@createAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');
            //show
            $router->get('{owner_path}/{project_path}/issues/{issue}', [
                'namespace' => 'Projects',
                'as' => 'issue_show',
                'uses' => 'IssuesController@showAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');
             //edit
            $router->get('{owner_path}/{project_path}/issues/{issue}/edit', [
                'namespace' => 'Projects',
                'as' => 'issue_edit',
                'uses' => 'IssuesController@editAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');
            //update
            $router->post('{owner_path}/{project_path}/issues/{issue}', [
                'namespace' => 'Projects',
                'as' => 'issue_update',
                'uses' => 'IssuesController@updateAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //Pull Requests
            $router->get('{owner_path}/{project_path}/pulls', [
                'namespace' => 'Projects',
                'as' => 'pull_index',
                'uses' => 'PullRequestsController@indexAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //Wiki
            $router->get('{owner_path}/{project_path}/wiki', [
                'namespace' => 'Projects',
                'as' => 'wiki_index',
                'uses' => 'WikiController@indexAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //Pulse
            $router->get('{owner_path}/{project_path}/pulse', [
                'namespace' => 'Projects',
                'as' => 'pulse_index',
                'uses' => 'PulseController@indexAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //Graphs
            $router->get('{owner_path}/{project_path}/graphs', [
                'namespace' => 'Projects',
                'as' => 'graph_index',
                'uses' => 'GraphsController@indexAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            //Comments
            //create
            $router->post('{owner_path}/{project_path}/comments', [
                'namespace' => 'Projects',
                'as' => 'comment_create',
                'uses' => 'CommentsController@createAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

            // Commits
             $router->get('{owner_path}/{project_path}/commits/{postfix}', [
                'namespace' => 'Projects',
                'as' => 'commits_index',
                'uses' => 'CommitsController@indexAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+')->where('postfix', '.*');

             // Stats
             $router->get('{owner_path}/{project_path}/stats/{postfix}', [
                'namespace' => 'Projects',
                'as' => 'stats_index',
                'uses' => 'StatsController@indexAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+')->where('postfix', '.*');

             // Network
             $router->get('{owner_path}/{project_path}/network', [
                'namespace' => 'Projects',
                'as' => 'network_index',
                'uses' => 'NetworkController@indexAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+');

             $router->get('{owner_path}/{project_path}/network/{postfix}', [
                'namespace' => 'Projects',
                'as' => 'network_index',
                'uses' => 'NetworkController@graphAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+')->where('postfix', '.*');

            // Blob
             $router->get('{owner_path}/{project_path}/blob/{postfix}', [
                'namespace' => 'Projects',
                'as' => 'pulse_index',
                'uses' => 'BlobController@indexAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+')->where('project_path', '[a-zA-z.0-9_\-]+')->where('postfix', '.*');

        });
    }
}
