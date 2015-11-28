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

use Gitamin\Commands\Subscriber\UnsubscribeSubscriberCommand;
use Gitamin\Events\Subscriber\SubscriberHasUnsubscribedEvent;
use Gitamin\Models\Subscriber;

class UnsubscribeSubscriberCommandHandler
{
    /**
     * Handle the subscribe customer command.
     *
     * @param \Gitamin\Commands\Subscriber\UnsubscribeSubscriberCommand $command
     *
     * @return void
     */
    public function handle(UnsubscribeSubscriberCommand $command)
    {
        $subscriber = $command->subscriber;

        event(new SubscriberHasUnsubscribedEvent($subscriber));

        $subscriber->delete();
    }
}
