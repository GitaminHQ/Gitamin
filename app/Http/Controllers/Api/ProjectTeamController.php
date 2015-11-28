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

use Gitamin\Commands\ProjectTeam\AddProjectTeamCommand;
use Gitamin\Commands\ProjectTeam\RemoveProjectTeamCommand;
use Gitamin\Commands\ProjectTeam\UpdateProjectTeamCommand;
use Gitamin\Models\ProjectTeam;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ProjectTeamController extends AbstractApiController
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
        $teams = ProjectTeam::paginate(Binput::get('per_page', 20));

        return $this->paginator($teams, $request);
    }

    /**
     * Get a single team.
     *
     * @param \Gitamin\Models\ProjectTeam $team
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTeam(ProjectTeam $team)
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
            $team = $this->dispatch(new AddProjectTeamCommand(
                Binput::get('name'),
                Binput::get('slug'),
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
     * @param \Gitamin\Models\ProjectTeam $team
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function putTeam(ProjectTeam $team)
    {
        try {
            $team = $this->dispatch(new UpdateProjectTeamCommand(
                $team,
                Binput::get('name'),
                Binput::get('slug'),
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
     * @param \Gitamin\Models\ProjectTeam $team
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTeam(ProjectTeam $team)
    {
        $this->dispatch(new RemoveProjectTeamCommand($team));

        return $this->noContent();
    }
}
