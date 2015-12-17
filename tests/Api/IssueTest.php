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

class IssueTest extends AbstractTestCase
{
    use DatabaseMigrations;

    public function testGetIssues()
    {
        $issues = factory('Gitamin\Models\Issue', 3)->create();

        $this->get('/api/v1/issues');
        $this->seeJson(['id' => $issues[0]->id]);
        $this->seeJson(['id' => $issues[1]->id]);
        $this->seeJson(['id' => $issues[2]->id]);
        $this->assertResponseOk();
    }

    public function testGetInvalidIssue()
    {
        $this->get('/api/v1/issues/0');
        $this->assertResponseStatus(404);
    }

    public function testPostIssueUnauthorized()
    {
        $this->post('/api/v1/issues');
        $this->assertResponseStatus(401);
    }

    public function testPostIssueNoData()
    {
        $this->beUser();

        $this->post('/api/v1/issues');
        $this->assertResponseStatus(400);
    }

    public function testPostIssue()
    {
        $this->beUser();

        $this->post('/api/v1/issues', [
            'title' => 'Foo',
            'description' => 'Lorem ipsum dolor sit amet',
            'author_id' => $this->user->id,
            'project_id' => 1,
            'assignee_id' => 0,
        ]);
        $this->seeJson(['title' => 'Foo']);
        $this->assertResponseOk();
    }

    public function testGetNewIssue()
    {
        $issue = factory('Gitamin\Models\Issue')->create();

        $this->get('/api/v1/issues/1');
        $this->seeJson(['title' => $issue->title]);
        $this->assertResponseOk();
    }

    public function testPutIssue()
    {
        $this->beUser();
        $issue = factory('Gitamin\Models\Issue')->create();

        $this->put('/api/v1/issues/1', [
            'title' => 'Foo',
            'description' => 'Lorem ipsum dolor sit amet',
            'author_id' => $this->user->id,
            'project_id' => 1,
            'assignee_id' => 0,
        ]);
        $this->seeJson(['title' => 'Foo']);
        $this->assertResponseOk();
    }

    public function testDeleteIssue()
    {
        $this->beUser();
        $project = factory('Gitamin\Models\Issue')->create();

        $this->delete('/api/v1/issues/1');
        $this->assertResponseStatus(204);
    }
}
