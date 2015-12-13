<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Tests\Commands\Owner;

use Gitamin\Commands\Owner\UpdateOwnerCommand;
use Gitamin\Handlers\Commands\Owner\UpdateOwnerCommandHandler;
use Gitamin\Models\Owner;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the update project owner command test class.
 */
class UpdateOwnerCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'owner' => new Owner(),
            'name' => 'Foo',
            'path' => 'Bar',
            'user_id' => 1,
            'description' => 'Description',
        ];
        $object = new UpdateOwnerCommand($params['owner'], $params['name'], $params['path'], $params['user_id'], $params['description']);

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return true;
    }

    protected function getHandlerClass()
    {
        return UpdateOwnerCommandHandler::class;
    }
}
