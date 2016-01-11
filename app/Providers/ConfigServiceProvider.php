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
use Gitamin\Config\Config as BaseConfig;
use Gitamin\Models\Setting as SettingModel;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        if ($this->app->configurationIsCached()) {
            if ($this->app->environment() === 'production') {
                $this->app->terminating(function () {
                    if ($this->app->setting->stale()) {
                        $this->app->make(Kernel::class)->call('config:cache');
                    }
                });
            } else {
                $this->app->make(Kernel::class)->call('config:clear');
            }

            return;
        }
        try {
            $this->app->config->set('setting', $this->app->setting->all());
        } catch (Exception $e) {
            //
        }
        if ($appDomain = $this->app->config->get('setting.app_domain')) {
            $this->app->config->set('app.url', $appDomain);
        }
        if ($appLocale = $this->app->config->get('setting.app.locale')) {
            $this->app->config->set('app.locale', $appLocale);
            $this->app->translator->setLocale($appLocale);
        }
        if ($appTimezone = $this->app->config->get('setting.app_timezone')) {
            $this->app->config->set('cachet.timezone', $appTimezone);
        }
        $allowedOrigins = $this->app->config->get('cors.defaults.allowedOrigins');
        if ($allowedDomains = $this->app->config->get('setting.allowed_domains')) {
            $domains = explode(',', $allowedDomains);
            foreach ($domains as $domain) {
                $allowedOrigins[] = $domain;
            }
        } else {
            $allowedOrigins[] = $this->app->config->get('app.url');
        }
        $this->app->config->set('cors.paths.api/v1/*.allowedOrigins', $allowedOrigins);
        if ($this->app->environment() === 'production') {
            $this->app->terminating(function () {
                $this->app->make(Kernel::class)->call('config:cache');
            });
        }
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('setting', function () {
            return new BaseConfig(new SettingModel());
        });
        $this->app->alias('setting', BaseConfig::class);
    }
}
