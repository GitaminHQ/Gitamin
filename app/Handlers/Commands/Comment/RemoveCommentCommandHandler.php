<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Commands\Comment;

use Gitamin\Commands\Comment\RemoveCommentCommand;
use Gitamin\Events\Comment\CommentWasRemovedEvent;

class RemoveCommentCommandHandler
{
    /**
     * Handle the remove comment command.
     *
     * @param \Gitamin\Commands\Comment\RemoveCommentCommand $command
     */
    public function handle(RemoveCommentCommand $command)
    {
        $comment = $command->comment;

        event(new CommentWasRemovedEvent($comment));

        $comment->delete();
    }
}
