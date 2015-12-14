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

use Gitamin\Commands\Owner\AddOwnerCommand;
use Gitamin\Commands\Owner\RemoveOwnerCommand;
use Gitamin\Commands\Owner\UpdateOwnerCommand;
use Gitamin\Models\Owner;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OwnerController extends AbstractApiController
{
    use DispatchesJobs;

    /**
     * Get all owners.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOwners(Request $request)
    {
        $owners = Owner::paginate(Binput::get('per_page', 20));

        return $this->paginator($owners, $request);
    }

    /**
     * Get a single owner.
     *
     * @param \Gitamin\Models\Owner $owner
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOwner(Owner $owner)
    {
        return $this->item($owner);
    }

    /**
     * Create a new project team.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postOwners()
    {
        try {
            $owner = $this->dispatch(new AddOwnerCommand(
                Binput::get('name'),
                Binput::get('path'),
                Binput::get('user_id'),
                Binput::get('description'),
                Binput::get('type')
            ));
        } catch (QueryException $e) {
            throw new BadRequestHttpException();
        }

        return $this->item($owner);
    }

    /**
     * Update an existing owner.
     *
     * @param \Gitamin\Models\Owner $owner
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function putOwner(Owner $owner)
    {
        try {
            $owner = $this->dispatch(new UpdateOwnerCommand(
                $owner,
                Binput::get('name'),
                Binput::get('path'),
                Binput::get('user_id'),
                Binput::get('description'),
                Binput::get('type')
            ));
        } catch (QueryException $e) {
            throw new BadRequestHttpException();
        }

        return $this->item($owner);
    }

    /**
     * Delete an existing owner.
     *
     * @param \Gitamin\Models\Owner $owner
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteOwner(Owner $owner)
    {
        $this->dispatch(new RemoveOwnerCommand($owner));

        return $this->noContent();
    }
}
