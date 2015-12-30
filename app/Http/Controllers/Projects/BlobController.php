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

class BlobController extends Controller
{
    protected $active_item = 'project_show';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction($namespace, $project_path, $postfix)
    {
        $project = Project::findByPath($namespace, $project_path);

        $repository = $project->getRepository();

        list($branch, $file) = $repository->parseCommitishPathParam($postfix);
        list($branch, $file) = $repository->extractRef($branch, $file);

        $blob = $repository->getBlob("$branch:\"$file\"");
        $breadcrumbs = bread_crumbs($file);
        $fileType = 'text';

        return View::make('projects.blob.index')
            ->withProject($project)
            ->withBreadCrumbs($breadcrumbs)
            ->withWikis([])
            ->withBlob($blob->getContent())
            ->withFileType($fileType)
            ->withBranches($repository->getBranches())
            ->withCurrentBranch($branch)
            ->withActiveItem($this->active_item)
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.issues.issues'), $project->name));
    }
}
