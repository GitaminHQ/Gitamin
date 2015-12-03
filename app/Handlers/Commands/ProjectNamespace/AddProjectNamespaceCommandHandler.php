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

use Gitamin\Commands\ProjectNamespace\AddProjectNamespaceCommand;
use Gitamin\Events\ProjectNamespace\ProjectNamespaceWasAddedEvent;
use Gitamin\Models\ProjectNamespace;

class AddProjectNamespaceCommandHandler
{
    /**
     * Handle the add project team command.
     *
     * @param \Gitamin\Commands\ProjectTeam\AddProjectTeamCommand $command
     *
     * @return \Gitamin\Models\ProjectTeam
     */
    public function handle(AddProjectNamespaceCommand $command)
    {
        $group = ProjectNamespace::create([
            'name'        => $command->name,
            'path'        => $command->path,
            'owner_id'    => $command->owner_id,
            'description' => $command->description,
            'type'        => $command->type,
        ]);

        event(new ProjectNamespaceWasAddedEvent($group));

        return $group;
    }
}
