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

class MomentWasQueuedEvent implements MomentEventInterface
{
    /**
     * The moment object.
     *
     * @var \Gitamin\Models\Moment
     */
    public $moment;

    /**
     * Create a new moment was removed event instance.
     *
     * @param \Gitamin\Models\Moment $moment
     *
     * @return void
     */
    public function __construct(Moment $moment)
    {
        $this->moment = $moment;
    }
}
