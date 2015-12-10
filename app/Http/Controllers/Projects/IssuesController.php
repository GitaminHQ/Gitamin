<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers\Projects;

use Gitamin\Commands\Issue\AddIssueCommand;
use Gitamin\Http\Controllers\Controller;
use Gitamin\Models\Issue;
use Gitamin\Models\Project;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class IssuesController extends Controller
{
    protected $active_item = 'issues';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($namespace, $project_path)
    {
        $project = Project::findByPath($namespace, $project_path);

        return View::make('projects.issues.index')
            ->withProject($project)
            ->withIssues($project->issues)
            ->withActiveItem($this->active_item)
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.issues.issues'), $project->name));
    }

    public function showAction($owner_path, $project_path, $issue)
    {
        $project = Project::findByPath($owner_path, $project_path);

        return View::make('projects.issues.show')
            ->withProject($project)
            ->withIssue($issue)
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.issues.issues'), $project->name))
            ->withActiveItem($this->active_item);
    }

    public function add($namespace, $project_path)
    {
        $project = Project::findByPath($namespace, $project_path);

        return View::make('projects.issues.add')
            ->withProject($project)
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.issues.issues'), $project->name))
            ->withActiveItem($this->active_item);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($namespace, $project_path)
    {
        $project = Project::findByPath($namespace, $project_path);
        $issueData = Binput::get('issue');

        try {
            $issueData['author_id'] = Auth::user()->id;
            $issueData['project_id'] = $project->id;
            $issue = $this->dispatchFromArray(AddIssueCommand::class, $issueData);
        } catch (ValidationException $e) {
            return Redirect::route('projects.issue_new')
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.issues.new.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('projects.issue_index', ['namespace' => $namespace, 'project' => $project_path])
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.issues.new.success')));
    }
}
