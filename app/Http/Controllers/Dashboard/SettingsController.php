<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers\Dashboard;

use Exception;
use Gitamin\Models\Setting;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
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
     *
     * @return void
     */
    public function __construct()
    {
        $this->subMenu = [
            'general' => [
                'title'  => trans('dashboard.settings.general.general'),
                'url'    => route('dashboard.settings.general'),
                'icon'   => 'fa fa-gear',
                'active' => false,
            ],
            'theme' => [
                'title'  => trans('dashboard.settings.theme.theme'),
                'url'    => route('dashboard.settings.theme'),
                'icon'   => 'fa fa-list-alt',
                'active' => false,
            ],
            'stylesheet' => [
                'title'  => trans('dashboard.settings.stylesheet.stylesheet'),
                'url'    => route('dashboard.settings.stylesheet'),
                'icon'   => 'fa fa-magic',
                'active' => false,
            ],
            'localization' => [
                'title'  => trans('dashboard.settings.localization.localization'),
                'url'    => route('dashboard.settings.localization'),
                'icon'   => 'fa fa-language',
                'active' => false,
            ],
            'timezone' => [
                'title'  => trans('dashboard.settings.timezone.timezone'),
                'url'    => route('dashboard.settings.timezone'),
                'icon'   => 'fa fa-calendar',
                'active' => false,
            ],
        ];

        View::share([
            'sub_title' => trans('dashboard.settings.settings'),
            'sub_menu'  => $this->subMenu,
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

        return View::make('dashboard.settings.general')
            ->withPageTitle(trans('dashboard.settings.general.general').' - '.trans('dashboard.dashboard'))
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

        return View::make('dashboard.settings.localization')
            ->withPageTitle(trans('dashboard.settings.localization.localization').' - '.trans('dashboard.dashboard'))
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

        return View::make('dashboard.settings.theme')
            ->withPageTitle(trans('dashboard.settings.theme.theme').' - '.trans('dashboard.dashboard'))
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

        return View::make('dashboard.settings.timezone')
            ->withPageTitle(trans('dashboard.settings.timezone.timezone').' - '.trans('dashboard.dashboard'))
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

        return View::make('dashboard.settings.stylesheet')
            ->withPageTitle(trans('dashboard.settings.stylesheet.stylesheet').' - '.trans('dashboard.dashboard'))
            ->withSubMenu($this->subMenu);
    }

    /**
     * Updates the system settings.
     *
     * @return \Illuminate\View\View
     */
    public function postSettings()
    {
        $redirectUrl = Session::get('redirect_to', route('dashboard.settings.general'));

        if (Binput::get('remove_banner') === '1') {
            $setting = Setting::where('name', 'app_banner');
            $setting->delete();
        }

        if (Binput::hasFile('app_banner')) {
            $file = Binput::file('app_banner');

            // Image Validation.
            // Image size in bytes.
            $maxSize = $file->getMaxFilesize();

            if ($file->getSize() > $maxSize) {
                return Redirect::to($redirectUrl)->withErrors(trans('dashboard.settings.general.too-big', ['size' => $maxSize]));
            }

            if (!$file->isValid() || $file->getError()) {
                return Redirect::to($redirectUrl)->withErrors($file->getErrorMessage());
            }

            if (!starts_with($file->getMimeType(), 'image/')) {
                return Redirect::to($redirectUrl)->withErrors(trans('dashboard.settings.general.images-only'));
            }

            // Store the banner.
            Setting::firstOrCreate(['name' => 'app_banner'])->update(['value' => base64_encode(file_get_contents($file->getRealPath()))]);

            // Store the banner type
            Setting::firstOrCreate(['name' => 'app_banner_type'])->update(['value' => $file->getMimeType()]);
        }

        try {
            foreach (Binput::except(['app_banner', 'remove_banner']) as $settingName => $settingValue) {
                Setting::firstOrCreate(['name' => $settingName])->update(['value' => $settingValue]);
            }
        } catch (Exception $e) {
            return Redirect::to($redirectUrl)->withErrors(trans('dashboard.settings.edit.failure'));
        }

        if (Binput::has('app_locale')) {
            Lang::setLocale(Binput::get('app_locale'));
        }

        return Redirect::to($redirectUrl)->withSuccess(trans('dashboard.settings.edit.success'));
    }
}
