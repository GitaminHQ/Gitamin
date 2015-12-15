<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers\Api;

use Gitamin\Commands\Issue\AddIssueCommand;
use Gitamin\Commands\Issue\RemoveIssueCommand;
use Gitamin\Commands\Issue\UpdateIssueCommand;
use Gitamin\Models\Issue;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class IssueController extends AbstractApiController
{
    use DispatchesJobs;

    /**
     * Get all issues.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Illuminate\Contracts\Auth\Guard          $auth
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIssues(Request $request, Guard $auth)
    {
        //$issuePosition = $auth->check() ? 0 : 1;
        $issuePosition = $auth->check() ? 0 : -1;

        $issues = Issue::where('position', '>=', $issuePosition)->paginate($request->get('per_page', 20));

        return $this->paginator($issues, $request);
    }

    /**
     * Get a single issue.
     *
     * @param \Gitamin\Models\Issue $issue
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIssue(Issue $issue)
    {
        return $this->item($issue);
    }

    /**
     * Create a new issue.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postIssues(Request $request, Guard $auth)
    {
        try {
            $issue = $this->dispatch(new AddIssueCommand(
                $request->get('title'),
                $request->get('description'),
                $request->get('author_id'),
                $request->get('project_id')
            ));
        } catch (QueryException $e) {
            throw new BadRequestHttpException();
        }

        return $this->item($issue);
    }

    /**
     * Update an existing issue.
     *
     * @param \Gitamin\Models\Inicdent $issue
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function putIssue(Request $request, Issue $issue)
    {
        try {
            $issue = $this->dispatch(new UpdateIssueCommand(
                $issue,
                $request->get('title'),
                $request->get('description'),
                $request->get('author_id'),
                $request->get('project_id')
            ));
        } catch (QueryException $e) {
            throw new BadRequestHttpException();
        }

        return $this->item($issue);
    }

    /**
     * Delete an existing issue.
     *
     * @param \Gitamin\Models\Issue $issue
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteIssue(Issue $issue)
    {
        $this->dispatch(new RemoveIssueCommand($issue));

        return $this->noContent();
    }
}
