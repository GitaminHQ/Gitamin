<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Commands\Owner;

final class AddOwnerCommand
{
    /**
     * The project owner name.
     *
     * @var string
     */
    public $name;

    /**
     * The project owner path.
     *
     * @var string
     */
    public $path;

    /**
     * The project owner user_id.
     *
     * @var int
     */
    public $user_id;

    /**
     * The project owner description.
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
        'user_id'  => 'int',
        'type'     => 'string',
    ];

    /**
     * Create a add project team command instance.
     *
     * @param string $name
     * @param string $path
     * @param int    $user_id
     * @param string $description
     * @param string $type
     *
     * @return void
     */
    public function __construct($name, $path, $user_id, $description, $type)
    {
        $this->name = $name;
        $this->path = $path;
        $this->user_id = $user_id;
        $this->description = $description;
        $this->type = $type;
    }
}
