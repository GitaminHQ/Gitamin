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

use Gitamin\Services\DataCollector\DataCollector;
use Illuminate\Support\ServiceProvider;

class DataCollectorServiceProvider extends ServiceProvider
{
    /**
     * Indicats if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the DataCollector provider.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the DataCollector services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('dc', function ($app) {
            return new DataCollector($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'dc',
        ];
    }
}
