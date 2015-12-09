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

use Gitamin\Commands\Comment\RemoveCommentCommand;
use Gitamin\Handlers\Commands\Comment\RemoveCommentCommandHandler;
use Gitamin\Models\Comment;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the remove comment command test class.
 */
class RemoveCommentCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = ['comment' => new Comment()];
        $object = new RemoveCommentCommand($params['comment']);

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return false;
    }

    protected function getHandlerClass()
    {
        return RemoveCommentCommandHandler::class;
    }
}
