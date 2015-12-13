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

class GeneralTest extends AbstractTestCase
{
    public function testGetPing()
    {
        $this->get('/api/v1/ping');
        $this->seeJson(['data' => 'Pong!']);
        $this->assertResponseOk();
        $this->seeHeader('Content-Type', 'application/json');
    }

    public function testErrorPage()
    {
        $this->get('/api/v1/not-found');

        $this->assertResponseStatus(404);
        $this->seeHeader('Content-Type', 'application/json');
    }

    public function testNotAcceptableContentType()
    {
        $this->get('/api/v1/ping', ['HTTP_Accept' => 'text/html']);

        $this->assertResponseStatus(406);
    }
}
