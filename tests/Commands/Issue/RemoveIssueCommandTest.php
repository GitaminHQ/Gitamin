<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Test\Commands\Issue;

use Gitamin\Commands\Issue\RemoveIssueCommand;
use Gitamin\Handlers\Commands\Issue\RemoveIssueCommandHandler;
use Gitamin\Models\Issue;
use Gitamin\Test\Commands\AbstractCommandTestCase;

/**
 * This is the remove issue command test class.
 */
class RemoveIssueCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = ['issue' => new Issue()];
        $object = new RemoveIssueCommand($params['issue']);

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return false;
    }

    protected function getHandlerClass()
    {
        return RemoveIssueCommandHandler::class;
    }
}
