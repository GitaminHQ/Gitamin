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

use Gitamin\Commands\Owner\AddOwnerCommand;
use Gitamin\Events\Owner\OwnerWasAddedEvent;
use Gitamin\Models\Owner;

class AddOwnerCommandHandler
{
    /**
     * Handle the add project owner command.
     *
     * @param \Gitamin\Commands\Owner\AddOwnerCommand $command
     *
     * @return \Gitamin\Models\Owner
     */
    public function handle(AddOwnerCommand $command)
    {
        $group = Owner::create([
            'name'        => $command->name,
            'path'        => $command->path,
            'user_id'     => $command->user_id,
            'description' => $command->description,
            'type'        => $command->type,
        ]);

        event(new OwnerWasAddedEvent($group));

        return $group;
    }
}
