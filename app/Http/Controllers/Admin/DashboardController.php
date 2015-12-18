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

use Gitamin\Http\Requests\AdminRequest;
use Gitamin\Models\Project;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    /**
     * Creates a new settings controller instance.
     */
    public function __construct()
    {
        $this->subMenu = [
            'overview' => [
                'title' => 'Overview',
                'url' => route('admin.index'),
                'icon' => 'fa fa-wrench',
                'active' => false,
            ],
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
            'sub_title' => trans('admin.admin'),
            'sub_menu' => $this->subMenu,
        ]);
    }

    /**
     * Display the default view of dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction(AdminRequest $request)
    {
        $this->subMenu['overview']['active'] = true;

        Session::flash('redirect_to', $this->subMenu['general']['url']);

        $projects = Project::orderBy('created_at')->get();

        $projects = Project::get();
        $issues = [];
        $subscribers = [];

        return View::make('admin.index')
            ->withPageTitle(trans('admin.admin'))
            ->withProjects($projects)
            ->withIssues($issues)
            ->withSubscribers($subscribers)
            ->withSubMenu($this->subMenu);
    }
}
