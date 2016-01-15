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

use Gitamin\Http\Controllers\Controller;
use Gitamin\Models\Project;
use Illuminate\Support\Facades\View;

class PullRequestsController extends Controller
{
    protected $active_item = 'pulls';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction($owner_path, $project_path)
    {
        $project = Project::findByPath($owner_path, $project_path);
        $repository = $project->getRepository();

        return View::make('projects.pulls.index')
            ->withProject($project)
            ->withPullRequests([])
            ->withActiveItem($this->active_item)
            ->withBreadCrumbs([])
            ->withCurrentBranch($repository->getCurrentBranch())
            ->withBranches($repository->getBranches())
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.pull_requests.pull_requests'), $project->name));
    }
}
