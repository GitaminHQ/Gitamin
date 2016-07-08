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

class BlobController extends Controller
{
    public function index($owner, $project, $commitishPath)
    {
        $repository = $project->getRepository();

        list($branch, $file) = $this->extractReference($repository, $commitishPath, $project->slug);

        $blob = $repository->getBlob("$branch:\"$file\"");
        $breadcrumbs = app('git_util')->getBreadcrumbs($file);
        $fileType = app('git_util')->getFileType($file);
        if ($fileType !== 'image' && app('git_util')->isBinary($file)) {
            return redirect::route('blob_raw', [
                'owner'         => $owner,
                'project'       => $project,
                'commitishPath' => $commitishPath,
            ]);
        }

        return View::make('projects/file')
            ->withOwner($owner)
            ->withProject($project)
            ->withFile($file)
            ->withFileType($fileType)
            ->withBlob($blob->output())
            ->withBranch($branch)
            ->withBreadcrumbs($breadcrumbs)
            ->withBranches($repository->getBranches())
            ->withTags($repository->getTags());
    }

    public function raw($owner, $project, $commitishPath)
    {
        $repository = $project->getRepository();

        list($branch, $file) = $this->parseCommitishPathParam($repository, $commitishPath, $project);

        list($branch, $file) = $this->extractRef($repository, $branch, $file);

        $blob = $repository->getBlob("$branch:\"$file\"")->output();

        $headers = [];
        if (app('git_util')->isBinary($file)) {
            $headers['Content-Disposition'] = 'attachment; filename="'.$file.'"';
            $headers['Content-Type'] = 'application/octet-stream';
        } else {
            $headers['Content-Type'] = 'text/plain';
        }

        return Response::make($blob, 200, $headers);
    }
}
