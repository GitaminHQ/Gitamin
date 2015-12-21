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

use Gitamin\Commands\Comment\AddCommentCommand;
use Gitamin\Dates\DateFactory;
use Gitamin\Events\Comment\CommentWasAddedEvent;
use Gitamin\Models\Comment;
use Gitamin\Models\Project;

class AddCommentCommandHandler
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
     */
    public function __construct(DateFactory $dates)
    {
        $this->dates = $dates;
    }

    /**
     * Handle the report comment command.
     *
     * @param \Gitamin\Commands\Comment\AddCommentCommand $command
     *
     * @return \Gitamin\Models\Comment
     */
    public function handle(AddCommentCommand $command)
    {
        $data = [
            'message' => $command->message,
            'commentable_type' => 'Gitamin\\Models\\'.$command->commentable_type,
            'commentable_id' => $command->commentable_id,
        ];

        // Link with the user.
        if ($command->author_id) {
            $data['author_id'] = $command->author_id;
        }
        // Link with the project.
        if ($command->project_id) {
            $data['project_id'] = $command->project_id;
        }

        // Create the comment
        $comment = Comment::create($data);

        event(new CommentWasAddedEvent($comment));

        return $comment;
    }
}
