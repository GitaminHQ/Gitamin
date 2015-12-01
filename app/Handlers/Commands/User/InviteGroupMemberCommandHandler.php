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

use Gitamin\Commands\User\InviteGroupMemberCommand;
use Gitamin\Events\User\UserWasInvitedEvent;
use Gitamin\Models\Invite;

class InviteGroupMemberCommandHandler
{
    /**
     * Handle the invite group member command.
     *
     * @param \Gitamin\Commands\User\InviteGroupMemberCommand $command
     *
     * @return void
     */
    public function handle(InviteGroupMemberCommand $command)
    {
        foreach ($command->emails as $email) {
            $invite = Invite::create([
                'email' => $email,
            ]);

            event(new UserWasInvitedEvent($invite));
        }
    }
}
