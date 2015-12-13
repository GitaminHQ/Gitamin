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

use Gitamin\Models\Issue;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class IssuesController extends Controller
{
    use DispatchesJobs;

    /**
     * Stores the sub-sidebar tree list.
     *
     * @var array
     */
    protected $subMenu = [];

    /**
     * Creates a new issue controller instance.
     *
     * @return \Gitamin\Http\Controllers\IssueController
     */
    public function __construct()
    {
        $this->subMenu = [
            'open' => [
                'title'  => trans('dashboard.issues.open'),
                'url'    => route('dashboard.issues.index'),
                'icon'   => 'fa fa-eye',
                'active' => true,
            ],
            'closed' => [
                'title'  => trans('dashboard.issues.closed'),
                'url'    => route('dashboard.issues.index'),
                'icon'   => 'fa fa-check-circle',
                'active' => false,
            ],
            'all' => [
                'title'  => trans('dashboard.issues.all'),
                'url'    => route('dashboard.issues.index'),
                'icon'   => 'fa fa-exclamation-circle',
                'active' => false,
            ],
        ];

        View::share('sub_menu', $this->subMenu);
        View::share('sub_title', trans('dashboard.issues.title'));
    }

    /**
     * Shows the issues view.
     *
     * @return \Illuminate\View\View
     */
    public function indexAction()
    {
        $issues = Issue::orderBy('created_at', 'desc')->get();

        return View::make('dashboard.issues.index')
            ->withPageTitle(trans('dashboard.issues.issues').' - '.trans('dashboard.dashboard'))
            ->withIssues($issues);
    }
}
