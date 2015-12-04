<?php

namespace Gitamin\Http\Controllers\Projects;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Gitamin\Http\Controllers\Controller;
use GrahamCampbell\Binput\Facades\Binput;
use Gitamin\Commands\Issue\AddIssueCommand;
use Gitamin\Commands\Issue\RemoveIssueCommand;
use Gitamin\Commands\Issue\UpdateIssueCommand;
use Gitamin\Models\Project;
use Gitamin\Models\ProjectNamespace;
use Gitamin\Models\Group;
use Gitamin\Models\Tag;
use Gitamin\Models\Issue;

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
            ->withIssues($project->issues)
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
    public function create($namespace, $project_path)
    {
        $project = $this->getProject($namespace, $project_path);
        $issueData = Binput::get('issue');

         try {
            $issueData['author_id'] = Auth::user()->id;
            $issueData['project_id'] = $project->id;
            $issue = $this->dispatchFromArray(AddIssueCommand::class, $issueData);
        } catch (ValidationException $e) {
            return Redirect::route('projects.issue_new')
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.issues.new.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('projects.issue_index', ['namespace' => $namespace, 'project'=> $project_path])
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.issues.new.success')));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($namespace, $project, Issue $issue)
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
