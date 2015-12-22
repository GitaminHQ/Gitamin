<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Commands\Invite;

final class ClaimInviteCommand
{
    /**
     * The invite to mark as claimed.
     *
     * @var \Gitamin\Model\Invite
     */
    public $invite;

    /**
     * Create a new claim invite command instance.
     *
     * @param \Gitamin\Model\Invite $invite
     */
    public function __construct($invite)
    {
        $this->invite = $invite;
    }
}
