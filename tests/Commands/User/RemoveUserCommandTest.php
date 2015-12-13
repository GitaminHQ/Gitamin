<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Tests\Commands\User;

use Gitamin\Commands\User\RemoveUserCommand;
use Gitamin\Handlers\Commands\User\RemoveUserCommandHandler;
use Gitamin\Models\User;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the remove user command test class.
 */
class RemoveUserCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = ['user' => new User()];
        $object = new RemoveUserCommand($params['user']);

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return false;
    }

    protected function getHandlerClass()
    {
        return RemoveUserCommandHandler::class;
    }
}
