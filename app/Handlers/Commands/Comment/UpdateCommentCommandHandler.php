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

use Gitamin\Commands\Comment\UpdateCommentCommand;
use Gitamin\Dates\DateFactory;
use Gitamin\Events\Comment\CommentWasUpdatedEvent;
use Gitamin\Models\Comment;

class UpdateCommentCommandHandler
{
    /**
     * The date factory instance.
     *
     * @var \Gitamin\Dates\DateFactory
     */
    protected $dates;

    /**
     * Create a new update comment command handler instance.
     *
     * @param \Gitamin\Dates\DateFactory $dates
     */
    public function __construct(DateFactory $dates)
    {
        $this->dates = $dates;
    }

    /**
     * Handle the update comment command.
     *
     * @param \Gitamin\Commands\Comment\UpdateCommentCommand $command
     *
     * @return \Gitamin\Models\Comment
     */
    public function handle(UpdateCommentCommand $command)
    {
        $comment = $command->comment;
        $comment->update($this->filter($command));

        event(new CommentWasUpdatedEvent($comment));

        return $comment;
    }

    /**
     * Filter the command data.
     *
     * @param \Gitamin\Commands\Comment\UpdateCommentCommand $command
     *
     * @return array
     */
    protected function filter(UpdateCommentCommand $command)
    {
        $params = [
            'message' => $command->message,
        ];

        return array_filter($params, function ($val) {
            return $val !== null;
        });
    }
}
