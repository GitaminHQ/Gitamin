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

use Gitamin\Composers\AdminComposer;
use Gitamin\Composers\AppComposer;
use Gitamin\Composers\CurrentUserComposer;
use Gitamin\Composers\DashboardComposer;
use Gitamin\Composers\ExploreComposer;
use Gitamin\Composers\ThemeComposer;
use Gitamin\Composers\TimezoneLocaleComposer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @param \Illuminate\Contracts\View\Factory $factory
     */
    public function boot(Factory $factory)
    {
        $factory->composer('*', AppComposer::class);
        $factory->composer('*', CurrentUserComposer::class);
        $factory->composer(['index', 'issue', 'subscribe', 'signup'], ExploreComposer::class);
        $factory->composer(['index', 'issue', 'subscribe', 'signup', 'admin.settings.theme'], ThemeComposer::class);
        $factory->composer('dashboard.*', DashboardComposer::class);
        $factory->composer('admin.*', AdminComposer::class);
        $factory->composer(['install', 'admin.settings.localization', 'admin.settings.timezone'], TimezoneLocaleComposer::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
