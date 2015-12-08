<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Tests\Commands\Note;

use Gitamin\Commands\Note\AddNoteCommand;
use Gitamin\Handlers\Commands\Note\AddNoteCommandHandler;
use Gitamin\Tests\Commands\AbstractCommandTestCase;

/**
 * This is the add note command test class.
 */
class AddNoteCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'description'   => 'Foo bar baz',
            'noteable_type' => 'issue',
            'noteable_id'   => 1,
            'author_id'     => 1,
            'project_id'    => 1,
        ];
        $object = new AddNoteCommand(
            $params['description'],
            $params['noteable_type'],
            $params['noteable_id'],
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
        return AddNoteCommandHandler::class;
    }
}
