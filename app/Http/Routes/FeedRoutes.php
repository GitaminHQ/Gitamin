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
 * This is the feed routes class.
 */
class FeedRoutes
{
    /**
     * Define the feed routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        // Prevent access until the app is setup.
        $router->group([
            'middleware' => 'app.hasSetting',
            'setting'    => 'app_name',
        ], function ($router) {
            $router->get('/atom/{project_group?}', [
                'as'   => 'feed.atom',
                'uses' => 'AtomController@feedAction',
            ]);
            $router->get('/rss/{project_group?}', [
                'as'   => 'feed.rss',
                'uses' => 'RssController@feedAction',
            ]);
        });
    }
}
