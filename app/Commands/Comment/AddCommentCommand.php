<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Commands\Comment;

final class AddCommentCommand
{
    /**
     * The comment message.
     *
     * @var string
     */
    public $message;

    /**
     * The comment target_type.
     *
     * @var string
     */
    public $target_type;

    /**
     * The comment target_id.
     *
     * @var int
     */
    public $target_id;

    /**
     * The comment user.
     *
     * @var int
     */
    public $author_id;

    /**
     * The comment project.
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
        'message' => 'required|string',
        'target_type' => 'required|string',
        'target_id' => 'required|int',
        'author_id' => 'int',
        'project_id' => 'int',
    ];

    /**
     * Create a new add comment command instance.
     *
     * @param string $message
     * @param string $target_type
     * @param int    $target_id
     * @param int    $author_id
     * @param int    $project_id
     */
    public function __construct($message, $target_type, $target_id, $author_id, $project_id)
    {
        $this->message = $message;
        $this->target_type = $target_type;
        $this->target_id = $target_id;
        $this->author_id = $author_id;
        $this->project_id = $project_id;
    }
}
