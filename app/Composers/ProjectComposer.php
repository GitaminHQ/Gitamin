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

use Gitamin\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class ProjectComposer
{
    /**
     * Project page view composer.
     *
     * @param \Illuminate\Contracts\View\View $view
     */
    public function compose(View $view)
    {
        $owner_path = Route::input('owner_path');
        $project_path = Route::input('project_path');

        if ($owner_path !== null && $project_path !== null) {
            $project = Project::findByPath($owner_path, $project_path);
            $repository = $project->getRepository();
            $view->withProject($project);
            $view->withRepository($repository);
        }
    }
}
