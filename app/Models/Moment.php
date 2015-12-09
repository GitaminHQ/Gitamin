<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

# == Schema Information
#
# Table name: moments
#
#  id          :integer          not null, primary key
#  target_type :string(255)
#  target_id   :integer
#  title       :string(255)
#  data        :text
#  project_id  :integer
#  created_at  :timestamp
#  updated_at  :timestamp
#  action      :integer
#  author_id   :integer
#

namespace Gitamin\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Moment extends Model
{
    const CREATED = 1;
    const UPDATED = 2;
    const CLOSED = 3;
    const REOPENED = 4;
    const PUSHED = 5;
    const COMMENTED = 6;
    const MERGED = 7;
    const JOINED = 8; # User joined project
    const LEFT = 9; # User left project
    const DESTROYED = 10;

    /**
     * Finds all rencent moments.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRecent(Builder $query)
    {
        return $query->orderBy('id', 'desc');
    }

    /**
     * Finds all code push moments.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCodePush(Builder $query)
    {
        return $query->where('action', '=', self::PUSHED);
    }

    /**
     * Moments can belong to an author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
