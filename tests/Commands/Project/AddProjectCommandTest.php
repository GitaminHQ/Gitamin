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
            'name'        => 'Test',
            'description' => 'Foo',
            'status'      => 1,
            'slug'        => 'Baidu',
            'order'       => 0,
            'team_id'     => 0,
            'enabled'     => true,
        ];
        $object = new AddProjectCommand(
            $params['name'],
            $params['description'],
            $params['status'],
            $params['slug'],
            $params['order'],
            $params['team_id'],
            $params['enabled']
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
