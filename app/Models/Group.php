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

class Group extends Owner
{
    protected $table = 'owners';

    /**
     * Finds all groups.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsGroup($query)
    {
        return $query->where('type', 'Group');
    }

    /**
     * Returns group route.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('groups.group_show', ['owner' => $this->path]);
    }
}
