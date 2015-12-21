<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Test\Commands\Moment;

use Gitamin\Commands\Moment\AddMomentCommand;
use Gitamin\Handlers\Commands\Moment\AddMomentCommandHandler;
use Gitamin\Test\Commands\AbstractCommandTestCase;

/**
 * This is the add moment command test class.
 */
class AddMomentCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'title' => 'Test',
            'data' => 'Foo bar baz',
            'momentable_type' => 'Issue',
            'momentable_id' => 1,
            'action' => 3,
            'author_id' => 1,
            'project_id' => 1,
        ];
        $object = new AddMomentCommand(
            $params['title'],
            $params['data'],
            $params['momentable_type'],
            $params['momentable_id'],
            $params['action'],
            $params['author_id'],
            $params['project_id']
        );

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return true;
    }

    protected function getHandlerClass()
    {
        return AddMomentCommandHandler::class;
    }
}
