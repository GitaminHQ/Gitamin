<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Commands\User;

use Gitamin\Commands\User\RemoveUserCommand;
use Gitamin\Events\User\UserWasRemovedEvent;
use Gitamin\Models\User;

class RemoveUserCommandHandler
{
    /**
     * Handle the remove user command.
     *
     * @param \Gitamin\Commands\User\RemoveUserCommand $command
     *
     * @return void
     */
    public function handle(RemoveUserCommand $command)
    {
        $user = $command->user;

        event(new UserWasRemovedEvent($user));

        $user->delete();
    }
}
