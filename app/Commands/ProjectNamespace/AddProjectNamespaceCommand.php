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

final class AddProjectNamespaceCommand
{
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
     * @var text
     */
    public $description;

    /**
     * The project namespace type.
     *
     * @var string
     */
    public $type;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'     => 'required|string',
        'path'     => 'required|string',
        'owner_id' => 'int',
        'type'     => 'string',
    ];

    /**
     * Create a add project team command instance.
     *
     * @param string $name
     * @param string $path
     * @param int    $owner_id
     * @param string $description
     * @param string $type
     *
     * @return void
     */
    public function __construct($name, $path, $owner_id, $description, $type)
    {
        $this->name = $name;
        $this->path = $path;
        $this->owner_id = $owner_id;
        $this->description = $description;
        $this->type = $type;
    }
}
