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
use Gitonomy\Git\Reference\Branch;
use Gitonomy\Git\Tree;
use GrahamCampbell\Markdown\Facades\Markdown;
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
     * @param string|null $postfix
     *
     * @return \Illuminate\Http\Response
     */
    public function showAction($owner_path, $project_path, $postfix = null)
    {
        $project = Project::findByPath($owner_path, $project_path);
        $repository = $project->getRepository2();
        $refs = $repository->getReferences();

        if (! $postfix) {
            $postfix = $repository->getHead()->getName();
        }

        list($revision, $path) = $project->getRepository()->parseCommitishPathParam($postfix);

        if ($refs->hasBranch($revision)) {
            $revision = $refs->getBranch($revision);
        } else {
            $revision = $repository->getRevision($revision);
        }

        $commit = $revision->getCommit();
        $tree = $commit->getTree();

        if (strlen($path) > 0 && '/' === substr($path, 0, 1)) {
            $path = substr($path, 1);
        }

        try {
            $element = $tree->resolvePath($path);
        } catch (\InvalidArgumentException $e) {
            throw $this->createNotFoundException($e->getMessage());
        }

        $folders = $files = $readme = [];
        foreach ($element->getEntries() as $name => $data) {
            list($mode, $entry) = $data;

            $lastModification = $commit->getLastModification($path.'/'.$name);

            if ($entry instanceof Blob) {
                $files[] = [
                'name' => $name,
                'type' => 'file',
                'hash' => $lastModification->getHash(),
                'message' => $lastModification->getMessage(),
                'age' => $lastModification->getCommitterDate()->format('m-d H:i:s'),
                ];

                if (preg_match('/^readme*/i', $name)) {
                    $readme = [
                        'name' => $name,
                        'content' => Markdown::convertToHtml($entry->getContent()),
                    ];
                }
            } elseif ($entry instanceof Tree) {
                $folders[] = [
                'name' => $name,
                'type' => 'folder',
                'hash' => $lastModification->getHash(),
                'message' => $lastModification->getMessage(),
                'age' => $lastModification->getCommitterDate()->format('m-d H:i:s'),
                ];
            }
        }
        $entries = array_merge($folders, $files);
        $breadcrumbs = bread_crumbs($path);

        $parent = null;
        if (($slash = strrpos($path, '/')) !== false) {
            $parent = substr($path, 0, $slash);
        } elseif (! empty($path)) {
            $parent = '';
        }

        $lastModification = ($path != '') ? $commit->getLastModification($path) : $revision->getCommit();

        $currentBranch = ($revision instanceof Branch) ? $revision->getName() : $revision->getRevision();

        return View::make('projects.show')
            ->withPageTitle($project->name)
            ->withActiveItem('project_show')
            ->withBreadCrumbs($breadcrumbs)
            ->withProject($project)
            ->withRepo($project->path)
            ->withLast($lastModification)
            ->withCurrentBranch($currentBranch)
            ->withBranches([])
            ->withParentPath($parent)
            ->withReadme($readme)
            ->withPath($path ? $path.'/' : $path)
            ->withEntries($entries);
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
