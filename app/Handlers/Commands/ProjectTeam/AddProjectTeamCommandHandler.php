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

use Gitamin\Commands\ProjectTeam\AddProjectTeamCommand;
use Gitamin\Events\ProjectTeam\ProjectTeamWasAddedEvent;
use Gitamin\Models\ProjectTeam;

class AddProjectTeamCommandHandler
{
    /**
     * Handle the add project team command.
     *
     * @param \Gitamin\Commands\ProjectTeam\AddProjectTeamCommand $command
     *
     * @return \Gitamin\Models\ProjectTeam
     */
    public function handle(AddProjectTeamCommand $command)
    {
        $team = ProjectTeam::create([
            'name'  => $command->name,
            'slug'  => $command->slug,
            'order' => $command->order,
        ]);

        event(new ProjectTeamWasAddedEvent($team));

        return $team;
    }
}
