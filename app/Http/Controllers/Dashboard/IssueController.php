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

use AltThree\Validator\ValidationException;
use Gitamin\Commands\Issue\AddIssueCommand;
use Gitamin\Commands\Issue\RemoveIssueCommand;
use Gitamin\Commands\Issue\UpdateIssueCommand;
use Gitamin\Models\Group;
use Gitamin\Models\Issue;
use Gitamin\Models\Project;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class IssueController extends Controller
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
            'issues' => [
                'title'  => trans('dashboard.issues.all'),
                'url'    => route('dashboard.issues.index'),
                'icon'   => 'fa fa-exclamation-circle',
                'active' => true,
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
