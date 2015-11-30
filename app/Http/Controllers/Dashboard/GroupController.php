<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers\Dashboard;

use AltThree\Validator\ValidationException;
use Gitamin\Commands\User\AddGroupMemberCommand;
use Gitamin\Commands\User\InviteGroupMemberCommand;
use Gitamin\Commands\User\RemoveUserCommand;
use Gitamin\Models\User;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class GroupController extends Controller
{
    use DispatchesJobs;

    /**
     * Shows the group members view.
     *
     * @return \Illuminate\View\View
     */
    public function showGroupView()
    {
        $group = User::all();

        return View::make('dashboard.group.index')
            ->withPageTitle(trans('dashboard.group.group').' - '.trans('dashboard.dashboard'))
            ->withGroupMembers($group);
    }

    /**
     * Shows the edit group member view.
     *
     * @return \Illuminate\View\View
     */
    public function showGroupMemberView(User $user)
    {
        return View::make('dashboard.group.edit')
            ->withPageTitle(trans('dashboard.group.edit.title').' - '.trans('dashboard.dashboard'))
            ->withUser($user);
    }

    /**
     * Shows the add group member view.
     *
     * @return \Illuminate\View\View
     */
    public function showAddGroupMemberView()
    {
        return View::make('dashboard.group.add')
            ->withPageTitle(trans('dashboard.group.add.title').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Shows the invite group member view.
     *
     * @return \Illuminate\View\View
     */
    public function showInviteGroupMemberView()
    {
        return View::make('dashboard.group.invite')
            ->withPageTitle(trans('dashboard.group.invite.title').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Creates a new group member.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddUser()
    {
        try {
            $this->dispatch(new AddGroupMemberCommand(
                Binput::get('username'),
                Binput::get('password'),
                Binput::get('email'),
                Binput::get('level')
            ));
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.group.add')
                ->withInput(Binput::except('password'))
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.group.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.group.add')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.group.add.success')));
    }

    /**
     * Updates a user.
     *
     * @param \Gitamin\Models\User $user
     *
     * @return \Illuminate\View\View
     */
    public function postUpdateUser(User $user)
    {
        $userData = array_filter(Binput::only(['username', 'email', 'password', 'level']));

        try {
            $user->update($userData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.group.edit', ['id' => $user->id])
                ->withInput($userData)
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.group.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.group.edit', ['id' => $user->id])
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.group.edit.success')));
    }

    /**
     * Creates a new group member.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postInviteUser()
    {
        try {
            $this->dispatch(new InviteGroupMemberCommand(
                array_unique(array_filter((array) Binput::get('emails')))
            ));
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.group.invite')
                ->withInput(Binput::except('password'))
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.group.invite.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.group.invite')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.group.invite.success')));
    }

    /**
     * Delete a user.
     *
     * @param \Gitamin\Models\User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser(User $user)
    {
        $this->dispatch(new RemoveUserCommand($user));

        return Redirect::route('dashboard.group.index')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.group.delete.success')));
    }
}
