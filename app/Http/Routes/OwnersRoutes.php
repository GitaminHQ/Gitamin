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
 * This is the owners routes class.
 */
class OwnersRoutes
{
    /**
     * Define the groups routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        // Project Sub-routes groups.group_show, groups.group_edit
        $router->group([
            'middleware' => ['app.hasSetting', 'auth'],
            'setting' => 'app_name',
            'as' => 'owners.',
        ], function ($router) {
           $router->get('{owner_path}', [
                'as' => 'owner_show',
                'uses' => 'OwnersController@showAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+');

        });
    }
}
