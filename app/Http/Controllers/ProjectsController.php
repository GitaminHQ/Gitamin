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
use Gitonomy\Git\Blob;
use Gitonomy\Git\Reference;
use Gitonomy\Git\Tree;
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
    public function showAction($owner_path, $project_path, $postfix = null)
    {

        $project = Project::findByPath($owner_path, $project_path);
        $repository = $project->getRepository2();

        $repository1 = $project->getRepository();
        if (! $postfix) {
            $postfix = $repository1->getHead();
        }
        //$postfix = str_replace('tree/', '', $postfix);

        list($branch, $tree1) = $repository1->parseCommitishPathParam($postfix);

        $refs = $repository->getReferences();
        $revision = $branch;
        if($refs->hasBranch($postfix)) {
            $revision = $refs->getBranch($revision);
        } else {
            $revision = $repository->getRevision($revision);
        }
        $commit = $revision->getCommit();
        $tree = $commit->getTree();
        $folders = $files = [];
        foreach($tree->getEntries() as $name => $data) {
            list($mode, $entry) = $data;
            if($entry instanceof Blob) {

                if($name == 'LICENSE') {
                    //var_dump($revision->getCommit()->getAuthorName());
                    //$message = $repository->getLog('Gitamin/develop/'.$name);
                    //var_dump($message->getCommits());
                    //exit;
                }
                $files[] = [
                'name'=> $name,
                'type'=>'file',
                'hash' => $entry->getHash(),
                'message' => 'message',
                'size' => '1',
                ];
            } elseif($entry instanceof Tree) {
                $folders[] = [
                'name' => $name,
                'type' => 'folder',
                'hash' => $entry->getHash(),
                'message' => 'message',
                'size' => '2',
                ];
            }
        }
        $entries = array_merge($folders,$files);

        return View::make('projects.show')
            ->withPageTitle($project->name)
            ->withActiveItem('project_show')
            ->withBreadCrumbs([])
            ->withProject($project)
            ->withRepo($project->path)
            ->withRevision($revision)
            ->withCurrentBranch($branch)
            ->withBranches([])
            ->withParentPath('')
            ->withPath('')
            ->withFiles($entries);
        exit;
    }
    /**
     * Display the specified resource.
     *
     * @param string $owner
     * @param string $project_path
     *
     * @return \Illuminate\Http\Response
     */
    public function showAction2($owner_path, $project_path, $postfix = null)
    {
        $project = Project::findByPath($owner_path, $project_path);
        $repository = $project->getRepository();
        $repository2 = $project->getRepository2();

        $refs = $repository2->getReferences();
        $revision = 'master';
        if($refs->hasBranch($postfix)) {
            $revision = $refs->getBranch($revision);
        } else {
            $revision = $repository2->getRevision($revision);
        }
        $commit = $revision->getCommit();
        $tree = $commit->getTree();
        $folders = $files = [];
        foreach($tree->getEntries() as $name => $data) {
            list($mode, $entry) = $data;
            if($entry instanceof Blob) {
                $files[] = $name;
            } elseif($entry instanceof Tree) {
                $folders[] = $name;
            }
        }
        $entries = array_merge($folders,$files);
        var_dump($entries);
        exit;
        var_dump($repository2->getSize());

        if (! $postfix) {
            $postfix = $repository->getHead();
        }
        //$postfix = str_replace('tree/', '', $postfix);

        list($branch, $tree) = $repository->parseCommitishPathParam($postfix);

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
            ->withProject($project)
            ->withRepo($project->path)
            ->withCurrentBranch($branch)
            ->withBranches($repository->getBranches())
            ->withParentPath($parent)
            ->withPath($tree ? $tree.'/' : $tree)
            ->withFiles($files->getEntries());
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
        $repository = $project->getRepository();

        return View::make('projects.edit')
            ->withPageTitle(trans('dashboard.projects.edit.title').' - '.trans('dashboard.dashboard'))
            ->withProject($project)
            ->withGroupId('')
            ->withBreadCrumbs([])
            ->withBranches($repository->getBranches())
            ->withCurrentBranch($repository->getCurrentBranch())
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
