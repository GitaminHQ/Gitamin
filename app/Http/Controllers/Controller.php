<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers;

use Gitamin\Models\Project;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use DispatchesJobs;

    public function getProject($namespace, $path)
    {
		$project = Project::leftJoin('namespaces', function ($join) {
            $join->on('projects.namespace_id', '=', 'namespaces.id');
        })->where('projects.path', '=', $path)->where('namespaces.path', '=', $namespace)->first(['projects.*']);

		return $project;
    }
}
