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

use AltThree\Validator\ValidatingTrait;
use Gitamin\Presenters\IssuePresenter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class Issue extends Model implements HasPresenter
{
    use SoftDeletes, ValidatingTrait;

    /**
     * The accessors to append to the model's serialized form.
     *
     * @var string[]
     */
    protected $appends = ['human_status'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id'           => 'int',
        'visible'      => 'int',
        'deleted_at'   => 'date',
    ];

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'project_id',
        'name',
        'status',
        'visible',
        'message',
        'created_at',
        'updated_at',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'project_id' => 'int',
        'name'         => 'required',
        'status'       => 'required|int',
        'visible'      => 'required|bool',
        'message'      => 'required',
    ];

    /**
     * Finds all visible issues.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query)
    {
        return $query->where('visible', 1);
    }

    /**
     * An issue belongs to a project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    /**
     * Returns a human readable version of the status.
     *
     * @return string
     */
    public function getHumanStatusAttribute()
    {
        $statuses = trans('gitamin.issues.status');

        return $statuses[$this->status];
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return IssuePresenter::class;
    }
}
