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

use Carbon\Carbon;
use Gitamin\Commands\Issue\AddIssueCommand;
use Gitamin\Models\Issue;

class AddIssueCommandHandler
{
    /**
     * Handle the add isssue command.
     *
     * @param \Gitamin\Commands\Issue\AddIssueCommand $command
     *
     * @return \Gitamin\Models\Issue
     */
    public function handle(AddIssueCommand $command)
    {
        $data = [
            'author_id'   => $command->authorId,
            'project_id'  => $command->projectId,
            'title'       => $command->title,
            'description' => $command->description,
            'created_at'  => Carbon::now()->toDateTimeString(),
        ];
        // Create the issue
        $issue = Issue::create($data);

        return $issue;
    }
}
