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

use Gitamin\Commands\Subscriber\VerifySubscriberCommand;
use Gitamin\Handlers\Commands\Subscriber\VerifySubscriberCommandHandler;
use Gitamin\Models\Subscriber;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the verify subscriber command test class.
 */
class VerifySubscriberCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = ['subscriber' => new Subscriber()];
        $object = new VerifySubscriberCommand($params['subscriber']);

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return false;
    }

    protected function getHandlerClass()
    {
        return VerifySubscriberCommandHandler::class;
    }
}
