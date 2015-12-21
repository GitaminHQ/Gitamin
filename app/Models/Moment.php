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

use Gitamin\Presenters\MomentPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;

class Moment extends Model implements HasPresenter
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
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id' => 'int',
        'deleted_at' => 'date',
    ];

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'momentable_type',
        'momentable_id',
        'action',
        'author_id',
        'project_id',
        'title',
        'data',
        'created_at',
        'updated_at',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'momentable_type' => 'string',
        'momentable_id' => 'int',
        'action' => 'int',
        'author_id' => 'int',
        'project_id' => 'int',
        'title' => 'string',
        'data' => 'string',
    ];

    /**
     * Get all of the owning momentable models.
     */
    public function momentable()
    {
        return $this->morphTo();
    }

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
     * A moment belongs to a project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
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

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return MomentPresenter::class;
    }
}
