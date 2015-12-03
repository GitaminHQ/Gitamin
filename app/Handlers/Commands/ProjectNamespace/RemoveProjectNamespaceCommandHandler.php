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

use Gitamin\Commands\ProjectNamespace\RemoveProjectNamespaceCommand;
use Gitamin\Events\ProjectNamespace\ProjectNamespaceWasRemovedEvent;

class RemoveProjectNamespaceCommandHandler
{
    /**
     * Handle the remove project team command.
     *
     * @param \Gitamin\Commands\ProjectTeam\RemoveProjectTeamCommand $command
     *
     * @return void
     */
    public function handle(RemoveProjectNamespaceCommand $command)
    {
        $group = $command->group;

        event(new ProjectTeamWasRemovedEvent($team));

        // Remove the namespace id from all project.
        $group->projects->map(function ($project) {
            $project->update(['namespace_id' => 0]);
        });

        $group->delete();
    }
}
