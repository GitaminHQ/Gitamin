<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Test\Providers;

use GitaminHQ\BenchTest\LaravelTrait;
use GitaminHQ\BenchTest\ServiceProviderTrait;
use Gitamin\Providers\AppServiceProvider;
use Gitamin\Test\AbstractTestCase;

class AppServiceProviderTest extends AbstractTestCase
{
    use LaravelTrait, ServiceProviderTrait;

    protected function getServiceProviderClass($app)
    {
        return AppServiceProvider::class;
    }
}
