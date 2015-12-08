<?php

namespace Gitamin\Http\Controllers\Api;

use Gitamin\Commands\Note\AddNoteCommand;
use Gitamin\Models\Note;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class NoteController extends AbstractApiController
{
    use DispatchesJobs;

    public function getNotes()
    {
        echo 'getNotes';
    }

    public function getNote(Note $note)
    {
        echo 'getNote';
    }

    /**
     * Create a new note.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postNotes(Guard $auth)
    {
        try {
            $note = $this->dispatch(new AddNoteCommand(
                Binput::get('description'),
                Binput::get('noteable_type'),
                Binput::get('noteable_id'),
                Binput::get('author_id'),
                Binput::get('project_id')
            ));
        } catch (QueryException $e) {
            throw new BadRequestHttpException();
        }

        return $this->item($note);
    }
}
