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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class CommitController extends Controller
{
    public function index($owner, $project, $commitishPath)
    {
        $repository = $project->getRepository();

        if (!$commitishPath) {
            $commitishPath = $repository->getHead();
        }

        list($branch, $file) = $this->extractReference($repository, $commitishPath, $project->slug);

        $type = $file ? "$branch -- \"$file\"" : $branch;
        $pager = $this->getPager(Input::get('page'), $repository->getTotalCommits($type));
        $commits = $repository->getPaginatedCommits($type, $pager['current']);
        $categorized = [];

        foreach ($commits as $commit) {
            $date = $commit->getCommiterDate();
            $date = $date->format('Y-m-d');
            $categorized[$date][] = $commit;
        }

        $template = (Request::ajax()) ? 'commits_list' : 'commits';

        return View::make('projects/'.$template)
            ->withPage('commits')
            ->withPager($pager)
            ->withOwner($owner)
            ->withProject($project)
            ->withBranch($branch)
            ->withBranches($repository->getBranches())
            ->withTags($repository->getTags())
            ->withFile($file)
            ->withCommits($categorized);
    }

    public function show($owner, $project, $commit)
    {
        $repository = $project->getRepository();
        $commit = $repository->getCommit($commit);
        $branch = $repository->getHead();

        return View::make('projects/commit')
            ->withOwner($owner)
            ->withProject($project)
            ->withCommit($commit)
            ->withBranch($branch);
    }
}
