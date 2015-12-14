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

use Gitamin\Commands\Owner\RemoveOwnerCommand;
use Gitamin\Handlers\Commands\Owner\RemoveOwnerCommandHandler;
use Gitamin\Models\Owner;
use Gitamin\Test\Commands\AbstractCommandTestCase;

/**
 * This is the remove project owner command test class.
 */
class RemoveOwnerCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = ['owner' => new Owner()];
        $object = new RemoveOwnerCommand($params['owner']);

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return false;
    }

    protected function getHandlerClass()
    {
        return RemoveOwnerCommandHandler::class;
    }
}
