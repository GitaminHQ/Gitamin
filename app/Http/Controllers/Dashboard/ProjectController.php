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
use Gitamin\Models\Project;
use Gitamin\Models\ProjectTeam;
use Gitamin\Models\Tag;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ProjectController extends Controller
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
    public function index()
    {
        $projects = Project::orderBy('created_at')->get();
        $this->subMenu['yours']['active'] = true;

        return View::make('dashboard.projects.index')
            ->withPageTitle(trans_choice('dashboard.projects.projects', 2).' - '.trans('dashboard.dashboard'))
            ->withProjects($projects)
            ->withSubMenu($this->subMenu);
    }

    public function starred()
    {

        $projects = Project::orderBy('created_at')->get();

        $this->subMenu['starred']['active'] = true;

        return View::make('dashboard.projects.index')
            ->withPageTitle(trans_choice('dashboard.projects.projects', 2).' - '.trans('dashboard.dashboard'))
            ->withProjects($projects)
            ->withSubMenu($this->subMenu);
    }

    /**
     * Shows the project view.
     *
     * @param \Gitamin\Models\Project $project
     *
     * @return \Illuminate\View\View
     */
    public function showProject(Project $project)
    {
        $teams = ProjectTeam::all();

        $pageTitle = sprintf('"%s" - %s - %s', $project->name, trans('dashboard.projects.edit.title'), trans('dashboard.dashboard'));

        return View::make('dashboard.projects.show')
            ->withPageTitle($pageTitle)
            ->withProject($project)
            ->withTeams($teams);
    }

    /**
     * Shows the edit project view.
     *
     * @param \Gitamin\Models\Project $project
     *
     * @return \Illuminate\View\View
     */
    public function showEditProject(Project $project)
    {
        $teams = ProjectTeam::all();

        $pageTitle = sprintf('"%s" - %s - %s', $project->name, trans('dashboard.projects.edit.title'), trans('dashboard.dashboard'));

        return View::make('dashboard.projects.edit')
            ->withPageTitle($pageTitle)
            ->withProject($project)
            ->withTeams($teams);
    }

    /**
     * Updates a project.
     *
     * @param \Gitamin\Models\Project $projects
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProjectAction(Project $project)
    {
        $projectData = Binput::get('project');
        $tags = array_pull($projectData, 'tags');

        try {
            $projectData['project'] = $project;
            $project = $this->dispatchFromArray(UpdateProjectCommand::class, $projectData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.projects.edit', ['id' => $project->id])
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.projects.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        // The project was added successfully, so now let's deal with the tags.
        $tags = preg_split('/ ?, ?/', $tags);

        // For every tag, do we need to create it?
        $projectTags = array_map(function ($taggable) use ($project) {
            return Tag::firstOrCreate(['name' => $taggable])->id;
        }, $tags);

        $project->tags()->sync($projectTags);

        return Redirect::route('dashboard.projects.edit', ['id' => $project->id])
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.projects.edit.success')));
    }

    /**
     * Shows the add project view.
     *
     * @return \Illuminate\View\View
     */
    public function showAddProject()
    {
        $teamId = (int) Binput::get('team_id');

        return View::make('dashboard.projects.add')
            ->withPageTitle(trans('dashboard.projects.add.title').' - '.trans('dashboard.dashboard'))
            ->withTeamId($teamId)
            ->withTeams(ProjectTeam::all());
    }

    /**
     * Creates a new project.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createProjectAction()
    {
        $projectData = Binput::get('project');
        $tags = array_pull($projectData, 'tags');

        try {
            $project = $this->dispatchFromArray(AddProjectCommand::class, $projectData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.projects.add')
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.projects.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        // The project was added successfully, so now let's deal with the tags.
        $tags = preg_split('/ ?, ?/', $tags);

        // For every tag, do we need to create it?
        $projectTags = array_map(function ($taggable) use ($project) {
            return Tag::firstOrCreate(['name' => $taggable])->id;
        }, $tags);

        $project->tags()->sync($projectTags);

        return Redirect::route('dashboard.projects.index')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.projects.add.success')));
    }

    /**
     * Deletes a given project.
     *
     * @param \Gitamin\Models\Project $project
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProjectAction(Project $project)
    {
        $this->dispatch(new RemoveProjectCommand($project));

        return Redirect::route('dashboard.projects.index')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.projects.delete.success')));
    }
}
