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

final class VerifySubscriberCommand
{
    /**
     * The subscriber to verify.
     *
     * @var \Gitamin\Models\Subscriber
     */
    public $subscriber;

    /**
     * Create a verify subscriber command instance.
     *
     * @param Subscriber $subscriber
     *
     * @return void
     */
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }
}
