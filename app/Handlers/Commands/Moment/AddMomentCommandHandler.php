<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Commands\Moment;

use Gitamin\Commands\Moment\AddMomentCommand;
use Gitamin\Dates\DateFactory;
//use Gitamin\Events\Moment\MomentWasAddedEvent;
use Gitamin\Models\Moment;

class AddMomentCommandHandler
{
    /**
     * The date factory instance.
     *
     * @var \Gitamin\Dates\DateFactory
     */
    protected $dates;

    /**
     * Create a new report moment command handler instance.
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
     * Handle the report moment command.
     *
     * @param \Gitamin\Commands\Moment\AddMomentCommand $command
     *
     * @return \Gitamin\Models\Moment
     */
    public function handle(AddMomentCommand $command)
    {
        $data = [
            'action'    => $command->action,
            'author_id' => $command->author_id,
        ];

        if ($command->title) {
            $data['title'] = $command->title;
        }
        if ($command->data) {
            $data['data'] = $command->data;
        }
        // Link with the target.
        if ($command->target_type) {
            $data['target_type'] = $command->target_type;
        }
        if ($command->target_id) {
            $data['target_id'] = $command->target_id;
        }
        // Link with the project.
        if ($command->project_id) {
            $data['project_id'] = $command->project_id;
        }

        // Create the moment
        $moment = Moment::create($data);

        //event(new MomentWasAddedEvent($moment));

        return $moment;
    }
}
