<?php

namespace Gitamin\Http\Controllers\Projects;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Gitamin\Http\Controllers\Controller;

class IssuesController extends Controller
{
    
    protected $active_item = 'issues';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($namespace, $project_path)
    {
        $project = $this->getProject($namespace, $project_path);
        return View::make('projects.issues.index')
            ->withProject($project)
            ->withActiveItem($this->active_item)
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.issues.issues'), $project->name));
    }

    public function new($namespace, $project_path)
    {
        $project = $this->getProject($namespace, $project_path);

        return View::make('projects.issues.new')
            ->withProject($project)
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.issues.issues'), $project->name))
            ->withActiveItem($this->active_item);
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
