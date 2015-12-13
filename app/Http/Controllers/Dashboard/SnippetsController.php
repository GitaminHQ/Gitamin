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

use Gitamin\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class SnippetsController extends Controller
{
    /**
     * Display a listing of the snippets.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction()
    {
        $snippets = [];

        return View::make('dashboard.snippets.index')
            ->withPageTitle(trans('dashboard.snippets.snippets'))
            ->withSnippets($snippets);
    }
}
