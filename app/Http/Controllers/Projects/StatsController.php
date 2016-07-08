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

class StatsController extends Controller
{
    public function show($owner, $project, $branch)
    {
        $repository = $project->getRepository();

        if ($branch === null) {
            $branch = $repository->getHead();
        }

        $stats = $repository->getStatistics($branch);
        $authors = $repository->getAuthorStatistics($branch);

        return View::make('projects/stats')
            ->withOwner($owner)
            ->withProject($project)
            ->withBranch($branch)
            ->withBranches($repository->getBranches())
            ->withTags($repository->getTags())
            ->withStats($stats)
            ->withAuthors($authors);
    }
}
