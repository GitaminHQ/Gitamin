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

use Gitamin\Commands\Project\UpdateProjectCommand;
use Gitamin\Handlers\Commands\Project\UpdateProjectCommandHandler;
use Gitamin\Models\Project;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the update project command test class.
 */
class UpdateProjectCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'project'     => new Project(),
            'name'        => 'Test',
            'description' => 'Foo',
            'status'      => 1,
            'slug'        => 'Baidu',
            'order'       => 0,
            'team_id'     => 0,
            'enabled'     => true,
        ];
        $object = new UpdateProjectCommand(
            $params['project'],
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
        return UpdateProjectCommandHandler::class;
    }
}
