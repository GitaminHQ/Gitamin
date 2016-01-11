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

class ThemeComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\Contracts\View\View $view
     */
    public function compose(View $view)
    {
        // Theme colors.
        $view->withThemeBackgroundColor(Config::get('setting.style_background_color', '#F0F3F4'));
        $view->withThemeBackgroundFills(Config::get('setting.style_background_fills', '#FFFFFF'));
        $view->withThemeBannerBackgroundColor(Config::get('setting.style_banner_background_color', ''));
        $view->withThemeBannerPadding(Config::get('setting.style_banner_padding', '40px 0'));
        $view->withThemeTextColor(Config::get('setting.style_text_color', '#333333'));
        $view->withThemeReds(Config::get('setting.style_reds', '#ff6f6f'));
        $view->withThemeBlues(Config::get('setting.style_blues', '#3498db'));
        $view->withThemeGreens(Config::get('setting.style_greens', '#7ED321'));
        $view->withThemeYellows(Config::get('setting.style_yellows', '#F7CA18'));
        $view->withThemeOranges(Config::get('setting.style_oranges', '#FF8800'));
        $view->withThemeLinks(Config::get('setting.style_links', '#7ED321'));
    }
}
