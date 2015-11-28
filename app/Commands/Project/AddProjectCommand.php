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
     * The project status.
     *
     * @var int
     */
    public $status;

    /**
     * The project slug.
     *
     * @var string
     */
    public $slug;

    /**
     * The project order.
     *
     * @var int
     */
    public $order;

    /**
     * The project team.
     *
     * @var int
     */
    public $team_id;

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
        'name'        => 'required|string',
        'description' => 'string',
        'status'      => 'int|min:1|max:4',
        'slug'        => 'required|string',
        'order'       => 'int',
        'team_id'     => 'int',
        'enabled'     => 'bool',
    ];

    /**
     * Create a new add project command instance.
     *
     * @param string $name
     * @param string $description
     * @param int    $status
     * @param string $slug
     * @param int    $order
     * @param int    $team_id
     * @param bool   $enabled
     *
     * @return void
     */
    public function __construct($name, $description, $status, $slug, $order, $team_id, $enabled)
    {
        $this->name = $name;
        $this->description = $description;
        $this->status = (int) $status;
        $this->slug = $slug;
        $this->order = $order;
        $this->team_id = $team_id;
        $this->enabled = $enabled;
    }
}
