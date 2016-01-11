<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Traits;

use Illuminate\Support\Facades\Config;
use Jenssegers\Date\Date;

trait TimestampsTrait
{
    /**
     * Present formatted date time.
     *
     * @return string
     */
    public function created_at()
    {
        return (new Date($this->wrappedObject->created_at))
            ->setTimezone(Config::get('gitamin.timezone'))->toDateTimeString();
    }

    /**
     * Present diff for humans date time.
     *
     * @return string
     */
    public function created_at_diff()
    {
        return (new Date($this->wrappedObject->created_at))
            ->setTimezone(Config::get('gitamin.timezone'))
            ->diffForHumans();
    }

    /**
     * Present formatted date time.
     *
     * @return string
     */
    public function created_at_formatted()
    {
        return ucfirst((new Date($this->wrappedObject->created_at))
            ->setTimezone(Config::get('gitamin.timezone'))
            ->format(Config::get('setting.issue_date_format', 'l jS F Y H:i:s')));
    }

    /**
     * Present formatted date time.
     *
     * @return string
     */
    public function created_at_iso()
    {
        return $this->wrappedObject->created_at->setTimezone(Config::get('gitamin.timezone'))->toISO8601String();
    }

    /**
     * Present formatted date time.
     *
     * @return string
     */
    public function updated_at()
    {
        return (new Date($this->wrappedObject->updated_at))
            ->setTimezone(Config::get('gitamin.timezone'))->toDateTimeString();
    }

    /**
     * Present formatted date time.
     *
     * @return string
     */
    public function deleted_at()
    {
        return (new Date($this->wrappedObject->deleted_at))
            ->setTimezone(Config::get('gitamin.timezone'))->toDateTimeString();
    }
}
