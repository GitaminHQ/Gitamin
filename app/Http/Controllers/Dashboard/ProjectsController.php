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
use Gitamin\Commands\Project\AddProjectCommand;
use Gitamin\Commands\Project\RemoveProjectCommand;
use Gitamin\Commands\Project\UpdateProjectCommand;
use Gitamin\Models\Owner;
use Gitamin\Models\Project;
use Gitamin\Models\Tag;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ProjectsController extends Controller
{
    use DispatchesJobs;

    /**
     * Array of sub-menu items.
     *
     * @var array
     */
    protected $subMenu = [];

    /**
     * Creates a new project controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->subMenu = [
            'yours' => [
                'title'  => trans('dashboard.projects.yours'),
                'url'    => route('dashboard.projects.index'),
                'icon'   => 'fa fa-edit',
                'active' => false,
            ],
            'starred' => [
                'title'  => trans('dashboard.projects.starred'),
                'url'    => route('dashboard.projects.starred'),
                'icon'   => 'fa fa-umbrella',
                'active' => false,
            ],
            'explore' => [
                'title'  => trans('dashboard.projects.explore'),
                'url'    => route('explore.index'),
                'icon'   => 'fa fa-eye',
                'active' => false,
            ],
        ];

        View::share([
            'sub_menu'  => $this->subMenu,
            'sub_title' => trans_choice('dashboard.projects.projects', 2),
        ]);
    }

    /**
     * Shows the projects view.
     *
     * @return \Illuminate\View\View
     */
    public function indexAction()
    {
        $projects = Project::orderBy('created_at')->get();
        $this->subMenu['yours']['active'] = true;

        return View::make('dashboard.projects.index')
            ->withPageTitle(trans_choice('dashboard.projects.projects', 2).' - '.trans('dashboard.dashboard'))
            ->withProjects($projects)
            ->withSubMenu($this->subMenu);
    }

    /**
     * Shows the starred projects view.
     *
     * @return \Illuminate\View\View
     */
    public function starredAction()
    {
        $this->subMenu['starred']['active'] = true;
        $projects = Project::orderBy('created_at')->get();

        $this->subMenu['starred']['active'] = true;

        return View::make('dashboard.projects.index')
            ->withPageTitle(trans_choice('dashboard.projects.projects', 2).' - '.trans('dashboard.dashboard'))
            ->withProjects($projects)
            ->withSubMenu($this->subMenu);
    }
}
