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
use Illuminate\Support\Facades\View;

class MergeRequestController extends Controller
{
    public function index($owner, $project)
    {
        $repository = $project->getRepository();

        $commitishPath = $repository->getHead();


        list($branch, $file) = $this->extractReference($repository, $commitishPath, $project->slug);

        return View::make('projects/merge_requests')
            ->withOwner($owner)
            ->withProject($project)
            ->withBranch($branch);
    }
}
