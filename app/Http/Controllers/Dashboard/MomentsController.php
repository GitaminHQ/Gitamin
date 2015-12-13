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

class MomentsController extends Controller
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
     * Creates a new moment controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->subMenu = [
            'moments' => [
                'title'  => trans('dashboard.projects.yours'),
                'url'    => route('dashboard.moments.index'),
                'icon'   => 'fa fa-sliders',
                'active' => false,
            ],
            'project_update' => [
                'title'  => trans('dashboard.projects.starred'),
                'url'    => route('dashboard.moments.index'),
                'icon'   => 'fa fa-edit',
                'active' => false,
            ],
        ];

        View::share([
            'sub_menu'  => $this->subMenu,
            'sub_title' => trans_choice('dashboard.moments.moments', 2),
        ]);
    }

    public function indexAction()
    {
        $moments = Moment::recent()->get();
        $this->subMenu['moments']['active'] = true;

        return View::make('dashboard.moments.index')
            ->withPageTitle('Moments')
            ->withMoments($moments)
            ->withSubMenu($this->subMenu);
    }
}
