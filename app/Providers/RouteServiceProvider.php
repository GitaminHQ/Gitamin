<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Gitamin\Http\Controllers';

    /**
     * Define the route model bindings, pattern filters, etc.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $this->registerBindings();
    }

    /**
     * Register model bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->router->model('owner', 'Gitamin\Models\Owner');
        $this->app->router->model('project', 'Gitamin\Models\Project');
        $this->app->router->model('issue', 'Gitamin\Models\Issue');
        $this->app->router->model('comment', 'Gitamin\Models\Comment');
        $this->app->router->model('setting', 'Gitamin\Models\Setting');
        $this->app->router->model('subscriber', 'Gitamin\Models\Subscriber');
        $this->app->router->model('user', 'Gitamin\Models\User');
        $this->app->router->model('role', 'Gitamin\Models\Role');
        $this->app->router->model('permission', 'Gitamin\Models\Permission');
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {
            foreach (glob(app_path('Http//Routes').'/*.php') as $file) {
                $this->app->make('Gitamin\\Http\\Routes\\'.basename($file, '.php'))->map($router);
            }
        });
    }
}
