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
            'name'    => 'Foo',
            'message' => 'Lorem ipsum dolor sit amet',
            'user_id' => $this->user->id,
            'status'  => 1,
            'visible' => 1,
        ]);
        $this->seeJson(['name' => 'Foo']);
        $this->assertResponseOk();
    }

    public function testGetNewIssue()
    {
        $issue = factory('Gitamin\Models\Issue')->create();

        $this->get('/api/v1/issues/1');
        $this->seeJson(['name' => $issue->name]);
        $this->assertResponseOk();
    }

    public function testPutIssue()
    {
        $this->beUser();
        $project = factory('Gitamin\Models\Issue')->create();

        $this->put('/api/v1/issues/1', [
            'name' => 'Foo',
        ]);
        $this->seeJson(['name' => 'Foo']);
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
