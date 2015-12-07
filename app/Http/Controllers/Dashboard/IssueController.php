<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers\Dashboard;

use AltThree\Validator\ValidationException;
use Gitamin\Commands\Issue\AddIssueCommand;
use Gitamin\Commands\Issue\RemoveIssueCommand;
use Gitamin\Commands\Issue\UpdateIssueCommand;
use Gitamin\Models\Issue;
use Gitamin\Models\Project;
use Gitamin\Models\Group;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class IssueController extends Controller
{
    use DispatchesJobs;

    /**
     * Stores the sub-sidebar tree list.
     *
     * @var array
     */
    protected $subMenu = [];

    /**
     * Creates a new issue controller instance.
     *
     * @return \Gitamin\Http\Controllers\IssueController
     */
    public function __construct()
    {
        $this->subMenu = [
            'issues' => [
                'title'  => trans('dashboard.issues.all'),
                'url'    => route('dashboard.issues.index'),
                'icon'   => 'fa fa-exclamation-circle',
                'active' => true,
            ],
        ];

        View::share('sub_menu', $this->subMenu);
        View::share('sub_title', trans('dashboard.issues.title'));
    }

    /**
     * Shows the index view.
     * 
     * @return \Illuminate\View\View
     */
    public function showIndex()
    {
        return View::make('dashboard.projects.issues.index');
    }

    /**
     * Shows the issues view.
     *
     * @return \Illuminate\View\View
     */
    public function showIssues()
    {
        $issues = Issue::orderBy('created_at', 'desc')->get();

        return View::make('dashboard.issues.index')
            ->withPageTitle(trans('dashboard.issues.issues').' - '.trans('dashboard.dashboard'))
            ->withIssues($issues);
    }

    /**
     * Shows the add issue view.
     *
     * @return \Illuminate\View\View
     */
    public function showAddIssue()
    {
        return View::make('dashboard.issues.add')
            ->withPageTitle(trans('dashboard.issues.add.title').' - '.trans('dashboard.dashboard'))
            ->withProjectsInTeams(Group::with('projects')->get())
            ->withProjectsOutTeams(Project::where('namespace_id', 0)->get());
    }

    /**
     * Creates a new issue.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createIssueAction()
    {
        try {
            $issue = $this->dispatch(new AddIssueCommand(
                Binput::get('name'),
                Binput::get('status'),
                Binput::get('message'),
                Binput::get('visible', true),
                Auth::user()->id,
                Binput::get('project_id'),
                Binput::get('notify', true),
                Binput::get('created_at'),
                null,
                null
            ));
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.issues.add')
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.issues.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.issues.index')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.issues.add.success')));
    }

    /**
     * Deletes a given issue.
     *
     * @param \Gitamin\Models\Issue $issue
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteIssueAction(Issue $issue)
    {
        $this->dispatch(new RemoveIssueCommand($issue));

        return Redirect::route('dashboard.issues.index')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.issues.delete.success')));
    }

    /**
     * Shows the edit issue view.
     *
     * @param \Gitamin\Models\Issue $issue
     *
     * @return \Illuminate\View\View
     */
    public function showEditIssueAction(Issue $issue)
    {
        return View::make('dashboard.issues.edit')
            ->withPageTitle(trans('dashboard.issues.edit.title').' - '.trans('dashboard.dashboard'))
            ->withIssue($issue)
            ->withProjectsInTeams(Group::with('projects')->get())
            ->withProjectsOutTeams(Project::where('namespace_id', 0)->get());
    }

    /**
     * Edit an issue.
     *
     * @param \Gitamin\Models\Issue $issue
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editIssueAction(Issue $issue)
    {
        try {
            $issue = $this->dispatch(new UpdateIssueCommand(
                $issue,
                Binput::get('name'),
                Binput::get('status'),
                Binput::get('message'),
                Binput::get('visible', true),
                Auth::user()->id,
                Binput::get('project_id'),
                Binput::get('notify', true),
                Binput::get('created_at'),
                null,
                null
            ));
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.issues.edit', ['id' => $issue->id])
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.issues.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        //Do nothing
        /*
        if ($issue->project) {
            $issue->project->update(['status' => Binput::get('project_status')]);
        }
        */

        return Redirect::route('dashboard.issues.edit', ['id' => $issue->id])
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.issues.edit.success')));
    }
}
