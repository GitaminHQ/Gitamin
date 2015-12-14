<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Test\Commands\Subscriber;

use Gitamin\Commands\Subscriber\UnsubscribeSubscriberCommand;
use Gitamin\Handlers\Commands\Subscriber\UnsubscribeSubscriberCommandHandler;
use Gitamin\Models\Subscriber;
use Gitamin\Test\Commands\AbstractCommandTestCase;

/**
 * This is the unsubscribe subscriber command test class.
 */
class UnsubscribeSubscriberCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = ['subscriber' => new Subscriber()];
        $object = new UnsubscribeSubscriberCommand($params['subscriber']);

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return false;
    }

    protected function getHandlerClass()
    {
        return UnsubscribeSubscriberCommandHandler::class;
    }
}
