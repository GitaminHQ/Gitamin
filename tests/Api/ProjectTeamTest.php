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

class ProjectTeamTest extends AbstractTestCase
{
    use DatabaseMigrations;

    public function testGetTeams()
    {
        $teams = factory('Gitamin\Models\ProjectTeam', 3)->create();

        $this->get('/api/v1/projects/teams');
        $this->seeJson(['id' => $teams[0]->id]);
        $this->seeJson(['id' => $teams[1]->id]);
        $this->seeJson(['id' => $teams[2]->id]);
        $this->assertResponseOk();
    }

    public function testGetInvalidTeam()
    {
        $this->get('/api/v1/projects/teams/1');
        $this->assertResponseStatus(404);
    }

    public function testPostTeamUnauthorized()
    {
        $this->post('/api/v1/projects/teams');

        $this->assertResponseStatus(401);
    }

    public function testPostTeamNoData()
    {
        $this->beUser();

        $this->post('/api/v1/projects/teams');
        $this->assertResponseStatus(400);
    }

    public function testPostTeam()
    {
        $this->beUser();

        $this->post('/api/v1/projects/teams', [
            'name'  => 'Foo',
            'slug'  => 'foo',
            'order' => 1,
        ]);
        $this->seeJson(['name' => 'Foo']);
        $this->assertResponseOk();
    }

    public function testGetNewTeam()
    {
        $team = factory('Gitamin\Models\ProjectTeam')->create();

        $this->get('/api/v1/projects/teams/1');
        $this->seeJson(['name' => $team->name]);
        $this->assertResponseOk();
    }

    public function testPutTeam()
    {
        $this->beUser();
        $team = factory('Gitamin\Models\ProjectTeam')->create();

        $this->put('/api/v1/projects/teams/1', [
            'name' => 'Lorem Ipsum Groupous',
            'slug' => 'lig',
        ]);
        $this->seeJson(['name' => 'Lorem Ipsum Groupous']);
        $this->assertResponseOk();
    }

    public function testDeleteTeam()
    {
        $this->beUser();
        $team = factory('Gitamin\Models\ProjectTeam')->create();

        $this->delete('/api/v1/projects/teams/1');
        $this->assertResponseStatus(204);
    }
}
