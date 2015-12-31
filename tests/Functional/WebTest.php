<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Test\Functional;

use Gitamin\Test\AbstractTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WebTest extends AbstractTestCase
{
    use DatabaseMigrations;

    public function testHomepageWithoutAuth()
    {
        $this->get('/');

        $this->assertResponseStatus(302);
    }

    public function testFeedRss()
    {
        $this->get('/rss');

        $this->assertResponseOK();
        $this->seeHeader('Content-Type', 'application/rss+xml; charset=utf-8');
        $this->see($this->baseUrl.'/rss');
        $this->see('Project Feed');
    }

    public function testFeedAtom()
    {
        $this->get('/atom');

        $this->assertResponseOK();
        $this->seeHeader('Content-Type', 'application/atom+xml; charset=utf-8');
        $this->see($this->baseUrl.'/atom');
        $this->see('Project Feed');
    }

    /*
    public function testAuthLogin()
    {
        $this->get('/auth/login');
        $this->assertResponseOK();
        $this->see('<div class="panel-heading">Sign in</div>');
    }

    public function testAuthLoginWithBadToken()
    {
        $this->post('/auth/login');
        $this->assertResponseStatus(400);
    }

    public function testProfileWithoutAuth()
    {
        $this->get('/profile');
        $this->assertResponseStatus(302);
        $this->see('auth/login');
    }
    */
}
