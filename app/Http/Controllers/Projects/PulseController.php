<?php

namespace Gitamin\Http\Controllers\Projects;

use Gitamin\Http\Controllers\Controller;
use Gitamin\Models\Project;
use Illuminate\Support\Facades\View;

class PulseController extends Controller
{
    protected $active_item = 'pulse';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction($namespace, $project_path)
    {
        $project = Project::findByPath($namespace, $project_path);

        return View::make('projects.pulse.index')
            ->withProject($project)
            ->withWikis([])
            ->withActiveItem($this->active_item)
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.issues.issues'), $project->name));
    }
}
