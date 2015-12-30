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
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class CommitsController extends Controller
{
    protected $active_item = 'commits';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction($namespace, $project_path, $postfix)
    {
        $project = Project::findByPath($namespace, $project_path);
        $repository = $project->getRepository();

        if (! $postfix) {
            $postfix = $repository->getHead();
        }

        list($branch, $file) = $repository->parseCommitishPathParam($postfix);
        list($branch, $file) = $repository->extractRef($branch, $file);

        $blob = $repository->getBlob("$branch:\"$file\"");
        $breadcrumbs = bread_crumbs($file);

        $type = $file ? "$branch -- \"$file\"" : $branch;

        $pager = $this->getPager(Request::get('page'), $repository->getTotalCommits($type));

        $commits = $repository->getPaginatedCommits($type, $pager['current']);
        $categorized = [];
        foreach ($commits as $commit) {
            $date = $commit->getCommiterDate();
            $date = $date->format('Y-m-d');
            $categorized[$date][] = $commit;
        }

        return View::make('projects.commits.index')
            ->withBreadCrumbs($breadcrumbs)
            ->withProject($project)
            ->withWikis([])
            ->withCommits($categorized)
            ->withCurrentBranch('')
            ->withBranches([])
            ->withActiveItem($this->active_item)
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.issues.issues'), $project->name));
    }

    public function showAction($namespace, $project_path, $postfix)
    {
        $project = Project::findByPath($namespace, $project_path);
        $repository = $project->getRepository();

        $commit = $repository->getCommit($postfix);
        $branch = $repository->getHead();

        return View::make('projects.commits.show')
            ->withBreadCrumbs([])
            ->withBranches([])
            ->withCurrentBranch($branch)
            ->withCommit($commit)
            ->withProject($project)
            ->withActiveItem($this->active_item)
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.issues.issues'), $project->name));
    }

    protected function getPager($pageNumber, $totalCommits)
    {
        $pageNumber = (empty($pageNumber)) ? 0 : $pageNumber;
        $lastPage = intval($totalCommits / 15);
        // If total commits are integral multiple of 15, the lastPage will be commits/15 - 1.
        $lastPage = ($lastPage * 15 == $totalCommits) ? $lastPage - 1 : $lastPage;
        $nextPage = $pageNumber + 1;
        $previousPage = $pageNumber - 1;

        return ['current' => $pageNumber,
                     'next' => $nextPage,
                     'previous' => $previousPage,
                     'last' => $lastPage,
                     'total' => $totalCommits,
        ];
    }
}
