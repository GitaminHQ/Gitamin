<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers\Api;

use Gitamin\Commands\Project\AddProjectCommand;
use Gitamin\Commands\Project\RemoveProjectCommand;
use Gitamin\Commands\Project\UpdateProjectCommand;
use Gitamin\Models\Project;
use Gitamin\Models\Tag;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ProjectController extends AbstractApiController
{
    use DispatchesJobs;

    /**
     * Get all projects.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Illuminate\Contracts\Auth\Guard          $auth
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProjects(Request $request, Guard $auth)
    {
        if ($auth->check()) {
            $projects = Project::whereRaw('1 = 1');
        } else {
            $projects = Project::whereRaw('1 = 1');
        }

        return $this->paginator($projects->paginate(Binput::get('per_page', 20)), $request);
    }

    /**
     * Get a single project.
     *
     * @param \Gitamin\Models\Project $project
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProject(Project $project)
    {
        return $this->item($project);
    }

    /**
     * Create a new project.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postProjects()
    {
        try {
            $project = $this->dispatch(new AddProjectCommand(
                Binput::get('name'),
                Binput::get('description'),
                Binput::get('visibility_level'),
                Binput::get('path'),
                Binput::get('creator_id'),
                Binput::get('owner_id')
            ));
        } catch (QueryException $e) {
            throw new BadRequestHttpException();
        }

        if (Binput::has('tags')) {
            // The project was added successfully, so now let's deal with the tags.
            $tags = preg_split('/ ?, ?/', Binput::get('tags'));

            // For every tag, do we need to create it?
            $projectTags = array_map(function ($taggable) use ($project) {
                return Tag::firstOrCreate([
                    'name' => $taggable,
                ])->id;
            }, $tags);

            $project->tags()->sync($projectTags);
        }

        return $this->item($project);
    }

    /**
     * Update an existing project.
     *
     * @param \Gitamin\Models\Project $project
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function putProject(Project $project)
    {
        try {
            $this->dispatch(new UpdateProjectCommand(
                $project,
                Binput::get('name'),
                Binput::get('description'),
                Binput::get('visibility_level'),
                Binput::get('path'),
                Binput::get('creator_id'),
                Binput::get('owner_id')
            ));
        } catch (QueryException $e) {
            throw new BadRequestHttpException();
        }

        if (Binput::has('tags')) {
            $tags = preg_split('/ ?, ?/', Binput::get('tags'));

            // For every tag, do we need to create it?
            $projectTags = array_map(function ($taggable) use ($project) {
                return Tag::firstOrCreate(['name' => $taggable])->id;
            }, $tags);

            $project->tags()->sync($projectTags);
        }

        return $this->item($project);
    }

    /**
     * Delete an existing project.
     *
     * @param \Gitamin\Models\Project $project
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteProject(Project $project)
    {
        $this->dispatch(new RemoveProjectCommand($project));

        return $this->noContent();
    }
}
