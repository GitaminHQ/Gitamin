<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Tests\Commands\Subscriber;

use Gitamin\Commands\Subscriber\SubscribeSubscriberCommand;
use Gitamin\Handlers\Commands\Subscriber\SubscribeSubscriberCommandHandler;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the subscribe subscriber command test class.
 */
class SubscribeSubscriberCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'email'    => 'support@cachethq.io',
            'verified' => true,
        ];
        $object = new SubscribeSubscriberCommand(
            $params['email'],
            $params['verified']
        );

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return true;
    }

    protected function getHandlerClass()
    {
        return SubscribeSubscriberCommandHandler::class;
    }
}
