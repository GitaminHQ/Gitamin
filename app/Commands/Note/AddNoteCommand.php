<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Commands\Note;

final class AddNoteCommand
{
    /**
     * The note description.
     *
     * @var string
     */
    public $description;

    /**
     * The note noteable_type.
     *
     * @var string
     */
    public $noteable_type;

    /**
     * The note noteable_id.
     *
     * @var int
     */
    public $noteable_id;

    /**
     * The issue user.
     *
     * @var int
     */
    public $author_id;

    /**
     * The issue project.
     *
     * @var int
     */
    public $project_id;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'description'   => 'required|string',
        'noteable_type' => 'required|string',
        'noteable_id'   => 'required|int',
        'author_id'     => 'int',
        'project_id'    => 'int',
    ];

    /**
     * Create a new add issue command instance.
     *
     * @param string $description
     * @param string $noteable_type
     * @param int    $noteable_id
     * @param int    $author_id
     * @param int    $project_id
     *
     * @return void
     */
    public function __construct($description, $noteable_type, $noteable_id, $author_id, $project_id)
    {
        $this->description = $description;
        $this->noteable_type = $noteable_type;
        $this->noteable_id = $noteable_id;
        $this->author_id = $author_id;
        $this->project_id = $project_id;
    }
}
