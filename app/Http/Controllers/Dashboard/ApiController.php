<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers\Dashboard;

use Exception;
use Gitamin\Models\Project;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;

class ApiController extends Controller
{
    /**
     * Updates a project with the entered info.
     *
     * @param \Gitamin\Models\Project $project
     *
     * @throws \Exception
     *
     * @return \Gitamin\Models\Project
     */
    public function postUpdateProject(Project $project)
    {
        if (! $project->update(Request::except(['_token']))) {
            throw new Exception(trans('dashboard.projects.edit.failure'));
        }

        return $project;
    }

    /**
     * Updates a projects ordering.
     *
     * @return array
     */
    public function postUpdateProjectOrder()
    {
        $projectData = Request::get('ids');

        foreach ($projectData as $order => $projectId) {
            // Ordering should be 1-based, data comes in 0-based
            Project::find($projectId)->update(['order' => $order + 1]);
        }

        return $projectData;
    }

    public function postUploadAvatar()
    {
        $data = [
            'path' => '/img/no_group_avatar.png',
        ];

        return $data;
    }
}
