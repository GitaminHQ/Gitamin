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

class OwnerTest extends AbstractTestCase
{
    use DatabaseMigrations;

    public function testGetOwners()
    {
        $teams = factory('Gitamin\Models\Owner', 3)->create();

        $this->get('/api/v1/owners');
        $this->seeJson(['id' => $teams[0]->id]);
        $this->seeJson(['id' => $teams[1]->id]);
        $this->seeJson(['id' => $teams[2]->id]);
        $this->assertResponseOk();
    }

    public function testGetInvalidOwner()
    {
        $this->get('/api/v1/owners/1');
        $this->assertResponseStatus(404);
    }

    public function testPostOwnerUnauthorized()
    {
        $this->post('/api/v1/owners');

        $this->assertResponseStatus(401);
    }

    public function testPostOwnerNoData()
    {
        $this->beUser();

        $this->post('/api/v1/owners');
        $this->assertResponseStatus(400);
    }

    public function testPostOwner()
    {
        $this->beUser();

        $this->post('/api/v1/owners', [
            'name' => 'Foo',
            'path' => 'foo',
            'user_id' => $this->user->id,
            'description' => 'Bar',
            'type' => 'Group',
        ]);
        $this->seeJson(['name' => 'Foo']);
        $this->assertResponseOk();
    }

    public function testGetNewOwner()
    {
        $team = factory('Gitamin\Models\Owner')->create();

        $this->get('/api/v1/owners/1');
        $this->seeJson(['name' => $team->name]);
        $this->assertResponseOk();
    }

    public function testPutOwner()
    {
        $this->beUser();
        $team = factory('Gitamin\Models\Owner')->create();

        $this->put('/api/v1/owners/1', [
            'name' => 'Lorem Ipsum Groupous',
            'path' => 'lig',
            'user_id' => $this->user->id,
            'description' => 'Bar',
            'type' => 'Group',
        ]);
        $this->seeJson(['name' => 'Lorem Ipsum Groupous']);
        $this->assertResponseOk();
    }

    public function testDeleteOwner()
    {
        $this->beUser();
        $team = factory('Gitamin\Models\Owner')->create();

        $this->delete('/api/v1/owners/1');
        $this->assertResponseStatus(204);
    }
}
