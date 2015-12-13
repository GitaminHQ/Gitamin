<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Commands\Owner;

use Gitamin\Commands\Owner\RemoveOwnerCommand;
use Gitamin\Events\Owner\OwnerWasRemovedEvent;

class RemoveOwnerCommandHandler
{
    /**
     * Handle the remove project team command.
     *
     * @param \Gitamin\Commands\Owner\RemoveOwnerCommand $command
     *
     * @return void
     */
    public function handle(RemoveOwnerCommand $command)
    {
        $owner = $command->owner;

        event(new OwnerWasRemovedEvent($owner));

        // Remove the owner id from all project.
        $owner->projects->map(function ($project) {
            $project->update(['owner_id' => 0]);
        });

        $owner->delete();
    }
}
