<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Commands\User;

use Gitamin\Models\User;

final class RemoveUserCommand
{
    /**
     * The user to remove.
     *
     * @var \Gitamin\Models\User
     */
    public $user;

    /**
     * Create a new remove user command instance.
     *
     * @param \Gitamin\Models\User $user
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
