<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Tests\Commands\Comment;

use Gitamin\Commands\Comment\UpdateCommentCommand;
use Gitamin\Handlers\Commands\Comment\UpdateCommentCommandHandler;
use Gitamin\Models\Comment;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the update comment command test class.
 */
class UpdateCommentCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'comment' => new Comment(),
            'message' => 'Foo bar baz',
        ];
        $object = new UpdateCommentCommand(
            $params['comment'],
            $params['message']
        );

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return true;
    }

    protected function getHandlerClass()
    {
        return UpdateCommentCommandHandler::class;
    }
}
