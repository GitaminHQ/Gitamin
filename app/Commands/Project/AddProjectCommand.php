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

final class AddProjectCommand
{
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
     * The project slug.
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
     * The project ower.
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
        'name' => 'required|string',
        'description' => 'string',
        'visibility_level' => 'int|min:1|max:4',
        'path' => 'required|string',
        'creator_id' => 'int',
        'owner_id' => 'int',
    ];

    /**
     * Create a new add project command instance.
     *
     * @param string $name
     * @param string $description
     * @param int    $visibility_level
     * @param string $path
     * @param int    $creator_id
     * @param int    $owner_id
     * @param bool   $issues_enabled
     */
    public function __construct($name, $description, $visibility_level, $path, $creator_id, $owner_id)
    {
        $this->name = $name;
        $this->description = $description;
        $this->visibility_level = (int) $visibility_level;
        $this->path = $path;
        $this->creator_id = $creator_id;
        $this->owner_id = $owner_id;
    }
}
