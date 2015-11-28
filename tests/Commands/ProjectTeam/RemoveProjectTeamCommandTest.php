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

use Gitamin\Commands\ProjectTeam\RemoveProjectTeamCommand;
use Gitamin\Handlers\Commands\ProjectTeam\RemoveProjectTeamCommandHandler;
use Gitamin\Models\ProjectTeam;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the remove project team command test class.
 */
class RemoveProjectTeamCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = ['team' => new ProjectTeam()];
        $object = new RemoveProjectTeamCommand($params['team']);

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return false;
    }

    protected function getHandlerClass()
    {
        return RemoveProjectTeamCommandHandler::class;
    }
}
