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

use Gitamin\Models\Owner;

final class UpdateOwnerCommand
{
    /**
     * The project owner instance.
     *
     * @var \Gitamin\Models\Owner
     */
    public $owner;

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
     * @var string
     */
    public $description;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name' => 'string',
        'path' => 'string',
        'user_id' => 'int',
        'description' => 'string',
    ];

    /**
     * Create an add project owner command instance.
     *
     * @param \Gitamin\Models\ProjectNamepsace $owner
     * @param string                           $name
     * @param string                           $path
     * @param int                              $user_id
     * @param string                           $description
     */
    public function __construct($owner, $name, $path, $user_id, $description)
    {
        $this->owner = $owner;
        $this->name = $name;
        $this->path = $path;
        $this->user_id = $user_id;
        $this->description = $description;
    }
}
