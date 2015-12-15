<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers\Admin;

use Exception;
use Gitamin\Models\Setting;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class SettingsController extends Controller
{
    /**
     * Array of sub-menu items.
     *
     * @var array
     */
    protected $subMenu = [];

    /**
     * Creates a new settings controller instance.
     */
    public function __construct()
    {
        $this->subMenu = [
            'general' => [
                'title' => trans('admin.settings.general.general'),
                'url' => route('admin.settings.general'),
                'icon' => 'fa fa-gear',
                'active' => false,
            ],
            'theme' => [
                'title' => trans('admin.settings.theme.theme'),
                'url' => route('admin.settings.theme'),
                'icon' => 'fa fa-list-alt',
                'active' => false,
            ],
            'stylesheet' => [
                'title' => trans('admin.settings.stylesheet.stylesheet'),
                'url' => route('admin.settings.stylesheet'),
                'icon' => 'fa fa-magic',
                'active' => false,
            ],
            'localization' => [
                'title' => trans('admin.settings.localization.localization'),
                'url' => route('admin.settings.localization'),
                'icon' => 'fa fa-language',
                'active' => false,
            ],
            'timezone' => [
                'title' => trans('admin.settings.timezone.timezone'),
                'url' => route('admin.settings.timezone'),
                'icon' => 'fa fa-calendar',
                'active' => false,
            ],
        ];

        View::share([
            'sub_title' => trans('admin.settings.settings'),
            'sub_menu' => $this->subMenu,
        ]);
    }

    /**
     * Shows the settings general view.
     *
     * @return \Illuminate\View\View
     */
    public function showGeneralView()
    {
        $this->subMenu['general']['active'] = true;

        Session::flash('redirect_to', $this->subMenu['general']['url']);

        return View::make('admin.settings.general')
            ->withPageTitle(trans('admin.settings.general.general').' - '.trans('admin.admin'))
            ->withSubMenu($this->subMenu);
    }

    /**
     * Shows the settings localization view.
     *
     * @return \Illuminate\View\View
     */
    public function showLocalizationView()
    {
        $this->subMenu['localization']['active'] = true;

        Session::flash('redirect_to', $this->subMenu['localization']['url']);

        return View::make('admin.settings.localization')
            ->withPageTitle(trans('admin.settings.localization.localization').' - '.trans('admin.admin'))
            ->withSubMenu($this->subMenu);
    }

    /**
     * Shows the settings theme view.
     *
     * @return \Illuminate\View\View
     */
    public function showThemeView()
    {
        $this->subMenu['theme']['active'] = true;

        Session::flash('redirect_to', $this->subMenu['theme']['url']);

        return View::make('admin.settings.theme')
            ->withPageTitle(trans('admin.settings.theme.theme').' - '.trans('admin.admin'))
            ->withSubMenu($this->subMenu);
    }

    /**
     * Shows the settings timezone view.
     *
     * @return \Illuminate\View\View
     */
    public function showTimezoneView()
    {
        $this->subMenu['timezone']['active'] = true;

        Session::flash('redirect_to', $this->subMenu['timezone']['url']);

        return View::make('admin.settings.timezone')
            ->withPageTitle(trans('admin.settings.timezone.timezone').' - '.trans('admin.admin'))
            ->withSubMenu($this->subMenu);
    }

    /**
     * Shows the settings stylesheet view.
     *
     * @return \Illuminate\View\View
     */
    public function showStylesheetView()
    {
        $this->subMenu['stylesheet']['active'] = true;

        Session::flash('redirect_to', $this->subMenu['stylesheet']['url']);

        return View::make('admin.settings.stylesheet')
            ->withPageTitle(trans('admin.settings.stylesheet.stylesheet').' - '.trans('admin.admin'))
            ->withSubMenu($this->subMenu);
    }

    /**
     * Updates the system settings.
     *
     * @return \Illuminate\View\View
     */
    public function postSettings()
    {
        $redirectUrl = Session::get('redirect_to', route('admin.settings.general'));

        if (Request::get('remove_banner') === '1') {
            $setting = Setting::where('name', 'app_banner');
            $setting->delete();
        }

        if (Request::hasFile('app_banner')) {
            $file = Request::file('app_banner');

            // Image Validation.
            // Image size in bytes.
            $maxSize = $file->getMaxFilesize();

            if ($file->getSize() > $maxSize) {
                return Redirect::to($redirectUrl)->withErrors(trans('admin.settings.general.too-big', ['size' => $maxSize]));
            }

            if (! $file->isValid() || $file->getError()) {
                return Redirect::to($redirectUrl)->withErrors($file->getErrorMessage());
            }

            if (! starts_with($file->getMimeType(), 'image/')) {
                return Redirect::to($redirectUrl)->withErrors(trans('admin.settings.general.images-only'));
            }

            // Store the banner.
            Setting::firstOrCreate(['name' => 'app_banner'])->update(['value' => base64_encode(file_get_contents($file->getRealPath()))]);

            // Store the banner type
            Setting::firstOrCreate(['name' => 'app_banner_type'])->update(['value' => $file->getMimeType()]);
        }

        try {
            foreach (Request::except(['app_banner', 'remove_banner']) as $settingName => $settingValue) {
                Setting::firstOrCreate(['name' => $settingName])->update(['value' => $settingValue]);
            }
        } catch (Exception $e) {
            return Redirect::to($redirectUrl)->withErrors(trans('admin.settings.edit.failure'));
        }

        if (Request::has('app_locale')) {
            Lang::setLocale(Request::get('app_locale'));
        }

        return Redirect::to($redirectUrl)->withSuccess(trans('admin.settings.edit.success'));
    }
}
