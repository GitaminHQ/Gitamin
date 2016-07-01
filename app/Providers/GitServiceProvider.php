<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Providers;

use Gitamin\Services\Git\Client;
use Gitamin\Services\Git\Repository;
use Gitamin\Services\Git\Util;
use Illuminate\Support\ServiceProvider;

class GitServiceProvider extends ServiceProvider
{
    /**
     * Indicats if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the parser provider.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the parser services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('git', function ($app) {
            return new Client([
                'default_branch' => config('gitamin.default_branch'),
                'path' => config('gitamin.client'),
                'hidden' => [],
                'projects' => '',
            ]);
        });

        $this->app->singleton('git_util', function($app) {
            return new Util();
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
            'git',
            'git_util',
        ];
    }
}
