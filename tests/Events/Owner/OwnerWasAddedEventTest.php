<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Test\Events\Owner;

use Gitamin\Events\Owner\OwnerWasAddedEvent;
use Gitamin\Models\Owner;

class OwnerWasAddedEventTest extends AbstractOwnerEventTestCase
{
    protected function objectHasHandlers()
    {
        return true;
    }

    protected function getObjectAndParams()
    {
        $params = ['owner' => new Owner()];
        $object = new OwnerWasAddedEvent($params['owner']);

        return compact('params', 'object');
    }
}
