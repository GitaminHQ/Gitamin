<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Test\Commands\Project;

use Gitamin\Commands\Project\RemoveProjectCommand;
use Gitamin\Handlers\Commands\Project\RemoveProjectCommandHandler;
use Gitamin\Models\Project;
use Gitamin\Test\Commands\AbstractCommandTestCase;

/**
 * This is the remove project command test class.
 */
class RemoveProjectCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = ['project' => new Project()];
        $object = new RemoveProjectCommand($params['project']);

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return false;
    }

    protected function getHandlerClass()
    {
        return RemoveProjectCommandHandler::class;
    }
}
