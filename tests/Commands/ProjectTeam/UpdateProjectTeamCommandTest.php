<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Tests\Commands\ProjectTeam;

use Gitamin\Commands\ProjectTeam\UpdateProjectTeamCommand;
use Gitamin\Handlers\Commands\ProjectTeam\UpdateProjectTeamCommandHandler;
use Gitamin\Models\ProjectTeam;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the update project team command test class.
 */
class UpdateProjectTeamCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'team'  => new ProjectTeam(),
            'name'  => 'Foo',
            'order' => 1,
        ];
        $object = new UpdateProjectTeamCommand($params['team'], $params['name'], $params['order']);

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return true;
    }

    protected function getHandlerClass()
    {
        return UpdateProjectTeamCommandHandler::class;
    }
}
