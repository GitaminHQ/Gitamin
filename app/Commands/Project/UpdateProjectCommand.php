<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Commands\Project;

use Gitamin\Models\Project;

final class UpdateProjectCommand
{
    /**
     * The project to update.
     *
     * @var \Gitamin\Models\Project
     */
    public $project;

    /**
     * The project name.
     *
     * @var string
     */
    public $name;

    /**
     * The project description.
     *
     * @var string
     */
    public $description;

    /**
     * The project visibility_level.
     *
     * @var int
     */
    public $visibility_level;

    /**
     * The project path.
     *
     * @var string
     */
    public $path;

    /**
     * The project creator id.
     *
     * @var int
     */
    public $creator_id;

    /**
     * The project owner.
     *
     * @var int
     */
    public $owner_id;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'             => 'string',
        'description'      => 'string',
        'visibility_level' => 'int|min:1|max:4',
        'path'             => 'string',
        'creator_id'       => 'int',
        'owner_id'         => 'int',
    ];

    /**
     * Create a new update project command instance.
     *
     * @param \Gitamin\Models\Project $project
     * @param string                  $name
     * @param string                  $description
     * @param int                     $visibility_level
     * @param string                  $path
     * @param int                     $creator_id
     * @param int                     $owner_id
     *
     * @return void
     */
    public function __construct(Project $project, $name, $description, $visibility_level, $path, $creator_id, $owner_id)
    {
        $this->project = $project;
        $this->name = $name;
        $this->description = $description;
        $this->visibility_level = (int) $visibility_level;
        $this->path = $path;
        $this->creator_id = $creator_id;
        $this->owner_id = $owner_id;
    }
}
