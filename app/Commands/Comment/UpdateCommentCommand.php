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

use Gitamin\Models\Comment;

final class UpdateCommentCommand
{
    /**
     * The comment to update.
     *
     * @var \Gitamin\Models\Comment
     */
    public $comment;

    /**
     * The comment message.
     *
     * @var string
     */
    public $message;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'message' => 'required|string',
    ];

    /**
     * Create a new update comment command instance.
     *
     * @param string $message
     */
    public function __construct(Comment $comment, $message)
    {
        $this->comment = $comment;
        $this->message = $message;
    }
}
