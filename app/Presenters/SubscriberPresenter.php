<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Presenters;

use Gitamin\Traits\TimestampsTrait;
use Jenssegers\Date\Date;

class SubscriberPresenter extends AbstractPresenter
{
    use TimestampsTrait;

    /**
     * Present formatted date time.
     *
     * @return string
     */
    public function verified_at()
    {
        return (new Date($this->wrappedObject->verified_at))
            ->setTimezone($this->setting->get('app_timezone'))->toDateTimeString();
    }

    /**
     * Convert the presenter instance to an array.
     *
     * @return string[]
     */
    public function toArray()
    {
        return array_merge($this->wrappedObject->toArray(), [
            'created_at' => $this->created_at(),
            'updated_at' => $this->updated_at(),
            'verified_at' => $this->verified_at(),
        ]);
    }
}
