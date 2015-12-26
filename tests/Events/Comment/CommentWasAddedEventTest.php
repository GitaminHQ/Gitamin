<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Test\Events\Comment;

use Gitamin\Events\Comment\CommentWasAddedEvent;
use Gitamin\Models\Comment;

class CommentWasAddedEventTest extends AbstractCommentEventTestCase
{
    protected function objectHasHandlers()
    {
        return true;
    }

    protected function getObjectAndParams()
    {
        $params = ['comment' => new Comment()];
        $object = new CommentWasAddedEvent($params['comment']);

        return compact('params', 'object');
    }
}
