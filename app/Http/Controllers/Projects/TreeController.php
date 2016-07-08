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
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class TreeController extends Controller
{
    public function index($owner, $project)
    {
        return $this->tree($owner, $project);
    }

    public function tree($owner, $project, $commitishPath = '')
    {
        $repository = $project->getRepository();

        if (!$commitishPath) {
            $commitishPath = $repository->getHead();
        }

        list($branch, $tree) = $this->extractReference($repository, $commitishPath, $project->slug);

        $files = $repository->getTree($tree ? "$branch:\"$tree\"/" : $branch);
        $breadcrumbs = app('git_util')->getBreadcrumbs($tree);

        $parent = null;
        if (($slash = strrpos($tree, '/')) !== false) {
            $parent = substr($tree, 0, $slash);
        } elseif (!empty($tree)) {
            $parent = '';
        }

        $readme = ($parent === null) ? app('git_util')->getReadme($repository, $branch, $tree ? "$tree" : '') : '';

        return View::make('projects/tree')
            ->withfiles($files->output())
            ->withOwner($owner)
            ->withProject($project)
            ->withBranch($branch)
            ->withPath($tree ? $tree.'/' : $tree)
            ->withBreadcrumbs($breadcrumbs)
            ->withParent($parent)
            ->withBranches($repository->getBranches())
            ->withTags($repository->getTags())
            ->withReadme($readme);
    }

    public function search($owner, $project, $branch = '', $tree = '')
    {
        $repository = $project->getRepository();

        if (!$branch) {
            $branch = $repository->getHead();
        }

        $query = Input::get('query');
        $results = $repository->searchTree($query, $branch);

        return View::make('projects/search')
            ->withResults($results)
            ->withOwner($owner)
            ->withProject($project)
            ->withBranch($branch)
            ->withPath($tree)
            ->withBranches($repository->getBranches())
            ->withTags($repository->getTags())
            ->withQuery($query);
    }

    public function archive($owner, $project, $format, $branch)
    {
        $repository = $project->getRepository();

        $tree = $repository->getBranchTree($branch);

        if (false === $tree) {
            throw new HttpException(401);
        }

        $file = config('gitamin.cache_archives').DIRECTORY_SEPARATOR
                .$project.DIRECTORY_SEPARATOR
                .substr($tree, 0, 2).DIRECTORY_SEPARATOR
                .substr($tree, 2)
                .'.'
                .$format;

        if (!file_exists($file)) {
            $repository->createArchive($tree, $file, $format);
        }

        $filename = strtolower($project.'_'.$branch);
        $filename = preg_replace('#[^a-z0-9]+#', '_', $filename);
        $filename = $filename.'.'.$format;

        return Response::download($file, $filename);
    }
}
