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

    /**
     * The project namespace instance.
     *
     * @var \Gitamin\Models\ProjectNamespace
     */
    public $projectNamespace;

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
     * The project namespace owner_id.
     *
     * @var int
     */
    public $owner_id;

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
        'name'        => 'string',
        'path'        => 'string',
        'owner_id'    => 'int',
        'description' => 'string',
    ];

    /**
     * Create a add project namespace command instance.
     *
     * @param \Gitamin\Models\ProjectNamepsace $projectNamespace
     * @param string                           $name
     * @param string                           $path
     * @param int                              $ower_id
     * @param string                           $description
     *
     * @return void
     */
    public function __construct($projectNamespace, $name, $path, $owner_id, $description)
    {
        $this->projectNamespace = $projectNamespace;
        $this->name = $name;
        $this->path = $path;
        $this->owner_id = $owner_id;
        $this->description = $description;
    }
}
