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

class TreeGraphController extends Controller
{
    public function index($owner, $project, $commitishPath)
    {
        /** @var \GitList\Git\Repository $repository */
        $repository = $project->getRepository();

        $command = 'log --graph --date-order --all -C -M -n 100 --date=iso '.
            '--pretty=format:"B[%d] C[%H] D[%ad] A[%an] E[%ae] H[%h] S[%s]"';
        $rawRows = $repository->getClient()->run($repository, $command);
        $rawRows = explode("\n", $rawRows);
        $graphItems = [];

        foreach ($rawRows as $row) {
            if (preg_match("/^(.+?)(\s(B\[(.*?)\])? C\[(.+?)\] D\[(.+?)\] A\[(.+?)\] E\[(.+?)\] H\[(.+?)\] S\[(.+?)\])?$/", $row, $output)) {
                if (!isset($output[4])) {
                    $graphItems[] = [
                        'relation' => $output[1],
                    ];
                    continue;
                }
                $graphItems[] = [
                    'relation'     => $output[1],
                    'branch'       => $output[4],
                    'rev'          => $output[5],
                    'date'         => $output[6],
                    'author'       => $output[7],
                    'author_email' => $output[8],
                    'short_rev'    => $output[9],
                    'subject'      => preg_replace('/(^|\s)(#[[:xdigit:]]+)(\s|$)/', '$1<a href="$2">$2</a>$3', $output[10]),
                ];
            }
        }

        if ($commitishPath === null) {
            $commitishPath = $repository->getHead();
        }

        list($branch, $file) = $this->extractReference($repository, $commitishPath, $project->slug);

        return View::make('projects/treegraph')
            ->withOwner($owner)
            ->withProject($project)
            ->withBranch($branch)
            ->withCommitishPath($commitishPath)
            ->withGraphItems($graphItems);
    }
}
