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

use Gitamin\Commands\ProjectNamespace\AddProjectNamespaceCommand;
use Gitamin\Commands\ProjectNamespace\RemoveProjectNamespaceCommand;
use Gitamin\Commands\ProjectNamespace\UpdateProjectNamespaceCommand;
use Gitamin\Models\ProjectNamespace;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ProjectNamespaceController extends AbstractApiController
{
    use DispatchesJobs;

    /**
     * Get all teams.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTeams(Request $request)
    {
        $teams = ProjectNamespace::paginate(Binput::get('per_page', 20));

        return $this->paginator($teams, $request);
    }

    /**
     * Get a single team.
     *
     * @param \Gitamin\Models\ProjectNamespace $team
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTeam(ProjectNamespace $team)
    {
        return $this->item($team);
    }

    /**
     * Create a new project team.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postTeams()
    {
        try {
            $team = $this->dispatch(new AddProjectNamespaceCommand(
                Binput::get('name'),
                Binput::get('path'),
                Binput::get('order', 0)
            ));
        } catch (QueryException $e) {
            throw new BadRequestHttpException();
        }

        return $this->item($team);
    }

    /**
     * Update an existing team.
     *
     * @param \Gitamin\Models\ProjectNamespace $team
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function putTeam(ProjectNamespace $team)
    {
        try {
            $team = $this->dispatch(new UpdateProjectNamespaceCommand(
                $team,
                Binput::get('name'),
                Binput::get('path'),
                Binput::get('order', 0)
            ));
        } catch (QueryException $e) {
            throw new BadRequestHttpException();
        }

        return $this->item($team);
    }

    /**
     * Delete an existing team.
     *
     * @param \Gitamin\Models\ProjectNamespace $team
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTeam(ProjectNamespace $team)
    {
        $this->dispatch(new RemoveProjectNamespaceCommand($team));

        return $this->noContent();
    }
}
