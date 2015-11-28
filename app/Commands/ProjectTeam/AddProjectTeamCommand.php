<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Commands\ProjectTeam;

final class AddProjectTeamCommand
{
    /**
     * The project team name.
     *
     * @var string
     */
    public $name;

    /**
     * The project team slug.
     *
     * @var string
     */
    public $slug;

    /**
     * The project team order.
     *
     * @var int
     */
    public $order;

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
     * Create a add project team command instance.
     *
     * @param string $name
     * @param int    $order
     *
     * @return void
     */
    public function __construct($name, $slug, $order)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->order = (int) $order;
    }
}
