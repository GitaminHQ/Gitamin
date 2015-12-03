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

use Gitamin\Commands\Project\AddProjectCommand;
use Gitamin\Events\Project\ProjectWasAddedEvent;
use Gitamin\Models\Project;

class AddProjectCommandHandler
{
    /**
     * Handle the add project command.
     *
     * @param \Gitamin\Commands\Project\AddProjectCommand $command
     *
     * @return \Gitamin\Models\Project
     */
    public function handle(AddProjectCommand $command)
    {
        $project = Project::create($this->filter($command));

        event(new ProjectWasAddedEvent($project));

        return $project;
    }

    /**
     * Filter the command data.
     *
     * @param \Gitamin\Commands\Issue\AddProjectCommand $command
     *
     * @return array
     */
    protected function filter(AddProjectCommand $command)
    {
        $params = [
            'name'             => $command->name,
            'description'      => $command->description,
            'path'             => $command->path,
            'creator_id'       => $command->creator_id,
            'visibility_level' => $command->visibility_level,
            'namespace_id'     => $command->namespace_id,
        ];

        return array_filter($params, function ($val) {
            return $val !== null;
        });
    }
}
