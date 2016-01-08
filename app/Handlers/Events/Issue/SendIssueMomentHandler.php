<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Events\Issue;

use Gitamin\Commands\Moment\AddMomentCommand;
use Gitamin\Events\Issue\IssueEventInterface;
use Gitamin\Events\Issue\IssueWasAddedEvent;
use Gitamin\Models\Issue;
use Gitamin\Models\Moment;

class SendIssueMomentHandler
{
    /**
     * Handle the issue updated moment.
     */
    public function handle(IssueEventInterface $event)
    {
        if ($event instanceof IssueWasAddedEvent) {
            $action = Moment::CREATED;
        } else {
            $action = Moment::CREATED;
        }

        $this->trigger($event->issue, $action);
    }

    /**
     * Trigger the moment.
     *
     * @param \Gitamin\Models\Issue $issue
     * @param int                     $action
     */
    protected function trigger(Issue &$issue, $action)
    {
        $moment = dispatch(new AddMomentCommand(
            '',
            '',
            'Issue',
            $issue->id,
            $action,
            $issue->author_id,
            $issue->project_id
        ));
    }
}
