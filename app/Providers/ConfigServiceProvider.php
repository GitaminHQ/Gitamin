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

use Exception;
use Gitamin\Config\Repository;
use Gitamin\Facades\Setting;
use Gitamin\Models\Setting as SettingModel;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $appDomain = $appLocale = $appTimezone = null;

        try {
            // Get app custom configuration.
            $appDomain = Setting::get('app_domain');
            $appLocale = Setting::get('app_locale');
            $appTimezone = Setting::get('app_timezone');

            // Setup Cors.
            $allowedOrigins = $this->app->config->get('cors.defaults.allowedOrigins');
            $allowedOrigins[] = Setting::get('app_domain');

            // Add our allowed domains too.
            if ($allowedDomains = Setting::get('allowed_domains')) {
                $domains = explode(',', $allowedDomains);
                foreach ($domains as $domain) {
                    $allowedOrigins[] = $domain;
                }
            } else {
                $allowedOrigins[] = $this->app->config->get('app.url');
            }

            $this->app->config->set('cors.paths.api/v1/*.allowedOrigins', $allowedOrigins);
        } catch (Exception $e) {
            // Don't throw any errors, we may not be setup yet.
        }

        // Override default app values.
        $this->app->config->set('app.url', $appDomain ?: $this->app->config->get('app.url'));
        $this->app->config->set('app.locale', $appLocale ?: $this->app->config->get('app.locale'));
        $this->app->config->set('gitamin.timezone', $appTimezone ?: $this->app->config->get('gitamin.timezone'));

        // Set custom lang.
        $this->app->translator->setLocale($appLocale);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind('setting', function () {
            return new Repository(new SettingModel());
        }, true);
    }
}
