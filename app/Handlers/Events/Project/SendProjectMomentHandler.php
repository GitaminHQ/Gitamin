<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Events\Project;

use Gitamin\Commands\Moment\AddMomentCommand;
use Gitamin\Events\Project\ProjectEventInterface;
use Gitamin\Events\Project\ProjectWasRemovedEvent;
use Gitamin\Events\Project\ProjectWasUpdatedEvent;
use Gitamin\Models\Moment;
use Gitamin\Models\Project;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SendProjectMomentHandler
{
    use DispatchesJobs;

    /**
     * Handle the project updated moment.
     */
    public function handle(ProjectEventInterface $event)
    {
        if ($event instanceof ProjectWasUpdatedEvent) {
            $action = Moment::UPDATED;
        } elseif ($event instanceof ProjectWasRemovedEvent) {
            $action = Moment::CLOSED;
        } else {
            $action = Moment::CREATED;
        }

        $this->trigger($event->project, $action);
    }

    /**
     * Trigger the moment.
     *
     * @param \Gitamin\Models\Project $project
     * @param int                     $action
     */
    protected function trigger(Project &$project, $action)
    {
        $projectData = [
            'title' => '',
            'data' => '',
            'momentable_type' => 'Project',
            'momentable_id' => $project->id,
            'action' => $action,
            'author_id' => $project->creator_id,
            'project_id' => $project->id,
        ];

        $moment = $this->dispatchFromArray(AddMomentCommand::class, $projectData);
    }
}
