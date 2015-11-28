<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Commands\Invite;

use Carbon\Carbon;
use Gitamin\Commands\Invite\ClaimInviteCommand;
use Gitamin\Events\Invite\InviteWasClaimed;

class ClaimInviteCommandHandler
{
    /**
     * Handle the claim invite command.
     *
     * @param \Gitamin\Commands\User\ClaimInviteCommand $command
     *
     * @return void
     */
    public function handle(ClaimInviteCommand $command)
    {
        $invite = $command->invite;

        $invite->claimed_at = Carbon::now();
        $invite->save();

        event(new InviteWasClaimed($invite));
    }
}
