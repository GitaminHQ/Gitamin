<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Composers;

use Gitamin\Facades\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;

class AppComposer
{
    /**
     * Index page view composer.
     *
     * @param \Illuminate\Contracts\View\View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->withAppBanner(Setting::get('app_banner'));
        $view->withAppBannerStyleFullWidth(Setting::get('style_fullwidth_header'));
        $view->withAppBannerType(Setting::get('app_banner_type'));
        $view->withAppDomain(Setting::get('app_domain'));
        $view->withGitClientPath(Setting::get('git_client_path'));
        $view->withGitRepositoriesPath(Setting::get('git_repositories_path'));
        $view->withAppLocale(Setting::get('app_locale'));
        $view->withAppName(Setting::get('app_name'));
        $view->withAppStylesheet(Setting::get('app_stylesheet'));
        $view->withAppUrl(Config::get('app.url'));
        $view->withGoogleFontsUrl(Config::get('gitamin.google_fonts_url'));
    }
}
