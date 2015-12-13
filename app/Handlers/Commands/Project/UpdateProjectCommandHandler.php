<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Commands\Project;

use Gitamin\Commands\Project\UpdateProjectCommand;
use Gitamin\Events\Project\ProjectWasUpdatedEvent;
use Gitamin\Models\Project;

class UpdateProjectCommandHandler
{
    /**
     * Handle the update project command.
     *
     * @param \Gitamin\Commands\Project\UpdateProjectCommand $command
     *
     * @return \Gitamin\Models\Project
     */
    public function handle(UpdateProjectCommand $command)
    {
        $project = $command->project;

        $project->update($this->filter($command));

        event(new ProjectWasUpdatedEvent($project));

        return $project;
    }

    /**
     * Filter the command data.
     *
     * @param \Gitamin\Commands\Issue\UpdateProjectCommand $command
     *
     * @return array
     */
    protected function filter(UpdateProjectCommand $command)
    {
        $params = [
            'name' => $command->name,
            'description' => $command->description,
            'path' => $command->path,
            'visibility_level' => $command->visibility_level,
            'owner_id' => $command->owner_id,
        ];

        return array_filter($params, function ($val) {
            return $val !== null;
        });
    }
}
