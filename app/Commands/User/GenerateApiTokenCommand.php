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

final class GenerateApiTokenCommand
{
    /**
     * The user to generate the token.
     *
     * @var \Gitamin\Models\User
     */
    public $user;

    /**
     * Create a new generate api token command instance.
     *
     * @param \Gitamin\Models\User $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
