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
use Gitamin\Commands\Owner\AddOwnerCommand;
use Gitamin\Commands\Owner\UpdateOwnerCommand;
use Gitamin\Models\Group;
use Gitamin\Models\Owner;
use Gitamin\Models\Project;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
            'projects' => [
                'title' => trans('dashboard.projects.projects'),
                'url' => route('dashboard.projects.index'),
                'icon' => 'fa fa-sitemap',
                'active' => false,
            ],
            'groups' => [
                'title' => trans_choice('gitamin.groups.groups', 2),
                'url' => route('dashboard.groups.index'),
                'icon' => 'fa fa-folder',
                'active' => false,
            ],
            'labels' => [
                'title' => trans_choice('dashboard.projects.labels.labels', 2),
                'url' => route('dashboard.projects.index'),
                'icon' => 'fa fa-tags',
                'active' => false,
            ],
        ];

        View::share([
            'sub_menu' => $this->subMenu,
            'sub_title' => trans_choice('dashboard.projects.projects', 2),
        ]);
    }

    /**
     * Shows the project teams view.
     *
     * @return \Illuminate\View\View
     */
    public function indexAction()
    {
        $this->subMenu['groups']['active'] = true;

        return View::make('groups.index')
            ->withPageTitle(trans_choice('gitamin.groups.groups', 2).' - '.trans('dashboard.dashboard'))
            ->withGroups(Group::get())
            ->withSubMenu($this->subMenu);
    }

    /**
     * Shows the group view.
     *
     * @return \Illuminate\View\View
     */
    public function showAction($path)
    {
        $group = Group::findByPath($path);

        return View::make('groups.show')
            ->withPageTitle($group->name)
            ->withGroup($group);
    }

    /**
     * Shows the new project view.
     *
     * @return \Illuminate\View\View
     */
    public function newAction()
    {
        return View::make('groups.new')
            ->withPageTitle(trans('dashboard.groups.new.title').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Creates a new project.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAction()
    {
        $groupData = Binput::get('group');
        $groupData['type'] = 'group';
        $groupData['user_id'] = Auth::user()->id;
        try {
            $group = $this->dispatchFromArray(AddOwnerCommand::class, $groupData);
        } catch (ValidationException $e) {
            return Redirect::route('groups.new')
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.teams.add.failure')))
                ->withErrors($e->getMessageBag());
        } catch (QueryException $e) {
            return Redirect::route('groups.new')
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.teams.add.failure')))
                ->withErrors('Path has been used');
        }

        return Redirect::route('dashboard.groups.index')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.teams.add.success')));
    }

    /**
     * Shows the edit project namespace view.
     *
     * @param \Gitamin\Models\Owner $namespace
     *
     * @return \Illuminate\View\View
     */
    public function editAction($path)
    {
        $group = Group::findByPath($path);

        return View::make('groups.edit')
            ->withPageTitle(trans('dashboard.teams.edit.title').' - '.trans('dashboard.dashboard'))
            ->withGroup($group);
    }

    /**
     * Updates a project namespace.
     *
     * @param \Gitamin\Models\Owner $namespace
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAction($path)
    {
        $groupData = Binput::get('group');
        $group = Owner::where('path', '=', $path)->first();
        try {
            $groupData['owner'] = $group;
            $groupData['user_id'] = Auth::user()->id;
            $group = $this->dispatchFromArray(UpdateOwnerCommand::class, $groupData);
        } catch (ValidationException $e) {
            return Redirect::route('groups.group_edit', ['owner' => $group->path])
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('gitamin.groups.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('groups.group_edit', ['owner' => $group->path])
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('gitamin.groups.edit.success')));
    }
}
