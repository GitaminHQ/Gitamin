<?php

namespace Gitamin\Http\Controllers\Projects;

use Gitamin\Commands\Issue\AddIssueCommand;
use Gitamin\Commands\Issue\UpdateIssueCommand;
use Gitamin\Http\Controllers\Controller;
use Gitamin\Models\Issue;
use Gitamin\Models\Project;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class WikiController extends Controller
{
    protected $active_item = 'wiki';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction($namespace, $project_path)
    {
        $project = Project::findByPath($namespace, $project_path);

        return View::make('projects.wiki.index')
            ->withProject($project)
            ->withWikis([])
            ->withActiveItem($this->active_item)
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.issues.issues'), $project->name));
    }
}
