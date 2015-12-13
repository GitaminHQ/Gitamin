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

use Gitamin\Commands\Issue\AddIssueCommand;
use Gitamin\Dates\DateFactory;
use Gitamin\Events\Issue\IssueWasAddedEvent;
use Gitamin\Models\Issue;
use Gitamin\Models\Project;

class AddIssueCommandHandler
{
    /**
     * The date factory instance.
     *
     * @var \Gitamin\Dates\DateFactory
     */
    protected $dates;

    /**
     * Create a new report issue command handler instance.
     *
     * @param \Gitamin\Dates\DateFactory $dates
     */
    public function __construct(DateFactory $dates)
    {
        $this->dates = $dates;
    }

    /**
     * Handle the report issue command.
     *
     * @param \Gitamin\Commands\Issue\AddIssueCommand $command
     *
     * @return \Gitamin\Models\Issue
     */
    public function handle(AddIssueCommand $command)
    {
        $data = [
            'title' => $command->title,
            'description' => $command->description,
        ];

        // Link with the user.
        if ($command->author_id) {
            $data['author_id'] = $command->author_id;
        }
        // Link with the project.
        if ($command->project_id) {
            $data['project_id'] = $command->project_id;
        }

        // Create the issue
        $issue = Issue::create($data);

        event(new IssueWasAddedEvent($issue));

        return $issue;
    }
}
