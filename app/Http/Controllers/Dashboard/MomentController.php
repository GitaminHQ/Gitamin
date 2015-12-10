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

class MomentController extends Controller
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
                'title'  => trans('dashboard.moments.all'),
                'url'    => route('dashboard.moments.index'),
                'icon'   => 'fa fa-sliders',
                'active' => false,
            ],
            'project_update' => [
                'title'  => trans('dashboard.moments.project_update'),
                'url'    => route('dashboard.moments.index'),
                'icon'   => 'fa fa-edit',
                'active' => false,
            ],
            'topic' => [
                'title'  => trans('dashboard.moments.topic'),
                'url'    => route('dashboard.moments.index'),
                'icon'   => 'fa fa-comment',
                'active' => false,
            ],
            'watched_project' => [
                'title'  => trans('dashboard.moments.watched_project'),
                'url'    => route('dashboard.moments.index'),
                'icon'   => 'fa fa-eye',
                'active' => false,
            ],
        ];

        View::share([
            'sub_menu'  => $this->subMenu,
            'sub_title' => trans_choice('dashboard.moments.moments', 2),
        ]);
    }

    public function index()
    {
        $moments = Moment::recent()->get();
        $this->subMenu['moments']['active'] = true;

        return View::make('dashboard.moments.index')
            ->withPageTitle('Moments')
            ->withMoments($moments)
            ->withSubMenu($this->subMenu);
    }
}
