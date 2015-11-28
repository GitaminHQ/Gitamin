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

use Gitamin\Commands\User\InviteTeamMemberCommand;
use Gitamin\Events\User\UserWasInvitedEvent;
use Gitamin\Models\Invite;

class InviteTeamMemberCommandHandler
{
    /**
     * Handle the invite team member command.
     *
     * @param \Gitamin\Commands\User\InviteTeamMemberCommand $command
     *
     * @return void
     */
    public function handle(InviteTeamMemberCommand $command)
    {
        foreach ($command->emails as $email) {
            $invite = Invite::create([
                'email' => $email,
            ]);

            event(new UserWasInvitedEvent($invite));
        }
    }
}
