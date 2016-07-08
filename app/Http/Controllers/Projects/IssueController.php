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

use AltThree\Validator\ValidationException;
use Gitamin\Commands\Issue\AddIssueCommand;
use Gitamin\Http\Controllers\Controller;
use Gitamin\Models\Issue;
use Gitamin\Services\DataCollector\Criteria\Issue\BelongsToProject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class IssueController extends Controller
{
    /**
     * Creates a new issue controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index($owner, $project)
    {
        $repository = $project->getRepository();
        $commitishPath = $repository->getHead();
        list($branch, $file) = $this->extractReference($repository, $commitishPath, $project->slug);

        $dc = app('dc');
        $dc->pushCriteria(new BelongsToProject($project->id));
        $issues = $dc->model(Issue::class)->getIssuesList();

        return View::make('projects/issues/index')
            ->withOwner($owner)
            ->withProject($project)
            ->withBranch($branch)
            ->withIssues($issues);
    }

    public function create($owner, $project)
    {
        return View::make('projects/issues/create_edit')
            ->withOwner($owner)
            ->withProject($project);
    }

    public function store($owner, $project)
    {
        $issueData = Input::get('issue');
        try {
            $issue = dispatch(new AddIssueCommand(
                Auth::user()->id,
                $project->id,
                $issueData['title'],
                $issueData['description']
            ));
        } catch (ValidationException $e) {
            return Redirect::route('issue_new', ['owner' => $owner->slug, 'project' => $project->slug])
                ->withInput(Input::all())
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('issue_show', ['owner' => $owner->slug, 'project' => $project->slug, $issue->iid])
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }

    public function show($owner, $project, $issue)
    {
        return View::make('projects/issues/show')
            ->withOwner($owner)
            ->withProject($project)
            ->withIssue($issue);
    }
}
