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
use Gitamin\Commands\Issue\UpdateIssueCommand;
use Gitamin\Http\Controllers\Controller;
use Gitamin\Models\Issue;
use Gitamin\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class IssuesController extends Controller
{
    protected $active_item = 'issues';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction($namespace, $project_path)
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

    public function newAction($namespace, $project_path)
    {
        $project = Project::findByPath($namespace, $project_path);

        return View::make('projects.issues.new')
            ->withProject($project)
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.issues.issues'), $project->name))
            ->withActiveItem($this->active_item);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAction($namespace, $project_path)
    {
        $project = Project::findByPath($namespace, $project_path);
        $issueData = Request::get('issue');

        try {
            $issueData['author_id'] = Auth::user()->id;
            $issueData['project_id'] = $project->id;
            $issue = $this->dispatchFromArray(AddIssueCommand::class, $issueData);
        } catch (ValidationException $e) {
            return Redirect::route('projects.issue_new')
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.issues.new.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('projects.issue_index', ['owner' => $namespace, 'project' => $project_path])
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.issues.new.success')));
    }

    public function editAction($owner_path, $project_path, Issue $issue)
    {
        $project = Project::findByPath($owner_path, $project_path);

        return View::make('projects.issues.edit')
            ->withProject($project)
            ->withIssue($issue)
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.issues.issues'), $project->name))
            ->withActiveItem($this->active_item);
    }

    public function updateAction($owner_path, $project_path, Issue $issue)
    {
        $project = Project::findByPath($owner_path, $project_path);
        $issueData = Request::get('issue');

        try {
            $issueData['author_id'] = Auth::user()->id;
            $issueData['project_id'] = $project->id;
            $issueData['issue'] = $issue;
            $issue = $this->dispatchFromArray(UpdateIssueCommand::class, $issueData);
        } catch (ValidationException $e) {
            return Redirect::route('projects.issue_edit', ['owner' => $owner_path, 'project' => $project_path, 'issue' => $issue->id])
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.issues.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        //Do nothing
        /*
        if ($issue->project) {
            $issue->project->update(['status' => Request::get('project_status')]);
        }
        */

        return Redirect::route('projects.issue_edit', ['owner' => $owner_path, 'project' => $project_path, 'issue' => $issue->id])
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.issues.edit.success')));
    }
}
