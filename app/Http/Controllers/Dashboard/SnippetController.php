<?php

namespace Gitamin\Http\Controllers\Dashboard;

use Gitamin\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class SnippetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSnippets()
    {
        $snippets = [];

        return View::make('dashboard.snippets.index')
            ->withPageTitle(trans('dashboard.snippets.snippets'))
            ->withSnippets($snippets);
    }
}
