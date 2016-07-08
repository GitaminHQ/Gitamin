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
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class RssController extends Controller
{
    public function show($owner, $project, $branch)
    {
        $repository = $project->getRepository();

        if ($branch === null) {
            $branch = $repository->getHead();
        }

        $commits = $repository->getPaginatedCommits($branch);

        return Response::make(View::make('projects/rss')
                              ->withProject($project)
                              ->withBranch($branch)
                              ->withCommits($commits),
                              200,
                              ['Content-Type' => 'application/rss+xml']
        );
    }
}
