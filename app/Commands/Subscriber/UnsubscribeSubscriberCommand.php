<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Commands\Subscriber;

use Gitamin\Models\Subscriber;

final class UnsubscribeSubscriberCommand
{
    /**
     * The subscriber to unsubscribe.
     *
     * @var \Gitamin\Models\Subscriber
     */
    public $subscriber;

    /**
     * Create a unsubscribe subscriber command instance.
     *
     * @param string $subscriber
     *
     * @return void
     */
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }
}
