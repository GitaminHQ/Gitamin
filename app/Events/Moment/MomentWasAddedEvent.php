<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Events\Moment;

use Gitamin\Models\Moment;

final class MomentWasAddedEvent implements MomentEventInterface
{
    /**
     * The moment that has been reported.
     *
     * @var \Gitamin\Models\Moment
     */
    public $moment;

    /**
     * Create a new moment has reported event instance.
     */
    public function __construct(Moment $moment)
    {
        $this->moment = $moment;
    }
}
