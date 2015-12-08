<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Commands\Note;

use Gitamin\Commands\Note\AddNoteCommand;
use Gitamin\Dates\DateFactory;
use Gitamin\Events\Note\NoteWasAddedEvent;
use Gitamin\Models\Note;
use Gitamin\Models\Project;

class AddNoteCommandHandler
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
     * Handle the report note command.
     *
     * @param \Gitamin\Commands\Issue\AddIssueCommand $command
     *
     * @return \Gitamin\Models\Issue
     */
    public function handle(AddNoteCommand $command)
    {
        $data = [
            'description'   => $command->description,
            'noteable_type' => $command->noteable_type,
            'noteable_id'   => $command->noteable_id,
        ];

        // Link with the user.
        if ($command->author_id) {
            $data['author_id'] = $command->author_id;
        }
        // Link with the project.
        if ($command->project_id) {
            $data['project_id'] = $command->project_id;
        }

        // Create the note
        $note = Note::create($data);

        event(new NoteWasAddedEvent($note));

        return $note;
    }
}
