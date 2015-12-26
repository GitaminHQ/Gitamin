<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Test\Events\Issue;

use Gitamin\Events\Issue\IssueWasUpdatedEvent;
use Gitamin\Models\Issue;

class IssueWasUpdatedEventTest extends AbstractIssueEventTestCase
{
    protected function objectHasHandlers()
    {
        return false;
    }

    protected function getObjectAndParams()
    {
        $params = ['issue' => new Issue()];
        $object = new IssueWasUpdatedEvent($params['issue']);

        return compact('params', 'object');
    }
}
