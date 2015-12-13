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
            'issue' => new Issue(),
            'title' => 'Test',
            'description' => 'Foo bar baz',
            'author_id' => 1,
            'project_id' => 1,
        ];
        $object = new UpdateIssueCommand(
            $params['issue'],
            $params['title'],
            $params['description'],
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
        return UpdateIssueCommandHandler::class;
    }
}
