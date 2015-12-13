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
 * This is the admin routes class.
 */
class AdminRoutes
{
    /**
     * Define the admin routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        //Dashboard area
        $router->group([
            'middleware' => ['auth', 'admin'],
            'prefix' => 'admin',
            'namespace' => 'Admin',
            'as' => 'admin.',
        ], function ($router) {
            $router->get('/', [
                'as' => 'index',
                'uses' => 'DashboardController@indexAction',
            ]);

             // Settings
            $router->group([
                'as' => 'settings.',
                'prefix' => 'settings',
            ], function ($router) {
                $router->get('general', [
                    'as' => 'general',
                    'uses' => 'SettingsController@showGeneralView',
                ]);
                $router->get('localization', [
                    'as' => 'localization',
                    'uses' => 'SettingsController@showLocalizationView',
                ]);
                $router->get('timezone', [
                    'as' => 'timezone',
                    'uses' => 'SettingsController@showTimezoneView',
                ]);
                $router->get('theme', [
                    'as' => 'theme',
                    'uses' => 'SettingsController@showThemeView',
                ]);
                $router->get('stylesheet', [
                    'as' => 'stylesheet',
                    'uses' => 'SettingsController@showStylesheetView',
                ]);
                $router->post('/', 'SettingsController@postSettings');
            });
        });
    }
}
