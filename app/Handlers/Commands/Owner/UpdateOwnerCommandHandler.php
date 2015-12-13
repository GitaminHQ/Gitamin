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

use Gitamin\Commands\Owner\UpdateOwnerCommand;
use Gitamin\Events\Owner\OwnerWasUpdatedEvent;

class UpdateOwnerCommandHandler
{
    /**
     * Handle the update project group command.
     *
     * @param \Gitamin\Commands\Owner\UpdateOwnerCommand $command
     *
     * @return \Gitamin\Models\Owner
     */
    public function handle(UpdateOwnerCommand $command)
    {
        $owner = $command->owner;
        $owner->update([
            'name' => $command->name,
            'path' => $command->path,
            'user_id' => $command->user_id,
            'description' => $command->description,
        ]);

        event(new OwnerWasUpdatedEvent($owner));

        return $owner;
    }
}
