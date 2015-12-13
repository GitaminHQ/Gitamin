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

use Gitamin\Commands\User\GenerateApiTokenCommand;
use Gitamin\Models\User;

class GenerateApiTokenCommandHandler
{
    /**
     * Handle the generate api key command.
     *
     * @param \Gitamin\Commands\User\GenerateApiTokenCommand $command
     */
    public function handle(GenerateApiTokenCommand $command)
    {
        $user = $command->user;

        $user->api_key = User::generateApiKey();
        $user->save();

        //event(new GeneratedApiTokenEvent($user));
    }
}
