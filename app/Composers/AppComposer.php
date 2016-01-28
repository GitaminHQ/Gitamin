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

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;

class AppComposer
{
    /**
     * Index page view composer.
     *
     * @param \Illuminate\Contracts\View\View $view
     */
    public function compose(View $view)
    {
        $view->withAppBanner(Config::get('setting.app_banner'));
        $view->withAppBannerStyleFullWidth(Config::get('setting.style_fullwidth_header'));
        $view->withAppBannerType(Config::get('setting.app_banner_type'));
        $view->withAppDomain(Config::get('setting.app_domain'));
        $view->withGitClientPath(Config::get('setting.git_client_path'));
        $view->withGitRepositoriesPath(Config::get('setting.git_repositories_path'));
        $view->withAppLocale(Config::get('setting.app_locale'));
        $view->withAppName(Config::get('setting.app_name'));
        $view->withAppStylesheet(Config::get('setting.stylesheet'));
        $view->withAppUrl(Config::get('app.url'));
        $view->withGoogleFontsUrl(Config::get('gitamin.google_fonts_url'));
    }
}
