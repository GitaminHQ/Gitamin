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
use Gitamin\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * Shows the user view.
     *
     * @return \Illuminate\View\View
     */
    public function showUser()
    {
        return View::make('dashboard.user.index')
            ->withPageTitle(trans('dashboard.team.profile').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Updates the current user.
     *
     * @return \Illuminate\View\View
     */
    public function postUser()
    {
        $userData = array_filter(Request::only(['username', 'email', 'password']));

        try {
            Auth::user()->update($userData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.user')
                ->withInput($userData)
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.team.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.user')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.team.edit.success')));
    }

    /**
     * Regenerates the users API key.
     *
     * @return \Illuminate\View\View
     */
    public function regenerateApiKey(User $user)
    {
        $user->api_key = User::generateApiKey();
        $user->save();

        return Redirect::route('dashboard.user');
    }
}
