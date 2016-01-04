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

use AltThree\Validator\ValidationException;
use Gitamin\Commands\Project\AddProjectCommand;
use Gitamin\Commands\Project\UpdateProjectCommand;
use Gitamin\Models\Group;
use Gitamin\Models\Owner;
use Gitamin\Models\Project;
use Gitamin\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class ProjectsController extends Controller
{
    /**
     * Show the form or adding a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function newAction()
    {
        $tree = './';
        $breadcrumbs = bread_crumbs($tree);

        return View::make('projects.new')
            ->withPageTitle(trans('dashboard.projects.new.title').' - '.trans('dashboard.dashboard'))
            ->withGroupId('')
            ->withBreadCrumbs($breadcrumbs)
            ->withOwners(Owner::where('user_id', '=', Auth::user()->id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAction()
    {
        //
        $projectData = Request::get('project');
        $tags = array_pull($projectData, 'tags');

        try {
            $project = dispatch(new AddProjectCommand(
                $projectData['name'],
                $projectData['description'],
                $projectData['visibility_level'],
                $projectData['path'],
                Auth::user()->id,
                $projectData['owner_id']
            ));
        } catch (ValidationException $e) {
            return Redirect::route('projects.new')
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.projects.new.failure')))
                ->withErrors($e->getMessageBag());
        }

        // The project was added successfully, so now let's deal with the tags.
        $tags = preg_split('/ ?, ?/', $tags);

        // For every tag, do we need to create it?
        $projectTags = array_map(function ($taggable) use ($project) {
            return Tag::firstOrCreate(['name' => $taggable])->id;
        }, $tags);

        $project->tags()->sync($projectTags);

        return Redirect::route('dashboard.projects.index')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.projects.new.success')));
    }

    /**
     * Display the specified resource.
     *
     * @param string $owner
     * @param string $project_path
     *
     * @return \Illuminate\Http\Response
     */
    public function showAction($owner_path, $project_path, $postfix = null)
    {
        $project = Project::findByPath($owner_path, $project_path);
        $repository = $project->getRepository();

        if (! $postfix) {
            $postfix = $repository->getHead();
        }

        list($branch, $tree) = $repository->parseCommitishPathParam($postfix);
        list($branch, $tree) = $repository->extractRef($branch, $tree);
        $files = $repository->getTree($tree ? "$branch:\"$tree\"/" : $branch);
        $breadcrumbs = bread_crumbs($tree);

        $parent = null;
        if (($slash = strrpos($tree, '/')) !== false) {
            $parent = substr($tree, 0, $slash);
        } elseif (! empty($tree)) {
            $parent = '';
        }

        return View::make('projects.show')
            ->withPageTitle($project->name)
            ->withActiveItem('project_show')
            ->withBreadCrumbs($breadcrumbs)
            ->withRepo($project->path)
            ->withCurrentBranch($branch)
            ->withBranches($repository->getBranches())
            ->withParentPath($parent)
            ->withPath($tree ? $tree.'/' : $tree)
            ->withFiles($files->output());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $owner_path
     * @param string $project_path
     *
     * @return \Illuminate\Http\Response
     */
    public function editAction($owner_path, $project_path)
    {
        $project = Project::findByPath($owner_path, $project_path);

        return View::make('projects.edit')
            ->withPageTitle(trans('dashboard.projects.edit.title').' - '.trans('dashboard.dashboard'))
            ->withProject($project)
            ->withGroupId('')
            ->withActiveItem('project_edit')
            ->withGroups(Group::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $owner_path
     * @param string $project_path
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAction($owner_path, $project_path)
    {
        $projectData = Request::get('project');
        $tags = array_pull($projectData, 'tags');
        $project = Project::find($projectData['id']);

        try {
            $project = dispatch(new UpdateProjectCommand(
                $project,
                $projectData['name'],
                $projectData['description'],
                $projectData['visibility_level'],
                $projectData['path'],
                Auth::user()->id,
                $project->owner->id
            ));
        } catch (ValidationException $e) {
            return Redirect::route('projects.project_edit', ['owner' => $project->owner_path, 'project' => $project->path])
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.projects.edit.failure')))
                ->withErrors($e->getMessageBag());
        }
        // The project was updated successfully, so now let's deal with the tags.
        $tags = preg_split('/ ?, ?/', $tags);

        return Redirect::route('projects.project_edit', ['owner' => $project->owner_path, 'project' => $project->path])
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.projects.edit.success')));
    }
}
