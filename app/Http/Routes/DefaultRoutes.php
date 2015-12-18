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
        //Default - Dashboard
        $router->group([
            'middleware' => ['app.hasSetting', 'auth'],
            'setting' => 'app_name',
        ], function ($router) {
            $router->get('/', [
                'as' => 'home',
                'uses' => 'DashboardController@indexAction',
            ]);
        });
        //Install Area
        $router->group(['middleware' => ['app.isInstalled', 'localize']], function ($router) {
            $router->controller('install', 'InstallController');
        });

        //Signup Area
        $router->group([
            'middleware' => ['app.hasSetting', 'guest'],
            'setting' => 'app_name',
            'as' => 'signup.',
        ], function ($router) {
            $router->get('signup', [
                'as' => 'signup',
                'uses' => 'SignupController@getSignup',
            ]);
            $router->post('signup', [
                'uses' => 'SignupController@postSignup',
            ]);

            $router->get('signup/invite/{code}', [
                'as' => 'invite',
                'uses' => 'SignupController@getSignup',
            ]);
            $router->post('signup/invite/{code}', [
                'uses' => 'SignupController@postSignup',
            ]);
        });

        //Explore Area
        $router->group([
            'middleware' => ['app.hasSetting'],
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
            'middleware' => 'app.hasSetting',
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
            'middleware' => ['app.hasSetting'],
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
