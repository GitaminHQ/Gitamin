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

use Gitamin\Models\Moment;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Array of sub-menu items.
     *
     * @var array
     */
    protected $subMenu = [];

    /**
     * Creates a new activity controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->subMenu = [
            'activity' => [
                'title'  => trans('dashboard.activity.all'),
                'url'    => route('dashboard.activity.index'),
                'icon'   => 'fa fa-sliders',
                'active' => false,
            ],
            'project_update' => [
                'title'  => trans('dashboard.activity.project_update'),
                'url'    => route('dashboard.activity.index'),
                'icon'   => 'fa fa-edit',
                'active' => false,
            ],
            'topic' => [
                'title'  => trans('dashboard.activity.topic'),
                'url'    => route('dashboard.activity.index'),
                'icon'   => 'fa fa-comment',
                'active' => false,
            ],
            'watched_project' => [
                'title'  => trans('dashboard.activity.watched_project'),
                'url'    => route('dashboard.activity.index'),
                'icon'   => 'fa fa-eye',
                'active' => false,
            ],
        ];

        View::share([
            'sub_menu'  => $this->subMenu,
            'sub_title' => trans_choice('dashboard.activity.activity', 2),
        ]);
    }

    public function index()
    {
        $activities = Moment::recent()->CodePush()->get();
        $this->subMenu['activity']['active'] = true;

        return View::make('dashboard.activity.index')
            ->withPageTitle('Activity')
            ->withActivities($activities)
            ->withSubMenu($this->subMenu);
    }
}
