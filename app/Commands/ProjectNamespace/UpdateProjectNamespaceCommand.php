<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Commands\ProjectNamespace;

use Gitamin\Models\ProjectNamespace;

final class UpdateProjectNamespaceCommand
{

    public $project_namespace;
    /**
     * The project namespace name.
     *
     * @var string
     */
    public $name;

    /**
     * The project namespace path.
     *
     * @var string
     */
    public $path;

    /**
     * The project namespace description.
     *
     * @var string
     */
    public $description;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'  => 'string',
        'path'  => 'string',
        'description' => 'string',
    ];

    /**
     * Create a add project team command instance.
     *
     * @param \Gitamin\Models\ProjectTeam $team
     * @param string                      $name
     * @param string                      $slug
     * @param int                         $order
     *
     * @return void
     */
    public function __construct($project_namespace, $name, $path, $description)
    {
        $this->project_namespace = $project_namespace;
        $this->name = $name;
        $this->path = $path;
        $this->description = $description;
    }
}
