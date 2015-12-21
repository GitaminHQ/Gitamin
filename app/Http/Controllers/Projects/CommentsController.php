<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers\Projects;

use Gitamin\Commands\Comment\AddCommentCommand;
use Gitamin\Http\Controllers\Controller;
use Gitamin\Models\Comment;
use Gitamin\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class CommentsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAction($owner_path, $project_path)
    {
        $project = Project::findByPath($owner_path, $project_path);
        $commentData = Request::get('comment');

        try {
            $commentData['author_id'] = Auth::user()->id;
            $commentData['project_id'] = $project->id;
            $commentData['commentable_type'] = $commentData['commentable_type'];
            $comment = $this->dispatchFromArray(AddCommentCommand::class, $commentData);
        } catch (ValidationException $e) {
            return Redirect::route('projects.issue_show', ['owner' => $owner_path, 'project' => $project_path, 'issue' => $commentData['commentable_id']])
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.issues.new.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('projects.issue_show', ['owner' => $owner_path, 'project' => $project_path, 'issue' => $commentData['commentable_id']])
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.issues.new.success')));
    }
}
