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
     *
     * @return void
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
            'name'    => $command->name,
            'status'  => $command->status,
            'message' => $command->message,
            'visible' => $command->visible,
        ];

        // Link with the project.
        if ($command->project_id) {
            $data['project_id'] = $command->project_id;
        }

        // The issue occurred at a different time.
        if ($command->issue_date) {
            $issueDate = $this->dates->createNormalized('d/m/Y H:i', $command->issue_date);

            $data['created_at'] = $issueDate;
            $data['updated_at'] = $issueDate;
        }

        // Create the issue
        $issue = Issue::create($data);

        // Update the project.
        if ($command->project_id) {
            Project::find($command->project_id)->update([
                'status' => $command->project_status,
            ]);
        }

        $issue->notify = (bool) $command->notify;

        event(new IssueWasAddedEvent($issue));

        return $issue;
    }
}
