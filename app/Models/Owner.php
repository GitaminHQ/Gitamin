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
# Table name: owners
#
#  id          :integer          not null, primary key
#  name        :string(255)      not null
#  path        :string(255)      not null
#  user_id     :integer
#  created_at  :timestamp
#  updated_at  :timestamp
#  type        :string(255)
#  description :string(255)      default(""), not null
#  avatar      :string(255)
#  public      :boolean          default(FALSE)
#

namespace Gitamin\Models;

use AltThree\Validator\ValidatingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Owner extends Model
{
    use ValidatingTrait;

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id' => 'int',
        'name' => 'string',
        'path' => 'string',
        'user_id' => 'int',
        'type' => 'string',
    ];

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'path',
        'user_id',
        'description',
        'type',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name' => 'required|string',
        'path' => 'required|string|max:15',
        'user_id' => 'int',
        'type' => 'string',
        'description' => 'string',
    ];

    /**
     * A owner can have many projects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'owner_id', 'id');
    }

    /**
     * Find project under this owner by path, or throw an exception.
     *
     * @param string   $path
     * @param string[] $columns
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return \Gitamin\Models\User
     */
    public function project($path, $columns = ['*'])
    {
        $project = Project::where('owner_id', '=', $this->id)->where('path', '=', $path)->first($columns);

        if (! $project) {
            throw new ModelNotFoundException();
        }

        return $project;
    }

    /**
     * Find by path, or throw an exception.
     *
     * @param string   $path
     * @param string[] $columns
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return \Gitamin\Models\User
     */
    public static function findByPath($path, $columns = ['*'])
    {
        $owner = static::where('path', $path)->first($columns);

        if (! $owner) {
            throw new ModelNotFoundException();
        }

        return $owner;
    }

    /**
     * Finds all my owners.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        //return $query->where('user_id', Auth::user()->id);
    }
}
