<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Tests\Api;

use Gitamin\Tests\AbstractTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommentTest extends AbstractTestCase
{
    use DatabaseMigrations;

    public function testPostComment()
    {
        $this->beUser();

        $this->post('/api/v1/comments', [
            'message'     => 'Foo',
            'target_type' => 'Issue',
            'target_id'   => 1,
            'author_id'   => 1,
            'project_id'  => 1,
        ]);
        $this->seeJson(['message' => 'Foo']);
        $this->assertResponseOk();
    }
}
