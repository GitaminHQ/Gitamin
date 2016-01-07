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

class StatsController extends Controller
{
    protected $active_item = 'stats';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction($namespace, $project_path, $postifx = null)
    {
        $project = Project::findByPath($namespace, $project_path);
        $repository = $project->getRepository();

        return View::make('projects.stats.index')
            ->withProject($project)
            ->withWikis([])
            ->withCurrentBranch($repository->getCurrentBranch())
            ->withBranches($repository->getBranches())
            ->withBreadCrumbs([])
            ->withActiveItem($this->active_item)
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.issues.issues'), $project->name));
    }
}
