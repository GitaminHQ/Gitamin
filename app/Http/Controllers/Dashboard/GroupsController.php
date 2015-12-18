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

use Gitamin\Http\Controllers\Controller;
use Gitamin\Models\Group;
use Gitamin\Models\Project;
use Illuminate\Support\Facades\View;

class GroupsController extends Controller
{
    /**
     * Array of sub-menu items.
     *
     * @var array
     */
    protected $subMenu = [];

    /**
     * Creates a new project controller instance.
     */
    public function __construct()
    {
        $this->subMenu = [
            'yours' => [
                'title' => trans_choice('gitamin.groups.yours', 2),
                'url' => route('dashboard.groups.index'),
                'icon' => 'fa fa-folder',
                'active' => false,
            ],
            'explore' => [
                'title' => trans('gitamin.groups.explore'),
                'url' => route('explore.groups'),
                'icon' => 'fa fa-eye',
                'active' => false,
            ],
        ];

        View::share([
            'sub_menu' => $this->subMenu,
            'sub_title' => trans_choice('dashboard.groups.groups', 2),
        ]);
    }

    /**
     * Shows the project group view.
     *
     * @return \Illuminate\View\View
     */
    public function indexAction()
    {
        $this->subMenu['yours']['active'] = true;

        return View::make('dashboard.groups.index')
            ->withPageTitle(trans_choice('gitamin.groups.groups', 2).' - '.trans('dashboard.dashboard'))
            ->withGroups(Group::all())
            ->withSubMenu($this->subMenu);
    }
}
