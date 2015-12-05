<?php

namespace Gitamin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use GrahamCampbell\Binput\Facades\Binput;
use AltThree\Validator\ValidationException;
use Gitamin\Commands\Project\AddProjectCommand;
use Gitamin\Commands\Project\RemoveProjectCommand;
use Gitamin\Commands\Project\UpdateProjectCommand;
use Gitamin\Models\Project;
use Gitamin\Models\ProjectNamespace;
use Gitamin\Models\Group;
use Gitamin\Models\Tag;

use Gitamin\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    use DispatchesJobs;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo "In projects controller";
    }

    /**
    * Show the form or adding a new resource.
    *
    * return \Illuminate\Http\Response
    */
    public function new()
    {
        return View::make('projects.new')
            ->withPageTitle(trans('dashboard.projects.new.title').' - '.trans('dashboard.dashboard'))
            ->withGroupId('')
            ->withGroups(Group::Mine()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $projectData = Binput::get('project');
        $tags = array_pull($projectData, 'tags');

        try {
            $projectData['creator_id'] = Auth::user()->id;
            $project = $this->dispatchFromArray(AddProjectCommand::class, $projectData);
        } catch (ValidationException $e) {
            return Redirect::route('projects.new')
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.projects.new.failure')))
                ->withErrors($e->getMessageBag());
        }

        // The project was added successfully, so now let's deal with the tags.
        $tags = preg_split('/ ?, ?/', $tags);

        // For every tag, do we need to create it?
        $projectTags = array_map(function ($taggable) use ($project) {
            return Tag::firstOrCreate(['name' => $taggable])->id;
        }, $tags);

        $project->tags()->sync($projectTags);

        return Redirect::route('dashboard.projects.index')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.projects.new.success')));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $namespace
     * @param  string  $project_path
     * @return \Illuminate\Http\Response
     */
    public function show($namespace, $project_path)
    {
        $project = Project::leftJoin('namespaces', function($join) {
            $join->on('projects.namespace_id', '=', 'namespaces.id');
        })->where('projects.path', '=', $project_path)->where('namespaces.path', '=', $namespace)->first(['projects.*']);

        return View::make('projects.show')
            ->withPageTitle($project->name)
            ->withActiveItem('project_show')
            ->withProject($project)
            ->withRepo('')
            ->withRepository('')
            ->withCurrentBranch('master')
            ->withBranches([])
            ->withParentPath('')
            ->withFiles([]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($namespace, $project_path)
    {
        $project = Project::leftJoin('namespaces', function($join) {
            $join->on('projects.namespace_id', '=', 'namespaces.id');
        })->where('projects.path', '=', $project_path)->where('namespaces.path', '=', $namespace)->first(['projects.*']);
        
        return View::make('projects.edit')
            ->withPageTitle(trans('dashboard.projects.new.title').' - '.trans('dashboard.dashboard'))
            ->withProject($project)
            ->withGroupId('')
            ->withGroups(Group::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($namespace, $project_path)
    {
        $projectData = Binput::get('project');
        $tags = array_pull($projectData, 'tags');
        $project = Project::find($projectData['id']);
        $projectData['namespace_id'] = $project->namespace_id;

        try {
            $projectData['project'] = $project;
            $projectData['creator_id'] = Auth::user()->id;
            $project = $this->dispatchFromArray(UpdateProjectCommand::class, $projectData);
        } catch (ValidationException $e) {
            return Redirect::route('projects.project_edit', ['namespace' => $project->namespace, 'project' => $project->path])
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.projects.edit.failure')))
                ->withErrors($e->getMessageBag());
        }
        // The project was updated successfully, so now let's deal with the tags.
        $tags = preg_split('/ ?, ?/', $tags);

        return Redirect::route('projects.project_edit', ['namespace' => $project->namespace, 'project' => $project->path])
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.projects.edit.success')));
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
