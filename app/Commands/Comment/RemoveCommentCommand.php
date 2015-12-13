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

final class RemoveCommentCommand
{
    /**
     * The comment to remove.
     *
     * @var \Gitamin\Models\Comment
     */
    public $comment;

    /**
     * Create a new remove comment command instance.
     *
     * @param \Gitamin\Models\Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}
