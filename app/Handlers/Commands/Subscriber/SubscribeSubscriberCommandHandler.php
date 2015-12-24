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

use Gitamin\Commands\Subscriber\SubscribeSubscriberCommand;
use Gitamin\Commands\Subscriber\VerifySubscriberCommand;
use Gitamin\Events\Subscriber\SubscriberHasSubscribedEvent;
use Gitamin\Models\Subscriber;

class SubscribeSubscriberCommandHandler
{
    /**
     * Handle the subscribe subscriber command.
     *
     * @param \Gitamin\Commands\Subscriber\SubscribeSubscriberCommand $command
     *
     * @return \Gitamin\Models\Subscriber
     */
    public function handle(SubscribeSubscriberCommand $command)
    {
        $subscriber = Subscriber::create(['email' => $command->email]);

        if ($command->verified) {
            dispatch(new VerifySubscriberCommand($subscriber));
        } else {
            event(new SubscriberHasSubscribedEvent($subscriber));
        }

        return $subscriber;
    }
}
