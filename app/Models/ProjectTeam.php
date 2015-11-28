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
use Illuminate\Database\Eloquent\Model;

class ProjectTeam extends Model
{
    use ValidatingTrait;

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id'    => 'int',
        'name'  => 'string',
        'slug'  => 'string',
        'order' => 'int',
    ];

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'slug', 'order'];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'  => 'required|string',
        'slug'  => 'required|string',
        'order' => 'int',
    ];

    /**
     * A team can have many projects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'team_id', 'id');
    }
}
