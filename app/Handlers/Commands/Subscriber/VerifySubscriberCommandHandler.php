<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Commands\Subscriber;

use Carbon\Carbon;
use Gitamin\Commands\Subscriber\VerifySubscriberCommand;
use Gitamin\Events\Subscriber\SubscriberHasVerifiedEvent;
use Gitamin\Models\Subscriber;

class VerifySubscriberCommandHandler
{
    /**
     * Handle the subscribe customer command.
     *
     * @param \Gitamin\Commands\Subscriber\VerifySubscriberCommand $command
     *
     * @return void
     */
    public function handle(VerifySubscriberCommand $command)
    {
        $subscriber = $command->subscriber;

        $subscriber->verified_at = Carbon::now();
        $subscriber->save();

        event(new SubscriberHasVerifiedEvent($subscriber));
    }
}
