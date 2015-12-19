<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Models;

use Gitamin\Traits\OfTypeTrait;

class Group extends Owner
{
    use OfTypeTrait;

    protected $table = 'owners';

    /**
     * Returns group route.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('owners.owner_show', ['owner' => $this->path]);
    }
}
