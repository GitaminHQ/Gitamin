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
        
        //Homepage
        $router->group([
            'middleware' => ['app.hasSetting'],
            'setting'    => 'app_name',
        ], function ($router) {
            $router->get('/', [
                'as'   => 'index',
                'uses' => 'ExploreController@index',
            ]);
            
        });

        //Install Area
        $router->group(['middleware' => ['app.isInstalled', 'localize']], function ($router) {
            $router->controller('install', 'InstallController');
        });

        //Explore Area
        $router->group([
            'middleware' => ['app.hasSetting'],
            'setting'    => 'app_name',
            'prefix'     => 'explore',
            'as'         => 'explore.',
        ], function ($router) {
            $router->get('/', [
                'as'   => 'index',
                'uses' => 'ExploreController@index',
            ]);
            
            $router->get('issue/{issue}', [
                'as'    => 'issue',
                'uses'  => 'ExploreController@showIssue',
            ]);
            
        });
        
        // Feed Area
        $router->group([
            'middleware' => 'app.hasSetting',
            'setting'    => 'app_name',
        ], function ($router) {
            $router->get('/atom/{namespace?}', [
                'as'   => 'feed.atom',
                'uses' => 'FeedController@atomAction',
            ]);
            $router->get('/rss/{namespace?}', [
                'as'   => 'feed.rss',
                'uses' => 'FeedController@rssAction',
            ]);
        });


    }
}
