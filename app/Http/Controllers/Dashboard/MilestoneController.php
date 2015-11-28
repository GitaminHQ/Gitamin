<?php

namespace Gitamin\Http\Controllers\Dashboard;



use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
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
            ->withMilestones($milestones);
    }
}
