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

use Gitamin\Commands\Comment\AddCommentCommand;
use Gitamin\Commands\Comment\RemoveCommentCommand;
use Gitamin\Commands\Comment\UpdateCommentCommand;
use Gitamin\Models\Comment;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CommentController extends AbstractApiController
{
    use DispatchesJobs;

    /**
     * Get all comments.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Illuminate\Contracts\Auth\Guard          $auth
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComments(Request $request, Guard $auth)
    {
        $comments = Comment::paginate($request->input('per_page', 20));

        return $this->paginator($comments, $request);
    }

    /**
     * Get a single comment.
     *
     * @param \Gitamin\Models\Comment $comment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComment(Comment $comment)
    {
        return $this->item($comment);
    }

    /**
     * Create a new comment.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postComments(Request $request, Guard $auth)
    {
        try {
            $comment = $this->dispatch(new AddCommentCommand(
                $request->input('message'),
                $request->input('commentable_type'),
                $request->input('commentable_id'),
                $request->input('author_id'),
                $request->input('project_id')
            ));
        } catch (QueryException $e) {
            throw new BadRequestHttpException();
        }

        return $this->item($comment);
    }

    /**
     * Update an existing comment.
     *
     * @param \Gitamin\Models\Inicdent $comment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function putComment(Request $request, Comment $comment)
    {
        try {
            $comment = $this->dispatch(new UpdateCommentCommand(
                $comment,
                $request->input('message')
            ));
        } catch (QueryException $e) {
            throw new BadRequestHttpException();
        }

        return $this->item($comment);
    }

    /**
     * Delete an existing comment.
     *
     * @param \Gitamin\Models\Comment $comment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteComment(Comment $comment)
    {
        $this->dispatch(new RemoveCommentCommand($comment));

        return $this->noContent();
    }
}
