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
# Table name: projects
#
#  id                     :integer          not null, primary key
#  name                   :string(255)
#  path                   :string(255)
#  description            :text
#  created_at             :timestamp
#  updated_at             :timestamp
#  creator_id             :integer
#  issues_enabled         :boolean          default(TRUE), not null
#  wall_enabled           :boolean          default(TRUE), not null
#  pull_requests_enabled  :boolean          default(TRUE), not null
#  wiki_enabled           :boolean          default(TRUE), not null
#  owner_id               :integer
#  issues_tracker         :string(255)      default("gitlab"), not null
#  issues_tracker_id      :string(255)
#  snippets_enabled       :boolean          default(TRUE), not null
#  last_activity_at       :timestamp
#  import_url             :string(255)
#  visibility_level       :integer          default(0), not null
#  archived               :boolean          default(FALSE), not null
#  avatar                 :string(255)
#  import_status          :string(255)
#  repository_size        :float            default(0.0)
#  star_count             :integer          default(0), not null
#  import_type            :string(255)
#  import_source          :string(255)
#  commit_count           :integer          default(0)
#

namespace Gitamin\Models;

use AltThree\Validator\ValidatingTrait;
use Gitamin\Presenters\ProjectPresenter;
use Gitamin\Traits\VisibilityTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class Project extends Model implements HasPresenter
{
    use SoftDeletes, ValidatingTrait, VisibilityTrait;

    /**
     * List of attributes that have default values.
     *
     * @var mixed[]
     */
    protected $attributes = [
        'owner_id' => 0,
        'description' => '',
        'path' => '',
        'creator_id' => 0,
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id' => 'int',
        'owner_id' => 'int',
        'description' => 'string',
        'path' => 'string',
        'issues_enabled' => 'boolean',
        'creator_id' => 'int',
        'deleted_at' => 'date',
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
        'issues_enabled',
        'creator_id',
        'owner_id',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name' => 'required|string',
        'visibility_level' => 'int|required',
        'path' => 'required|string|max:15',
    ];

    /**
     * Projects can belong to a group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id', 'id');
    }

    /**
     * Projects can belong to a creator.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
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
     * Find by owner_path & project_path, or throw an exception.
     *
     * @param string   $owner_path
     * @param string   $project_path
     * @param string[] $columns
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return \Gitamin\Models\User
     */
    public static function findByPath($owner_path, $project_path, $columns = ['*'])
    {
        $project = Owner::findByPath($owner_path)->project($project_path, $columns);
        /* Another way
        $project = static::leftJoin('owners', function ($join) {
            $join->on('projects.owner_id', '=', 'owners.id');
        })->where('projects.path', '=', $project_path)->where('owners.path', '=', $owner_path)->first($columns);
        */
        if (! $project) {
            throw new ModelNotFoundException();
        }

        return $project;
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
     * Returns project route.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('projects.project_show', ['owner' => $this->owner_path, 'project' => $this->path]);
    }

    /**
     * Returns project owner path.
     *
     * @return string
     */
    public function getOwnerPathAttribute()
    {
        return $this->owner->path;
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
