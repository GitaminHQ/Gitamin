<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Events\Note;

use Gitamin\Models\Note;

class NoteWasAddedEvent implements NoteEventInterface
{
    /**
     * The note that has been reported.
     *
     * @var \Gitamin\Models\Note
     */
    public $note;

    /**
     * Create a new note has reported event instance.
     *
     * @return void
     */
    public function __construct(Note $note)
    {
        $this->note = $note;
    }
}
