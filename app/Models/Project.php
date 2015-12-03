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
use Gitamin\Presenters\ProjectPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class Project extends Model implements HasPresenter
{
    use SoftDeletes, ValidatingTrait;

    /**
     * List of attributes that have default values.
     *
     * @var mixed[]
     */
    protected $attributes = [
        'namespace_id' => 0,
        'description'  => '',
        'path'         => '',
        'creator_id'   => 0,
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id'           => 'int',
        'namespace_id' => 'int',
        'description'  => 'string',
        'path'         => 'string',
        'creator_id'   => 'int',
        'deleted_at'   => 'date',
    ];

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'visibility_level',
        'tags',
        'path',
        'creator_id',
        'namespace_id',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'             => 'required|string',
        'visibility_level' => 'int|required',
        'path'             => 'required|string|max:15',
    ];

    /**
     * Projects can belong to a group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class, 'namespace_id', 'id');
    }

     /**
     * Projects can belong to a namespace.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projectNamespace()
    {
        return $this->belongsTo(ProjectNamespace::class, 'namespace_id', 'id');
    }

    /**
     * Lookup all of the issues reported on the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function issues()
    {
        return $this->hasMany(Issue::class, 'project_id', 'id');
    }

    /**
     * Projects can have many tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Finds all projects by visibility_level.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int                                   $visibility_level
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisibilityLevel(Builder $query, $visibility_level)
    {
        return $query->where('visibility_level', $visibility_level);
    }

    /**
     * Finds all projects which don't have the given visibility_level.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int                                   $visibility_level
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotVisibilityLevel(Builder $query, $visibility_level)
    {
        return $query->where('visibility_level', '<>', $visibility_level);
    }

    /**
     * Looks up the human readable version of the visibility_level.
     *
     * @return string
     */
    public function getHumanVisibilityLevelAttribute()
    {
        return trans('gitamin.projects.status.'.$this->visibility_level);
    }

    /**
     * Returns the namespace on this project.
     *
     * @return string
     */
    public function getNamespaceAttribute()
    {
        return $this->projectNamespace->path;
    }

    /**
     * Returns all of the tags on this project.
     *
     * @return string
     */
    public function getTagsListAttribute()
    {
        $tags = $this->tags->map(function ($tag) {
            return $tag->name;
        });

        return implode(', ', $tags->toArray());
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return ProjectPresenter::class;
    }
}
