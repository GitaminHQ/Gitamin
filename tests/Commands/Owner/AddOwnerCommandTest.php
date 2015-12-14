<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Test\Commands\Owner;

use Gitamin\Commands\Owner\AddOwnerCommand;
use Gitamin\Handlers\Commands\Owner\AddOwnerCommandHandler;
use Gitamin\Test\Commands\AbstractCommandTestCase;

/**
 * This is the add project owner command test class.
 */
class AddOwnerCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'name' => 'Test',
            'path' => 'test',
            'user_id' => 1,
            'description' => 'Foo bar',
            'type' => 'Group',
        ];
        $object = new AddOwnerCommand(
            $params['name'],
            $params['path'],
            $params['user_id'],
            $params['description'],
            $params['type']
        );

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return true;
    }

    protected function getHandlerClass()
    {
        return AddOwnerCommandHandler::class;
    }
}
