<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Commands\ProjectTeam;

use Gitamin\Commands\ProjectTeam\RemoveProjectTeamCommand;
use Gitamin\Events\ProjectTeam\ProjectTeamWasRemovedEvent;

class RemoveProjectTeamCommandHandler
{
    /**
     * Handle the remove project team command.
     *
     * @param \Gitamin\Commands\ProjectTeam\RemoveProjectTeamCommand $command
     *
     * @return void
     */
    public function handle(RemoveProjectTeamCommand $command)
    {
        $team = $command->team;

        event(new ProjectTeamWasRemovedEvent($team));

        // Remove the team id from all project.
        $team->projects->map(function ($project) {
            $project->update(['team_id' => 0]);
        });

        $team->delete();
    }
}
