<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Tests\Events;

use Gitamin\Providers\EventServiceProvider;
use Gitamin\Tests\AbstractAnemicTestCase;
use ReflectionClass;

/**
 * This is the abstract event test case class.
 */
abstract class AbstractEventTestCase extends AbstractAnemicTestCase
{
    protected function objectHasRules()
    {
        return false;
    }

    protected function objectHasHandlers()
    {
        return true;
    }

    public function testEventImplementsTheCorrectInterfaces()
    {
        $event = $this->getObjectAndParams()['object'];

        foreach ($this->getEventInterfaces() as $interface) {
            $this->assertInstanceOf($interface, $event);
        }
    }

    public function testEventHasRegisteredHandlers()
    {
        $property = (new ReflectionClass(EventServiceProvider::class))->getProperty('listen');
        $property->setAccessible(true);

        $class = get_class($this->getObjectAndParams()['object']);
        $mappings = $property->getValue(new EventServiceProvider($this->app));

        $this->assertTrue(isset($mappings[$class]));

        if ($this->objectHasHandlers()) {
            $this->assertGreaterThan(0, count($mappings[$class]));
        } else {
            $this->assertSame(0, count($mappings[$class]));
        }

        foreach ($mappings[$class] as $handler) {
            $this->assertInstanceOf($handler, $this->app->make($handler));
        }
    }
}
