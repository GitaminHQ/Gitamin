<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Test\Events\Moment;

use Gitamin\Events\Moment\MomentWasUpdatedEvent;
use Gitamin\Models\Moment;

class MomentWasUpdatedEventTest extends AbstractMomentEventTestCase
{
    protected function objectHasHandlers()
    {
        return false;
    }

    protected function getObjectAndParams()
    {
        $params = ['moment' => new Moment()];
        $object = new MomentWasUpdatedEvent($params['moment']);

        return compact('params', 'object');
    }
}
