<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Commands\Identity;

use Carbon\Carbon;
use Gitamin\Commands\Identity\AddIdentityCommand;
use Gitamin\Models\Identity;
use Illuminate\Support\Facades\Session;

class AddIdentityCommandHandler
{
    /**
     * Handle the report append command.
     *
     * @param \Gitamin\Commands\Identity\AddIdentityCommand $command
     *
     * @return \Gitamin\Models\Identity
     */
    public function handle(AddIdentityCommand $command)
    {
        $data = [
            'user_id'         => $command->userId,
            'extern_uid'      => $command->data['extern_uid'],
            'provider_id'     => $command->data['provider_id'],
            'nickname'        => $command->data['nickname'],
            'created_at'      => Carbon::now()->toDateTimeString(),
        ];
        // Create the identify
        $identify = Identity::create($data);

        Session::pull('connect_data');

        return $identify;
    }
}
