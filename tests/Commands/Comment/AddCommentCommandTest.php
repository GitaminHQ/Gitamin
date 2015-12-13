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

use Gitamin\Commands\Comment\AddCommentCommand;
use Gitamin\Handlers\Commands\Comment\AddCommentCommandHandler;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the add comment command test class.
 */
class AddCommentCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'message'     => 'Foo bar baz',
            'target_type' => 'Issue',
            'target_id'   => 1,
            'author_id'   => 1,
            'project_id'  => 1,
        ];
        $object = new AddCommentCommand(
            $params['message'],
            $params['target_type'],
            $params['target_id'],
            $params['author_id'],
            $params['project_id']
        );

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return true;
    }

    protected function getHandlerClass()
    {
        return AddCommentCommandHandler::class;
    }
}
