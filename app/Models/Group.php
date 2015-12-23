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

    public static function boot()
    {
        static::addGlobalScope('type', function($builder) {
            $builder->where('type', 'Group');
        });

       parent::boot();
    }

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
