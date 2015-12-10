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

use Illuminate\Foundation\Bus\DispatchesJobs;
use Gitamin\Events\Project\ProjectEventInterface;
use Gitamin\Events\Project\ProjectWasAddedEvent;
use Gitamin\Events\Project\ProjectWasUpdatedEvent;
use Gitamin\Events\Project\ProjectWasRemovedEvent;
use Gitamin\Handlers\Commands\Moment\AddMomentCommandHandler;
use Gitamin\Commands\Moment\AddMomentCommand;
use Gitamin\Models\Project;
use Gitamin\Models\Moment;

class SendProjectMomentHandler
{

    use DispatchesJobs;

    /**
     * Handle the project updated moment.
     */
    public function handle(ProjectEventInterface $event)
    {
        if($event instanceof ProjectWasUpdateEvent) {
            $action = Moment::UPDATED;
        } else if ($event instanceof ProjectWasRemovedEvent) {
            $action = Moment::CLOSED;
        } else {
            $action = Moment::CREATED;
        }

        $this->trigger($event->project, Moment::CREATED);
    }

    /**
     * Trigger the moment.
     *
     * @param \Gitamin\Models\Project $project
     * @param int                     $action
     *
    */
    protected function trigger(Project &$project, $action)
    {
        $data = [
            'target_type' => 'Project',
            'target_id'   => $project->id,
            'action'      => $action,
            'author_id'   => $project->creator_id,
            'project_id'  => $project->id,
        ];
        $moment = Moment::create($data);
    }
}
