<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Events\User;

use Gitamin\Models\Invite;

final class UserWasInvitedEvent implements UserEventInterface
{
    /**
     * The invite that has been added.
     *
     * @var \Gitamin\Models\Invite
     */
    public $invite;

    /**
     * Create a new user was invite event instance.
     *
     * @return void
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }
}
