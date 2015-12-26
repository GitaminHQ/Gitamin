<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Test\Events\Project;

use Gitamin\Events\Project\ProjectEventInterface;
use Gitamin\Test\Events\AbstractEventTestCase;

class AbstractProjectEventTestCase extends AbstractEventTestCase
{
    protected function getEventInterfaces()
    {
        return [ProjectEventInterface::class];
    }
}
