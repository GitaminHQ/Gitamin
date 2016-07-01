<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class CommitController extends Controller
{
	public function index($owner, $project, $commitishPath)
	{
		$repository = app('git')->getRepositoryFromName($this->repositories, $project);

		if (!$commitishPath) {
			$commitishPath = $repository->getHead();
		}

		list($branch, $file) = $this->parseCommitishPathParam($commitishPath, $project);

		list($branch, $file) = $this->extractRef($repository, $branch, $file);
		$type = $file ? "$branch -- \"$file\"" : $branch;
        $pager = $this->getPager(Input::get('page'), $repository->getTotalCommits($type));
        $commits = $repository->getPaginatedCommits($type, $pager['current']);
        $categorized = array();

        foreach ($commits as $commit) {
            $date = $commit->getCommiterDate();
            $date = $date->format('Y-m-d');
            $categorized[$date][] = $commit;
        }

        $template = (Request::ajax()) ? 'commits_list' : 'commits';

        return View::make($template)
            ->withPage('commits')
            ->withPager($pager)
        	->withProject($project)
        	->withBranch($branch)
        	->withBranches($repository->getBranches())
        	->withTags($repository->getTags())
        	->withFile($file)
        	->withCommits($categorized);
	}

	public function show($owner, $project, $commit)
	{
		$repository = app('git')->getRepositoryFromName($this->repositories, $project);
        $commit = $repository->getCommit($commit);
        $branch = $repository->getHead();

        return View::make('commit')
            ->withProject($project)
            ->withCommit($commit)
            ->withBranch($branch);
	}

    public function blame($owner, $project, $commitishPath)
    {
        $repository = app('git')->getRepositoryFromName($this->repositories, $project);

        list($branch, $file) = $this->parseCommitishPathParam($commitishPath, $project);

        list($branch, $file) = $this->extractRef($repository, $branch, $file);

        $blames = $repository->getBlame("$branch -- \"$file\"");

        return View::make('blame')
            ->withFile($file)
            ->withProject($project)
            ->withBranch($branch)
            ->withBranches($repository->getBranches())
            ->withTags($repository->getTags())
            ->withFile($file)
            ->withBlames($blames);
    }
}