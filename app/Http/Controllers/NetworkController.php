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

class NetworkController extends Controller
{
    public function index($owner, $project, $commitishPath)
    {
        $repository = app('git')->getRepositoryFromName($this->repositories, $project);

        if ($commitishPath === null) {
            $commitishPath = $repository->getHead();
        }

        list($branch, $file) = $this->parseCommitishPathParam($commitishPath, $project);
        list($branch, $file) = $this->extractRef($repository, $branch, $file);

        return View::make('network')
            ->withProject($project)
            ->withBranch($branch)
            ->withCommitishPath($commitishPath);
    }

    public function data($owner, $project, $commitishPath, $page)
    {
        $repository = app('git')->getRepositoryFromName($this->repositories, $project);

        if ($commitishPath === null) {
            $commitishPath = $repository->getHead();
        }

        $pager = $this->getPager($page, $repository->getTotalCommits($commitishPath));
        $commits = $repository->getPaginatedCommits($commitishPath, $pager['current']);

        $jsonFormattedCommits = [];

        foreach ($commits as $commit) {
            $detailsUrl = route('commit', [
                'project' => $project,
                'commit'  => $commit->getHash(),
            ]);

            $jsonFormattedCommits[$commit->getHash()] = [
                'hash'        => $commit->getHash(),
                'parentsHash' => $commit->getParentsHash(),
                'date'        => $commit->getDate()->format('U'),
                'message'     => htmlentities($commit->getMessage()),
                'details'     => $detailsUrl,
                'author'      => [
                    'name'  => $commit->getAuthor()->getName(),
                    'email' => $commit->getAuthor()->getEmail(),
                    'image' => $commit->getAuthor()->getEmail(),
                ],
            ];
        }

        $nextPageUrl = null;

        if ($pager['last'] !== $pager['current']) {
            $nextPageUrl = route(
                'networkData',
                [
                    'project'       => $project,
                    'commitishPath' => $commitishPath,
                    'page'          => $pager['next'],
                ]
            );
        }

        // when no commits are given, return an empty response - issue #369
        if (count($commits) === 0) {
            return Response::json(
                [
                    'project'       => $project,
                    'commitishPath' => $commitishPath,
                    'nextPage'      => null,
                    'start'         => null,
                    'commits'       => $jsonFormattedCommits,
                    ], 200
                );
        }


        return Response::json([
            'project'       => $project,
            'commitishPath' => $commitishPath,
            'nextPage'      => $nextPageUrl,
            'start'         => $commits[0]->getHash(),
            'commits'       => $jsonFormattedCommits,
            ], 200
        );
    }
}
