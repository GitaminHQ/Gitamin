<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Tests\Commands;

use Gitamin\Tests\AbstractAnemicTestCase;
use Illuminate\Contracts\Bus\Dispatcher;

/**
 * This is the abstract command test case class.
 */
abstract class AbstractCommandTestCase extends AbstractAnemicTestCase
{
    public function testHandlerCanBeResolved()
    {
        $command = $this->getObjectAndParams()['object'];
        $dispatcher = $this->app->make(Dispatcher::class);

        $this->assertInstanceOf($this->getHandlerClass(), $dispatcher->resolveHandler($command));
    }
}
