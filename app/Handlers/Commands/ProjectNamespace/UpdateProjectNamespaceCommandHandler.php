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

use Gitamin\Commands\ProjectNamespace\UpdateProjectNamespaceCommand;
use Gitamin\Events\ProjectNamespace\ProjectNamespaceWasUpdatedEvent;

class UpdateProjectNamespaceCommandHandler
{
    /**
     * Handle the update project group command.
     *
     * @param \Gitamin\Commands\ProjectNamespace\UpdateProjectNamespaceCommand $command
     *
     * @return \Gitamin\Models\ProjectNamespace
     */
    public function handle(UpdateProjectNamespaceCommand $command)
    {
        $project_namespace = $command->project_namespace;
        $project_namespace->update([
            'name'        => $command->name,
            'path'        => $command->path,
            'owner_id'    => $command->owner_id,
            'description' => $command->description,
        ]);

        event(new ProjectNamespaceWasUpdatedEvent($project_namespace));

        return $project_namespace;
    }
}
