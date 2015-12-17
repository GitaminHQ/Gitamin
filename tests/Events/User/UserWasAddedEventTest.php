<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Test\Events\User;

use Gitamin\Events\User\UserWasAddedEvent;
use Gitamin\Models\User;

class UserWasAddedEventTest extends AbstractUserEventTestCase
{
    protected function objectHasHandlers()
    {
        return true;
    }

    protected function getObjectAndParams()
    {
        $params = ['user' => new User()];
        $object = new UserWasAddedEvent($params['user']);

        return compact('params', 'object');
    }
}
