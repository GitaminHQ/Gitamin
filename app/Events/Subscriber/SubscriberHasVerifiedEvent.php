<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Events\Subscriber;

use Gitamin\Models\Subscriber;

final class SubscriberHasVerifiedEvent implements SubscriberEventInterface
{
    /**
     * The subscriber who has verified.
     *
     * @var \Gitamin\Models\Subscriber
     */
    public $subscriber;

    /**
     * Create a new subscriber has subscribed event instance.
     */
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }
}
