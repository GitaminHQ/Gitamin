<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Events\Comment;

use Gitamin\Commands\Moment\AddMomentCommand;
use Gitamin\Events\Comment\CommentEventInterface;
use Gitamin\Events\Comment\CommentWasAddedEvent;
use Gitamin\Models\Comment;
use Gitamin\Models\Moment;

class SendCommentMomentHandler
{

    /**
     * Handle the comment updated moment.
     */
    public function handle(CommentEventInterface $event)
    {
        if ($event instanceof CommentWasAddedEvent) {
            $action = Moment::COMMENTED;
        } else {
            $action = Moment::COMMENTED;
        }

        $this->trigger($event->comment, $action);
    }

    /**
     * Trigger the moment.
     *
     * @param \Gitamin\Models\Comment $comment
     * @param int                     $action
     */
    protected function trigger(Comment &$comment, $action)
    {
        $moment = dispatch(new AddMomentCommand(
            '',
            '',
            'Comment',
            $comment->id,
            $action,
            $comment->author_id,
            $comment->project_id
        ));
    }
}
