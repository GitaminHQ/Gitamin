<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Events\Owner;

use Gitamin\Commands\Owner\AddOwnerCommand;
use Gitamin\Events\User\UserEventInterface;
use Gitamin\Events\User\UserWasAddedEvent;
use Gitamin\Models\User;

class AddOwnerAfterUserAddedHandler
{
    /**
     * Handle the comment updated moment.
     */
    public function handle(UserEventInterface $event)
    {
        if (! $event instanceof UserWasAddedEvent) {
            return;
        }

        $this->trigger($event->user);
    }

    /**
     * Trigger the moment.
     *
     * @param \Gitamin\Models\User $user
     */
    protected function trigger(User &$user)
    {
        $group = dispatch(new AddOwnerCommand(
            $user->username,
            $user->username,
            $user->id,
            '',
            'User'
        ));
    }
}
