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

use Gitamin\Commands\Project\RemoveProjectCommand;
use Gitamin\Events\Project\ProjectWasRemovedEvent;

class RemoveProjectCommandHandler
{
    /**
     * Handle the remove project command.
     *
     * @param \Gitamin\Commands\Project\RemoveProjectCommand $command
     *
     * @return void
     */
    public function handle(RemoveProjectCommand $command)
    {
        $project = $command->project;

        event(new ProjectWasRemovedEvent($project));

        $project->delete();
    }
}
