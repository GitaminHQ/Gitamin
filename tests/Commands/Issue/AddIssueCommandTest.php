<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Tests\Commands\Issue;

use Gitamin\Commands\Issue\AddIssueCommand;
use Gitamin\Handlers\Commands\Issue\AddIssueCommandHandler;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the add issue command test class.
 */
class AddIssueCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'name'           => 'Test',
            'status'         => 1,
            'message'        => 'Foo bar baz',
            'visible'        => 1,
            'project_id'     => 1,
            'project_status' => 1,
            'notify'         => false,
            'issue_date'     => null,
        ];
        $object = new AddIssueCommand(
            $params['name'],
            $params['status'],
            $params['message'],
            $params['visible'],
            $params['project_id'],
            $params['project_status'],
            $params['notify'],
            $params['issue_date']
        );

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return true;
    }

    protected function getHandlerClass()
    {
        return AddIssueCommandHandler::class;
    }
}
