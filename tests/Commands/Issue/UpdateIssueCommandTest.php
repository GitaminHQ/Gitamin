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

use Gitamin\Commands\Issue\UpdateIssueCommand;
use Gitamin\Handlers\Commands\Issue\UpdateIssueCommandHandler;
use Gitamin\Models\Issue;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the update issue command test class.
 */
class UpdateIssueCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'issue'          => new Issue(),
            'name'           => 'Test',
            'status'         => 1,
            'message'        => 'Foo bar baz',
            'visible'        => 1,
            'user_id'        => 1,
            'project_id'     => 1,
            'notify'         => false,
            'issue_date'     => null,
        ];
        $object = new UpdateIssueCommand(
            $params['issue'],
            $params['name'],
            $params['status'],
            $params['message'],
            $params['visible'],
            $params['user_id'],
            $params['project_id'],
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
        return UpdateIssueCommandHandler::class;
    }
}
