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

use Gitamin\Commands\Issue\UpdateIssueCommand;
use Gitamin\Dates\DateFactory;
use Gitamin\Events\Issue\IssueWasUpdatedEvent;
use Gitamin\Models\Issue;

class UpdateIssueCommandHandler
{
    /**
     * The date factory instance.
     *
     * @var \Gitamin\Dates\DateFactory
     */
    protected $dates;

    /**
     * Create a new update issue command handler instance.
     *
     * @param \Gitamin\Dates\DateFactory $dates
     */
    public function __construct(DateFactory $dates)
    {
        $this->dates = $dates;
    }

    /**
     * Handle the update issue command.
     *
     * @param \Gitamin\Commands\Issue\UpdateIssueCommand $command
     *
     * @return \Gitamin\Models\Issue
     */
    public function handle(UpdateIssueCommand $command)
    {
        $issue = $command->issue;
        $issue->update($this->filter($command));

        // The issue occurred at a different time.
        /*
        if ($command->issue_date) {
            $issueDate = $this->dates->createNormalized('d/m/Y H:i', $command->issue_date);

            $issue->update([
                'created_at' => $issueDate,
                'updated_at' => $issueDate,
            ]);
        }
        */

        event(new IssueWasUpdatedEvent($issue));

        return $issue;
    }

    /**
     * Filter the command data.
     *
     * @param \Gitamin\Commands\Issue\UpdateIssueCommand $command
     *
     * @return array
     */
    protected function filter(UpdateIssueCommand $command)
    {
        $params = [
            'title' => $command->title,
            'description' => $command->description,
            'author_id' => $command->author_id,
            'project_id' => $command->project_id,
        ];

        return array_filter($params, function ($val) {
            return $val !== null;
        });
    }
}
