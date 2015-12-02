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

final class RemoveProjectNamespaceCommand
{
    /**
     * The project team to remove.
     *
     * @var \Gitamin\Models\ProjectTeam
     */
    public $namespace;

    /**
     * Create a new remove project team command instance.
     *
     * @param \Gitamin\Models\ProjectTeam $team
     *
     * @return void
     */
    public function __construct(ProjectNamespace $namespace)
    {
        $this->namespace = $namespace;
    }
}
