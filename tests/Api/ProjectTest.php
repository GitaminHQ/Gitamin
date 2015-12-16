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

class ProjectTest extends AbstractTestCase
{
    use DatabaseMigrations;

    public function testGetProjects()
    {
        $projects = factory('Gitamin\Models\Project', 3)->create();

        $this->get('/api/v1/projects');
        $this->seeJson(['id' => $projects[0]->id]);
        $this->seeJson(['id' => $projects[1]->id]);
        $this->seeJson(['id' => $projects[2]->id]);
        $this->assertResponseOk();
    }

    public function testGetInvalidProject()
    {
        $this->get('/api/v1/projects/1');
        $this->assertResponseStatus(404);
    }

    public function testPostProjectUnauthorized()
    {
        $this->post('/api/v1/projects');

        $this->assertResponseStatus(401);
    }

    public function testPostProjectNoData()
    {
        $this->beUser();

        $this->post('/api/v1/projects');
        $this->assertResponseStatus(400);
    }

    public function testPostProject()
    {
        $this->beUser();

        $this->post('/api/v1/projects', [
            'name' => 'Foo',
            'description' => 'Bar',
            'visibility_level' => 0,
            'path' => 'Baidu',
            'creator_id' => 1,
            'owner_id' => 1,
        ]);
        $this->seeJson(['name' => 'Foo']);
        $this->assertResponseOk();
    }

    public function testPostProjectWithoutEnabledField()
    {
        $this->beUser();

        $this->post('/api/v1/projects', [
            'name' => 'Foo',
            'description' => 'Bar',
            'visibility_level' => 0,
            'path' => 'Alibaba',
            'creator_id' => 1,
            'owner_id' => 1,
        ]);
        //$this->seeJson(['name' => 'Foo', 'issues_enabled' => true]);
        $this->seeJson(['name' => 'Foo']);
        $this->assertResponseOk();
    }

    public function testPostDisabledProject()
    {
        $this->beUser();

        $this->post('/api/v1/projects', [
            'name' => 'Foo',
            'description' => 'Bar',
            'visibility_level' => 0,
            'path' => 'Tencent',
            'creator_id' => 1,
            'owner_id' => 1,
        ]);
        //$this->seeJson(['name' => 'Foo', 'issues_enabled' => false]);
        $this->seeJson(['name' => 'Foo']);
        $this->assertResponseOk();
    }

    public function testGetNewProject()
    {
        $project = factory('Gitamin\Models\Project')->create();

        $this->get('/api/v1/projects/1');
        $this->seeJson(['name' => $project->name]);
        $this->assertResponseOk();
    }

    public function testPutProject()
    {
        $this->beUser();
        $project = factory('Gitamin\Models\Project')->create();

        $this->put('/api/v1/projects/1', [
            'name' => 'Foo',
            'description' => 'Bar',
            'visibility_level' => 0,
            'path' => 'Baz',
            'creator_id' => 1,
            'owner_id' => 1,
        ]);
        $this->seeJson(['name' => 'Foo']);
        $this->assertResponseOk();
    }

    public function testDeleteProject()
    {
        $this->beUser();
        $project = factory('Gitamin\Models\Project')->create();

        $this->delete('/api/v1/projects/1');
        $this->assertResponseStatus(204);
    }
}
