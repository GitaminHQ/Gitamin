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

use Gitamin\Commands\ProjectTeam\AddProjectTeamCommand;
use Gitamin\Handlers\Commands\ProjectTeam\AddProjectTeamCommandHandler;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the add project team command test class.
 */
class AddProjectTeamCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'name'  => 'Test',
            'order' => 0,
        ];
        $object = new AddProjectTeamCommand(
            $params['name'],
            $params['order']
        );

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return true;
    }

    protected function getHandlerClass()
    {
        return AddProjectTeamCommandHandler::class;
    }
}
