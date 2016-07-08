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

use Gitamin\Models\Issue;
use Gitamin\Models\Owner;
use Gitamin\Models\Project;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Gitamin\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function boot(Router $router)
    {
        //
        $router->pattern('owner', '[a-zA-Z.0-9_\-]+');
        $router->pattern('project', '[a-zA-Z.0-9_\-]+');
        $router->pattern('commitishPath', '.+');
        $router->pattern('commit', '[a-f0-9^]+');

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
        $this->app->router->model('owner', Owner::class, function ($slug) {
            return Owner::where('slug', $slug)->firstOrFail();
        });


        $this->app->router->bind('project', function ($slug, $route) {
            $owner = $route->getParameter('owner');

            return Project::where([
                    'owner_id' => $owner->id,
                    'slug'     => $slug,
                ])->firstOrFail();
        });

        $this->app->router->bind('issue', function ($iid, $route) {
            $project = $route->getParameter('project');

            return Issue::where([
                    'project_id' => $project->id,
                    'iid'        => $iid,
                ])->firstOrFail();
        });
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
        $this->mapWebRoutes($router);

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    protected function mapWebRoutes(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {
            foreach (glob(app_path('Http//Routes').'/*.php') as $file) {
                $this->app->make('Gitamin\\Http\\Routes\\'.basename($file, '.php'))->map($router);
            }
        });
    }
}
