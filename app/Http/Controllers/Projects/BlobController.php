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

        list($branch, $file) = $this->parseCommitishPathParam($postfix, $repository);
        list($branch, $file) = $this->extractRef($repository, $branch, $file);

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

    protected function parseCommitishPathParam($commitishPath, $repository)
    {
        $commitish = null;
        $path = null;

        $slashPosition = strpos($commitishPath, '/');
        if (strlen($commitishPath) >= 40 &&
            ($slashPosition === false ||
             $slashPosition === 40)) {
            // We may have a commit hash as our commitish.
            $hash = substr($commitishPath, 0, 40);
            if ($repository->hasCommit($hash)) {
                $commitish = $hash;
            }
        }

        if ($commitish === null) {
            $branches = $repository->getBranches();

            $tags = $repository->getTags();
            if ($tags !== null && count($tags) > 0) {
                $branches = array_merge($branches, $tags);
            }

            $matchedBranch = null;
            $matchedBranchLength = 0;
            foreach ($branches as $branch) {
                if (strpos($commitishPath, $branch) === 0 &&
                    strlen($branch) > $matchedBranchLength) {
                    $matchedBranch = $branch;
                    $matchedBranchLength = strlen($matchedBranch);
                }
            }

            if ($matchedBranch !== null) {
                $commitish = $matchedBranch;
            } else {
                // We may have partial commit hash as our commitish.
                $hash = $slashPosition === false ? $commitishPath : substr($commitishPath, 0, $slashPosition);
                if ($repository->hasCommit($hash)) {
                    $commit = $repository->getCommit($hash);
                    $commitish = $commit->getHash();
                } else {
                    throw new EmptyRepositoryException('This repository is currently empty. There are no commits.');
                }
            }
        }

        $commitishLength = strlen($commitish);
        $path = substr($commitishPath, $commitishLength);
        if (strpos($path, '/') === 0) {
            $path = substr($path, 1);
        }

        return [$commitish, $path];
    }

    public function extractRef($repository, $branch = '', $tree = '')
    {
        $branch = trim($branch, '/');
        $tree = trim($tree, '/');
        $input = $branch.'/'.$tree;

        // If the ref appears to be a SHA, just split the string
        if (preg_match('/^([[:alnum:]]{40})(.+)/', $input, $matches)) {
            $branch = $matches[1];
        } else {
            // Otherwise, attempt to detect the ref using a list of the project's branches and tags
            $validRefs = array_merge((array) $repository->getBranches(), (array) $repository->getTags());
            foreach ($validRefs as $key => $ref) {
                if (! preg_match(sprintf('#^%s/#', preg_quote($ref, '#')), $input)) {
                    unset($validRefs[$key]);
                }
            }

            // No exact ref match, so just try our best
            if (count($validRefs) > 1) {
                preg_match('/([^\/]+)(.*)/', $input, $matches);
                $branch = preg_replace('/^\/|\/$/', '', $matches[1]);
            } else {
                // Extract branch name
                $branch = array_shift($validRefs);
            }
        }

        return [$branch, $tree];
    }
}
