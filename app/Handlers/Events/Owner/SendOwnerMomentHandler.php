<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Events\Owner;

use Gitamin\Commands\Moment\AddMomentCommand;
use Gitamin\Events\Owner\OwnerEventInterface;
use Gitamin\Events\Owner\OwnerWasAddedEvent;
use Gitamin\Models\Moment;
use Gitamin\Models\Owner;

class SendOwnerMomentHandler
{
    /**
     * Handle the comment updated moment.
     */
    public function handle(OwnerEventInterface $event)
    {
        if ($event instanceof OwnerWasAddedEvent) {
            $action = Moment::CREATED;
        } else {
            $action = Moment::UPDATED;
        }

        $this->trigger($event->owner, $action);
    }

    /**
     * Trigger the moment.
     *
     * @param \Gitamin\Models\Comment $comment
     * @param int                     $action
     */
    protected function trigger(Owner &$owner, $action)
    {
        $moment = dispatch(new AddMomentCommand(
            '',
            '',
            'Owner',
            $owner->id,
            $action,
            $owner->user_id,
            0
        ));
    }
}
