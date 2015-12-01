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
use Gitamin\Commands\ProjectTeam\AddProjectTeamCommand;
use Gitamin\Commands\ProjectTeam\RemoveProjectTeamCommand;
use Gitamin\Commands\ProjectTeam\UpdateProjectTeamCommand;
use Gitamin\Models\Project;
use Gitamin\Models\ProjectTeam;
use Gitamin\Models\Tag;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TeamController extends Controller
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
            'projects' => [
                'title'  => trans('dashboard.projects.projects'),
                'url'    => route('dashboard.projects.index'),
                'icon'   => 'fa fa-sitemap',
                'active' => false,
            ], /*
            'my' => [
                'title'  => trans('dashboard.projects.my'),
                'url'    => route('dashboard.projects.index'),
                'icon'   => 'fa fa-edit',
                'active' => false,
            ],
            'joined' => [
                'title'  => trans('dashboard.projects.joined'),
                'url'    => route('dashboard.projects.index'),
                'icon'   => 'fa fa-umbrella',
                'active' => false,
            ],
            'watched' => [
                'title'  => trans('dashboard.projects.watched'),
                'url'    => route('dashboard.projects.index'),
                'icon'   => 'fa fa-eye',
                'active' => false,
            ],
            '<hr>'    => [],*/
            'teams'   => [
                'title'  => trans_choice('dashboard.teams.teams', 2),
                'url'    => route('dashboard.teams.index'),
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
     * Shows the projects view.
     *
     * @return \Illuminate\View\View
     */
    public function showProjects()
    {
        $projects = Project::orderBy('order')->orderBy('created_at')->get();

        $this->subMenu['projects']['active'] = true;

        return View::make('dashboard.projects.index')
            ->withPageTitle(trans_choice('dashboard.projects.projects', 2).' - '.trans('dashboard.dashboard'))
            ->withProjects($projects)
            ->withSubMenu($this->subMenu);
    }

    /**
     * Shows the project teams view.
     *
     * @return \Illuminate\View\View
     */
    public function showProjectTeams()
    {
        $this->subMenu['teams']['active'] = true;

        return View::make('dashboard.teams.index')
            ->withPageTitle(trans_choice('dashboard.teams.teams', 2).' - '.trans('dashboard.dashboard'))
            ->withTeams(ProjectTeam::orderBy('order')->get())
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
     * Shows the project team view.
     *
     * @param \Gitamin\Models\ProjectTeam $team
     *
     * @return \Illuminate\View\View
     */
    public function showProjectTeam($slug)
    {
        $team = ProjectTeam::where('slug', '=', $slug)->first();

        if (!$team) {
            throw new BadRequestHttpException();
        }

        return View::make('dashboard.teams.show')
            ->withTeam($team);
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

    /**
     * Deletes a given project team.
     *
     * @param \Gitamin\Models\ProjectTeam $team
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProjectTeamAction(ProjectTeam $team)
    {
        $this->dispatch(new RemoveProjectTeamCommand($team));

        return Redirect::route('dashboard.projects.index')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.projects.delete.success')));
    }

    /**
     * Shows the add project team view.
     *
     * @return \Illuminate\View\View
     */
    public function showAddProjectTeam()
    {
        return View::make('dashboard.teams.add')
            ->withPageTitle(trans('dashboard.teams.add.title').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Shows the edit project team view.
     *
     * @param \Gitamin\Models\ProjectTeam $team
     *
     * @return \Illuminate\View\View
     */
    public function showEditProjectTeam(ProjectTeam $team)
    {
        return View::make('dashboard.teams.edit')
            ->withPageTitle(trans('dashboard.teams.edit.title').' - '.trans('dashboard.dashboard'))
            ->withTeam($team);
    }

    /**
     * Creates a new project.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddProjectTeam()
    {
        try {
            $team = $this->dispatch(new AddProjectTeamCommand(
                Binput::get('name'),
                Binput::get('slug'),
                Binput::get('order', 0)
            ));
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.teams.add')
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.teams.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.teams')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.teams.add.success')));
    }

    /**
     * Updates a project team.
     *
     * @param \Gitamin\Models\ProjectTeam $team
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProjectTeamAction(ProjectTeam $team)
    {
        try {
            $team = $this->dispatch(new UpdateProjectTeamCommand(
                $team,
                Binput::get('name'),
                Binput::get('slug'),
                Binput::get('order', 0)
            ));
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.teams.edit', ['id' => $team->id])
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.teams.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.teams.edit', ['id' => $team->id])
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.teams.edit.success')));
    }
}
