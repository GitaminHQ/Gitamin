<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Tests\Commands\Project;

use Gitamin\Commands\Project\AddProjectCommand;
use Gitamin\Handlers\Commands\Project\AddProjectCommandHandler;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the add project command test class.
 */
class AddProjectCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'name' => 'Test',
            'description' => 'Foo',
            'visibility_level' => 1,
            'path' => 'Baidu',
            'creator_id' => 1,
            'owner_id' => 1,
        ];
        $object = new AddProjectCommand(
            $params['name'],
            $params['description'],
            $params['visibility_level'],
            $params['path'],
            $params['creator_id'],
            $params['owner_id']
        );

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return true;
    }

    protected function getHandlerClass()
    {
        return AddProjectCommandHandler::class;
    }
}
