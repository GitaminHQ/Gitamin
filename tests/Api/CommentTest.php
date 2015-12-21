<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Test\Api;

use Gitamin\Test\AbstractTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommentTest extends AbstractTestCase
{
    use DatabaseMigrations;

    public function testGetComments()
    {
        $comments = factory('Gitamin\Models\Comment', 3)->create();

        $this->get('/api/v1/comments');
        $this->seeJson(['id' => $comments[0]->id]);
        $this->seeJson(['id' => $comments[1]->id]);
        $this->seeJson(['id' => $comments[2]->id]);
        $this->assertResponseOk();
    }

    public function testGetInvalidComment()
    {
        $this->get('/api/v1/comments/0');
        $this->assertResponseStatus(404);
    }

    public function testPostCommentUnauthorized()
    {
        $this->post('/api/v1/comments');
        $this->assertResponseStatus(401);
    }

    public function testPostCommentNoData()
    {
        $this->beUser();

        $this->post('/api/v1/comments');
        $this->assertResponseStatus(400);
    }

    public function testPostComment()
    {
        $this->beUser();

        $this->post('/api/v1/comments', [
            'message' => 'Lorem ipsum dolor sit amet',
            'commentable_type' => 'Issue',
            'commentable_id' => 1,
            'author_id' => $this->user->id,
            'project_id' => 1,
        ]);
        $this->seeJson(['message' => 'Lorem ipsum dolor sit amet']);
        $this->assertResponseOk();
    }

    public function testGetNewComment()
    {
        $comment = factory('Gitamin\Models\Comment')->create();

        $this->get('/api/v1/comments/1');
        $this->seeJson(['message' => $comment->message]);
        $this->assertResponseOk();
    }

    public function testPutComment()
    {
        $this->beUser();
        $comment = factory('Gitamin\Models\Comment')->create();

        $this->put('/api/v1/comments/1', [
            'message' => 'Foo bar baz',
        ]);
        $this->seeJson(['message' => 'Foo bar baz']);
        $this->assertResponseOk();
    }

    public function testDeleteComment()
    {
        $this->beUser();
        $project = factory('Gitamin\Models\Comment')->create();

        $this->delete('/api/v1/comments/1');
        $this->assertResponseStatus(204);
    }
}
