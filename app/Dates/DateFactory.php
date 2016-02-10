<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Dates;

use Jenssegers\Date\Date;

class DateFactory
{
    /**
     * The application timezone.
     *
     * @var string
     */
    protected $appTimezone;

    /**
     * The gitamin timezone.
     *
     * @var string
     */
    protected $gitaminTimezone;

    /**
     * Create a new date factory instance.
     *
     * @param string $appTimezone
     * @param string $gitaminTimezone
     */
    public function __construct($appTimezone, $gitaminTimezone)
    {
        $this->appTimezone = $appTimezone;
        $this->gitaminTimezone = $gitaminTimezone;
    }

    /**
     * Create a Carbon instance from a specific format.
     *
     * @param string $format
     * @param string $time
     *
     * @throws \InvalidArgumentException
     *
     * @return \Carbon\Carbon
     */
    public function create($format, $time)
    {
        return Date::createFromFormat($format, $time, $this->gitaminTimezone)->setTimezone($this->appTimezone);
    }

    /**
     * Create a Carbon instance from a specific format.
     *
     * We're also going to make sure the timezone information is correct.
     *
     * @param string $format
     * @param string $time
     *
     * @throws \InvalidArgumentException
     *
     * @return \Carbon\Carbon
     */
    public function createNormalized($format, $time)
    {
        return $this->create($format, $time)->setTimezone($this->appTimezone);
    }

    /**
     * Make a Carbon instance from a string.
     *
     * @param string|null $time
     *
     * @throws \InvalidArgumentException
     *
     * @return \Carbon\Carbon
     */
    public function make($time = null)
    {
        return (new Date($time))->setTimezone($this->gitaminTimezone);
    }
}
