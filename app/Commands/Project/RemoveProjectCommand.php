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

use Gitamin\Models\Project;

final class RemoveProjectCommand
{
    /**
     * The project to remove.
     *
     * @var \Gitamin\Models\Project
     */
    public $project;

    /**
     * Create a new remove project command instance.
     *
     * @param \Gitamin\Models\Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }
}
