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

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $repositories = app('git')->getRepositories($this->repositories);

        return View::make('index')
            ->withRepositories($repositories);
    }

    public function refresh()
    {
        return Redirect::back();
    }

    public function stats($owner, $project, $branch)
    {
        $repository = app('git')->getRepositoryFromName($this->repositories, $project);

        if ($branch === null) {
            $branch = $repository->getHead();
        }

        $stats = $repository->getStatistics($branch);
        $authors = $repository->getAuthorStatistics($branch);

        return View::make('stats')
            ->withProject($project)
              ->withBranch($branch)
              ->withBranches($repository->getBranches())
               ->withTags($repository->getTags())
            ->withStats($stats)
            ->withAuthors($authors);
    }

    public function rss($owner, $project, $branch)
    {
        $repository = app('git')->getRepositoryFromName($this->repositories, $project);

        if ($branch === null) {
            $branch = $repository->getHead();
        }

        $commits = $repository->getPaginatedCommits($branch);

        return Response::make(View::make('rss')
                              ->withProject($project)
                              ->withBranch($branch)
                              ->withCommits($commits),
                              200,
                              ['Content-Type' => 'application/rss+xml']
        );
    }
}
