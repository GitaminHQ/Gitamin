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

use Gitamin\Models\Group;
use Gitamin\Models\Issue;
use Gitamin\Models\Moment;
use Gitamin\Models\Project;
use Illuminate\Contracts\View\View;

class AdminComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\Contracts\View\View $view
     */
    public function compose(View $view)
    {
        $view->withIssueCount(Issue::all()->count());
        $view->withProjectCount(Project::all()->count());
        $view->withGroupCount(Group::count());
        $view->withMomentCount(Moment::all()->count());
    }
}
