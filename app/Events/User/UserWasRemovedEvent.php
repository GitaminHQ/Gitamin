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

use Gitamin\Models\User;

final class UserWasRemovedEvent implements UserEventInterface
{
    /**
     * The user that has been removed.
     *
     * @var \Gitamin\Models\User
     */
    public $user;

    /**
     * Create a new user was removed event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
