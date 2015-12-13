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
            'project'          => new Project(),
            'name'             => 'Test',
            'description'      => 'Foo',
            'visibility_level' => 1,
            'path'             => 'Baidu',
            'owner_id'         => 1,
            'creator_id'       => 1,
        ];
        $object = new UpdateProjectCommand(
            $params['project'],
            $params['name'],
            $params['description'],
            $params['visibility_level'],
            $params['path'],
            $params['owner_id'],
            $params['creator_id']
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
