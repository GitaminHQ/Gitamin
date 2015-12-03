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
     * The project order.
     *
     * @var int
     */
    public $order;

    /**
     * The project namespace.
     *
     * @var int
     */
    public $namespace_id;

    /**
     * Is the project enabled?
     *
     * @var bool
     */
    public $enabled;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'             => 'required|string',
        'description'      => 'string',
        'visibility_level' => 'int|min:1|max:4',
        'path'             => 'required|string',
        'order'            => 'int',
        'namespace_id'     => 'int',
        'enabled'          => 'bool',
    ];

    /**
     * Create a new add project command instance.
     *
     * @param string $name
     * @param string $description
     * @param int    $visibility_level
     * @param string $path
     * @param int    $order
     * @param int    $namespace_id
     * @param bool   $enabled
     *
     * @return void
     */
    public function __construct($name, $description, $visibility_level, $path, $order, $namespace_id, $enabled)
    {
        $this->name = $name;
        $this->description = $description;
        $this->visibility_level = (int) $visibility_level;
        $this->path = $path;
        $this->order = $order;
        $this->namespace_id = $namespace_id;
        $this->enabled = $enabled;
    }
}
