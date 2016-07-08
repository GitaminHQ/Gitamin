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

class BlameController extends Controller
{
    public function show($owner, $project, $commitishPath)
    {
        $repository = $project->getRepository();

        list($branch, $file) = $this->extractReference($repository, $commitishPath, $project->slug);

        $blames = $repository->getBlame("$branch -- \"$file\"");

        return View::make('projects/blame')
            ->withFile($file)
            ->withOwner($owner)
            ->withProject($project)
            ->withBranch($branch)
            ->withBranches($repository->getBranches())
            ->withTags($repository->getTags())
            ->withFile($file)
            ->withBlames($blames);
    }
}
