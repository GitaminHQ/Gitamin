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
use Gitamin\Models\Project;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;
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
                'title' => trans('dashboard.issues.open'),
                'url' => route('dashboard.issues.index', ['state' => 'opened']),
                'icon' => 'fa fa-eye',
                'active' => true,
            ],
            'closed' => [
                'title' => trans('dashboard.issues.closed'),
                'url' => route('dashboard.issues.index', ['state' => 'closed']),
                'icon' => 'fa fa-check-circle',
                'active' => false,
            ],
            'all' => [
                'title' => trans('dashboard.issues.all'),
                'url' => route('dashboard.issues.index', ['state' => 'all']),
                'icon' => 'fa fa-exclamation-circle',
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
        $state = Request::get('state');
        // Issue & Issue Project list.
        $usedIssueProjects = Issue::where('project_id', '>', 0)->where('state', '=', $state)->groupBy('project_id')->lists('project_id');
        $issueProjects = Project::whereIn('id', $usedIssueProjects)->get();

        return View::make('dashboard.issues.index')
            ->withIssueProjects($issueProjects)
            ->withPageTitle(trans('dashboard.issues.issues').' - '.trans('dashboard.dashboard'));
    }
}
