<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Commands\Issue;

use Gitamin\Commands\Issue\RemoveIssueCommand;
use Gitamin\Events\Issue\IssueWasRemovedEvent;

class RemoveIssueCommandHandler
{
    /**
     * Handle the remove issue command.
     *
     * @param \Gitamin\Commands\Issue\RemoveIssueCommand $command
     *
     * @return void
     */
    public function handle(RemoveIssueCommand $command)
    {
        $issue = $command->issue;

        event(new IssueWasRemovedEvent($issue));

        $issue->delete();
    }
}
