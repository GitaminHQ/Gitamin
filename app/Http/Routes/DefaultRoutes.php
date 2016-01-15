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
 * This is the default routes class.
 */
class DefaultRoutes
{
    /**
     * Define the install routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        //Install Area
        $router->group(['middleware' => ['web', 'app.isInstalled']], function ($router) {
            $router->controller('install', 'InstallController');
        });

        //Default - Dashboard
        $router->group([
            'middleware' => ['web', 'app.hasSetting', 'auth'],
            'setting' => 'app_name',
        ], function ($router) {
            $router->get('/', [
                'as' => 'home',
                'uses' => 'DashboardController@indexAction',
            ]);
        });

        //Explore Area
        $router->group([
            'middleware' => ['web', 'app.hasSetting'],
            'setting' => 'app_name',
            'prefix' => 'explore',
            'as' => 'explore.',
        ], function ($router) {
            $router->get('/', [
                'as' => 'index',
                'uses' => 'ExploreController@indexAction',
            ]);
            $router->get('groups', [
                'as' => 'groups',
                'uses' => 'ExploreController@groupsAction',
            ]);

            $router->get('issue/{issue}', [
                'as' => 'issue',
                'uses' => 'ExploreController@showIssue',
            ]);
        });

        // Feed Area
        $router->group([
            'middleware' => ['web'],
            'setting' => 'app_name',
        ], function ($router) {
            $router->get('/atom/{namespace?}', [
                'as' => 'feed.atom',
                'uses' => 'FeedController@atomAction',
            ]);
            $router->get('/rss/{namespace?}', [
                'as' => 'feed.rss',
                'uses' => 'FeedController@rssAction',
            ]);
        });

        // Profile Area
        $router->group([
            'middleware' => ['web', 'app.hasSetting', 'auth'],
            'setting' => 'app_name',
            'as' => 'profile.',
        ], function ($router) {
            $router->get('profile', [
                'as' => 'index',
                'uses' => 'ProfilesController@indexAction',
            ]);
            $router->post('profile', [
                'as' => 'update',
                'uses' => 'ProfilesController@updateAction',
            ]);
            $router->get('profile/{username}', [
                'as' => 'show',
                'uses' => 'ProfilesController@showAction',
            ])->where('username', '[a-zA-z.0-9_\-]+');
        });
    }
}
