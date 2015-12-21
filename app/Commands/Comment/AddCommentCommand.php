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
     * The comment commentable_type.
     *
     * @var string
     */
    public $commentable_type;

    /**
     * The comment commentable_id.
     *
     * @var int
     */
    public $commentable_id;

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
        'commentable_type' => 'required|string',
        'commentable_id' => 'required|int',
        'author_id' => 'int',
        'project_id' => 'int',
    ];

    /**
     * Create a new add comment command instance.
     *
     * @param string $message
     * @param string $commentable_type
     * @param int    $commentable_id
     * @param int    $author_id
     * @param int    $project_id
     */
    public function __construct($message, $commentable_type, $commentable_id, $author_id, $project_id)
    {
        $this->message = $message;
        $this->commentable_type = $commentable_type;
        $this->commentable_id = $commentable_id;
        $this->author_id = $author_id;
        $this->project_id = $project_id;
    }
}
