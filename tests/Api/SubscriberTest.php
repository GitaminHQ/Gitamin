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

class SubscriberTest extends AbstractTestCase
{
    use DatabaseMigrations;

    public function testGetSubscribersUnauthenticated()
    {
        $this->get('/api/v1/subscribers');
        $this->assertResponseStatus(401);
        $this->seeHeader('Content-Type', 'application/json');
    }

    public function testGetSubscribers()
    {
        $this->beUser();

        $subscriber = factory('Gitamin\Models\Subscriber')->create();

        $this->get('/api/v1/subscribers');
        $this->seeHeader('Content-Type', 'application/json');
        $this->assertResponseOk();
    }

    public function testCreateSubscriber()
    {
        $this->beUser();

        $this->expectsEvents('Gitamin\Events\Subscriber\SubscriberHasSubscribedEvent');

        $this->post('/api/v1/subscribers', [
            'email' => 'gitamin@gitamin.com',
        ]);
        $this->assertResponseOk();
        $this->seeHeader('Content-Type', 'application/json');
        $this->seeJson(['email' => 'gitamin@gitamin.com']);
    }

    public function testCreateSubscriberAutoVerified()
    {
        $this->beUser();

        $this->post('/api/v1/subscribers', [
            'email'  => 'gitamin@gitamin.com',
            'verify' => true,
        ]);
        $this->assertResponseOk();
        $this->seeHeader('Content-Type', 'application/json');
        $this->seeJson(['email' => 'gitamin@gitamin.com']);
    }

    public function testDeleteSubscriber()
    {
        $this->beUser();

        $subscriber = factory('Gitamin\Models\Subscriber')->create();
        $this->delete("/api/v1/subscribers/{$subscriber->id}");
        $this->assertResponseStatus(204);
    }
}
