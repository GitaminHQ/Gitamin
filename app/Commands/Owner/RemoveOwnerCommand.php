<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Commands\Owner;

use Gitamin\Models\Owner;

final class RemoveOwnerCommand
{
    /**
     * The project owner to remove.
     *
     * @var \Gitamin\Models\Owner
     */
    public $owner;

    /**
     * Create a new remove project owner command instance.
     *
     * @param \Gitamin\Models\Owner $owner
     */
    public function __construct(Owner $owner)
    {
        $this->owner = $owner;
    }
}
