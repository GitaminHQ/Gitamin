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

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


    protected $repositories;

    public function __construct()
    {
        $this->repositories = config('gitamin.repositories');
    }

    public function getPager($pageNumber, $totalCommits)
    {
        $pageNumber = (empty($pageNumber)) ? 0 : $pageNumber;
        $lastPage = intval($totalCommits / 15);

        // If total commits are integral multiple of 15, the lastPage will be commits/15 - 1.
        $lastPage = ($lastPage * 15 == $totalCommits) ? $lastPage - 1 : $lastPage;
        $nextPage = $pageNumber + 1;
        $previousPage = $pageNumber - 1;

        return ['current'       => $pageNumber,
                     'next'     => $nextPage,
                     'previous' => $previousPage,
                     'last'     => $lastPage,
                     'total'    => $totalCommits,
        ];
    }

    protected function extractReference($repository, $commitishPath, $repo)
    {
        list($commitish, $path) = $this->parseCommitishPathParam($repository, $commitishPath, $repo);

        return $this->parseBranchTreeParam($repository, $commitish, $path);
    }

    /**
     * Returns an Array where the first value is the tree-ish and the second is the path.
     *
     * @param \GitList\Git\Repository $repository
     * @param string                  $branch
     * @param string                  $tree
     *
     * @return array
     */
    protected function parseBranchTreeParam($repository, $branch = '', $tree = '')
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
                if (!preg_match(sprintf('#^%s/#', preg_quote($ref, '#')), $input)) {
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

     /* @brief Return $commitish, $path parsed from $commitishPath, based on
     * what's in $repo. Raise a 404 if $branchpath does not represent a
     * valid branch and path.
     *
     * A helper for parsing routes that use commit-ish names and paths
     * separated by /, since route regexes are not enough to get that right.
     *
     * @param string $commitishPath
     * @param string $repo
     * @return array
     */
    protected function parseCommitishPathParam($repository, $commitishPath, $repo)
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
                    throw new \Exception('This repository is currently empty. There are no commits.');
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
}
