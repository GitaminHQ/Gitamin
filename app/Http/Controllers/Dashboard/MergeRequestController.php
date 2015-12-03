<?php

namespace Gitamin\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class MergeRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMergeRequests()
    {
        $mergeRequests = [];

        return View::make('dashboard.merge_requests.index')
            ->withPageTitle(trans('dashboard.merge_requests.merge_requests'))
            ->withMergeRequests($mergeRequests);
    }
}
