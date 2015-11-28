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

use Gitamin\Models\ProjectTeam;

final class UpdateProjectTeamCommand
{
    /**
     * The project team.
     *
     * @var \Gitamin\Models\ProjectTeam
     */
    public $team;

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
        'name'  => 'string',
        'name'  => 'string',
        'order' => 'int',
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
    public function __construct(ProjectTeam $team, $name, $slug, $order)
    {
        $this->team = $team;
        $this->name = $name;
        $this->slug = $slug;
        $this->order = (int) $order;
    }
}
