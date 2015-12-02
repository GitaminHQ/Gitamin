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
use Gitamin\Commands\ProjectNamespace\AddProjectNamespaceCommand;
use Gitamin\Commands\ProjectNamespace\RemoveProjectNamespaceCommand;
use Gitamin\Commands\ProjectNamespace\UpdateProjectNamespaceCommand;
use Gitamin\Http\Controllers\Controller;
use Gitamin\Models\Project;
use Gitamin\Models\Group;
use Gitamin\Models\Tag;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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
     *
     * @return void
     */
    public function __construct()
    {
        $this->subMenu = [
            'yours'   => [
                'title'  => trans_choice('gitamin.groups.yours', 2),
                'url'    => route('dashboard.groups.index'),
                'icon'   => 'fa fa-folder',
                'active' => false,
            ],
            'explore' => [
                'title'  => trans('gitamin.groups.explore'),
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
     * Shows the project group view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->subMenu['yours']['active'] = true;

        return View::make('dashboard.groups.index')
            ->withPageTitle(trans_choice('gitamin.groups.groups', 2).' - '.trans('dashboard.dashboard'))
            ->withGroups(Group::where('type', '=', 'group')->get())
            ->withSubMenu($this->subMenu);
    }
}
