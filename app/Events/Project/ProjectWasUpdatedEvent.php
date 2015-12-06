<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Events\Project;

use Gitamin\Models\Project;

class ProjectWasUpdatedEvent implements ProjectEventInterface
{
    /**
     * The project that was updated.
     *
     * @var \Gitamin\Models\Project
     */
    public $project;

    /**
     * Create a new project was updated event instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }
}
