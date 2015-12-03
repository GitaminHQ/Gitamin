<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers;

use AltThree\Validator\ValidationException;
use Gitamin\Commands\ProjectNamespace\AddProjectNamespaceCommand;
use Gitamin\Commands\ProjectNamespace\RemoveProjectNamespaceCommand;
use Gitamin\Commands\ProjectNamespace\UpdateProjectNamespaceCommand;
use Gitamin\Models\Project;
use Gitamin\Models\ProjectNamespace;
use Gitamin\Models\Group;
use Gitamin\Models\Tag;
use Gitamin\Http\Controllers\Controller;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
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
            'projects' => [
                'title'  => trans('dashboard.projects.projects'),
                'url'    => route('dashboard.projects.index'),
                'icon'   => 'fa fa-sitemap',
                'active' => false,
            ], 
            'groups'   => [
                'title'  => trans_choice('gitamin.groups.groups', 2),
                'url'    => route('dashboard.groups.index'),
                'icon'   => 'fa fa-folder',
                'active' => false,
            ],
            'labels' => [
                'title'  => trans_choice('dashboard.projects.labels.labels', 2),
                'url'    => route('dashboard.projects.index'),
                'icon'   => 'fa fa-tags',
                'active' => false,
            ],
        ];

        View::share([
            'sub_menu'  => $this->subMenu,
            'sub_title' => trans_choice('dashboard.projects.projects', 2),
        ]);
    }

    /**
     * Shows the project teams view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->subMenu['groups']['active'] = true;

        return View::make('groups.index')
            ->withPageTitle(trans_choice('gitamin.groups.groups', 2).' - '.trans('dashboard.dashboard'))
            ->withGroups(Group::get())
            ->withSubMenu($this->subMenu);
    }

    public function show($namespace)
    {
        $group = Group::where('path', '=', $namespace)->first();
        return View::make('groups.show')
            ->withGroup($group);
    }

    /**
     * Shows the add project view.
     *
     * @return \Illuminate\View\View
     */
    public function new()
    {
        return View::make('groups.new')
            ->withPageTitle(trans('dashboard.groups.add.title').' - '.trans('dashboard.dashboard'));
            //->withGroups(ProjectNamespace::all());
    }

    
    /**
     * Creates a new project.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $groupData = Binput::get('group');
        $groupData['type'] = 'group';
        $groupData['owner_id'] = Auth::user()->id;
        try {
            $group = $this->dispatchFromArray(AddProjectNamespaceCommand::class, $groupData);
        } catch (ValidationException $e) {
            return Redirect::route('groups.new')
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.teams.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('groups.index')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.teams.add.success')));
    }

    /**
     * Shows the edit project team view.
     *
     * @param \Gitamin\Models\ProjectTeam $team
     *
     * @return \Illuminate\View\View
     */
    public function edit($namespace)
    {
        $group = Group::where('path', '=', $namespace)->first();

        return View::make('groups.edit')
            ->withPageTitle(trans('dashboard.teams.edit.title').' - '.trans('dashboard.dashboard'))
            ->withGroup($group);
    }

   

    /**
     * Updates a project team.
     *
     * @param \Gitamin\Models\ProjectTeam $team
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($namespace)
    {
        $groupData = Binput::get('group');
        $group = ProjectNamespace::where('path', '=', $namespace)->first();
        try {
            $groupData['project_namespace'] = $group;
            $groupData['owner_id'] = Auth::user()->id;
            $group = $this->dispatchFromArray(UpdateProjectNamespaceCommand::class, $groupData);
        } catch (ValidationException $e) {
            return Redirect::route('groups.group_edit', ['namespace' => $group->path])
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('gitamin.groups.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('groups.group_edit', ['namespace' => $group->path])
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('gitamin.groups.edit.success')));
    }
}
