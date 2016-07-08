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
use Illuminate\Support\Facades\View;
use Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return View::make('index')
            ->withProjects($projects);
    }

    public function refresh()
    {
        return Redirect::back();
    }
}
