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
 * This is the api routes class.
 */
class ApiRoutes
{
    /**
     * Define the api routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group([
            'namespace'  => 'Api',
            'prefix'     => 'api/v1',
            'middleware' => ['accept:application/json', 'timezone', 'auth.api.optional'],
        ], function ($router) {
            // General
            $router->get('ping', 'GeneralController@ping');

            // Projects
            $router->get('projects', 'ProjectController@getProjects');
            $router->get('owners', 'OwnerController@getOwners');
            $router->get('owners/{owner}', 'OwnerController@getOwner');
            $router->get('projects/{project}', 'ProjectController@getProject');

            // Issues
            $router->get('issues', 'IssueController@getIssues');
            $router->get('issues/{issue}', 'IssueController@getIssue');

            // Comments
            $router->get('comments', 'CommentController@getComments');
            $router->get('comments/{comment}', 'CommentController@getComment');

            // Authorization Required
            $router->group(['middleware' => 'auth.api'], function ($router) {
                $router->get('subscribers', 'SubscriberController@getSubscribers');

                $router->post('projects', 'ProjectController@postProjects');
                $router->post('owners', 'OwnerController@postOwners');
                $router->post('issues', 'IssueController@postIssues');
                $router->post('comments', 'CommentController@postComments');
                $router->post('subscribers', 'SubscriberController@postSubscribers');

                $router->put('owners/{owner}', 'OwnerController@putOwner');
                $router->put('projects/{project}', 'ProjectController@putProject');
                $router->put('issues/{issue}', 'IssueController@putIssue');

                $router->delete('owners/{owner}', 'OwnerController@deleteOwner');
                $router->delete('projects/{project}', 'ProjectController@deleteProject');
                $router->delete('issues/{issue}', 'IssueController@deleteIssue');
                $router->delete('subscribers/{subscriber}', 'SubscriberController@deleteSubscriber');
            });
        });
    }
}
