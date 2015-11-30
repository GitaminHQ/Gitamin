<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Composers;

use Gitamin\Models\Issue;
use Gitamin\Models\Project;
use Gitamin\Models\ProjectTeam;
use Illuminate\Contracts\View\View;

class DashboardComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\Contracts\View\View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->withIssueCount(Issue::all()->count());
        $view->withProjectCount(Project::all()->count());
        $view->withProjectTeamCount(ProjectTeam::all()->count());
    }
}
