<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Tests\Events\User;

use Gitamin\Events\User\UserEventInterface;
use Gitamin\Tests\Events\AbstractEventTestCase;

class AbstractUserEventTestCase extends AbstractEventTestCase
{
    protected function getEventInterfaces()
    {
        return [UserEventInterface::class];
    }
}
