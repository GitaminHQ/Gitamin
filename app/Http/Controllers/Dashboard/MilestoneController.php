<?php

namespace Gitamin\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class MilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function showMilestones()
    {
        $milestones = [];

        return View::make('dashboard.milestones.index')
            ->withPageTitle(trans('dashboard.milestones.milestones'))
            ->withMilestones($milestones);
    }
}
