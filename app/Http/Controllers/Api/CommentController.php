<?php

namespace Gitamin\Http\Controllers\Api;

use Gitamin\Commands\Comment\AddCommentCommand;
use Gitamin\Models\Comment;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CommentController extends AbstractApiController
{
    use DispatchesJobs;

    public function getComments()
    {
        echo 'getComments';
    }

    public function getComment(Comment $comment)
    {
        echo 'getComment';
    }

    /**
     * Create a new comment.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postComments(Guard $auth)
    {
        try {
            $comment = $this->dispatch(new AddCommentCommand(
                Binput::get('message'),
                Binput::get('target_type'),
                Binput::get('target_id'),
                Binput::get('author_id'),
                Binput::get('project_id')
            ));
        } catch (QueryException $e) {
            throw new BadRequestHttpException();
        }

        return $this->item($comment);
    }
}
