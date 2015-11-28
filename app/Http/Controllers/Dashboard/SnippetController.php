<?php

namespace Gitamin\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
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
            ->withSnippets($snippets);
    }
}
