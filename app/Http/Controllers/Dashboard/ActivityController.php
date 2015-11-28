<?php

namespace Gitamin\Http\Controllers\Dashboard;



use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Array of sub-menu items.
     *
     * @var array
     */
    protected $subMenu = [];

    /**
     * Creates a new activity controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->subMenu = [
            'activities' => [
                'title'  => trans('dashboard.activities.all'),
                'url'    => route('dashboard.activities.index'),
                'icon'   => 'fa fa-sliders',
                'active' => false,
            ],
            'project_update' => [
                'title'  => trans('dashboard.activities.project_update'),
                'url'    => route('dashboard.activities.index'),
                'icon'   => 'fa fa-edit',
                'active' => false,
            ],
            'topic' => [
                'title'  => trans('dashboard.activities.topic'),
                'url'    => route('dashboard.activities.index'),
                'icon'   => 'fa fa-comment',
                'active' => false,
            ],
            'watched_project' => [
                'title'  => trans('dashboard.activities.watched_project'),
                'url'    => route('dashboard.activities.index'),
                'icon'   => 'fa fa-eye',
                'active' => false,
            ],
        ];

        View::share([
            'sub_menu'  => $this->subMenu,
            'sub_title' => trans_choice('dashboard.activities.activities', 2),
        ]);
    }


    public function showActivities()
    {
        $activities = [];

        $this->subMenu['activities']['active'] = true;

        return View::make('dashboard.activities.index')
            ->withActivities($activities)
            ->withSubMenu($this->subMenu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
