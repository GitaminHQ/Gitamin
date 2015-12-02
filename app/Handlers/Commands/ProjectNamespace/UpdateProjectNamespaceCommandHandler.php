<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Commands\ProjectNamespace;

use Gitamin\Commands\ProjectTeam\UpdateProjectTeamCommand;
use Gitamin\Events\ProjectTeam\ProjectTeamWasUpdatedEvent;

class UpdateProjectTeamCommandHandler
{
    /**
     * Handle the update project team command.
     *
     * @param \Gitamin\Commands\ProjectTeam\UpdateProjectTeamCommand $command
     *
     * @return \Gitamin\Models\ProjectNamespace
     */
    public function handle(UpdateProjectTeamCommand $command)
    {
        $team = $command->team;
        $team->update([
            'name'  => $command->name,
            'slug'  => $command->slug,
            'order' => $command->order,
        ]);

        event(new ProjectTeamWasUpdatedEvent($team));

        return $team;
    }
}
