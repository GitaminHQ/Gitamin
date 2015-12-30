<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers\Auth;

use AltThree\Validator\ValidationException;
use Gitamin\Commands\User\SignupUserCommand;
use Gitamin\Exceptions\UserAlreadyTakenException;
use Gitamin\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers;

    /**
     * Handle a login request to the application.
     *
     * @return \Illuminate\Http\Response
     */
    protected function login()
    {
        $loginData = Request::only(['login', 'password', 'remember']);

        // Remember me?
        $remember = (bool) array_pull($loginData, 'remember');

        // Login with username or email.
        $loginKey = Str::contains($loginData['login'], '@') ? 'email' : 'username';
        $loginData[$loginKey] = array_pull($loginData, 'login');

        if (Auth::validate($loginData)) {
            // Log the user in for one request.
            Auth::once($loginData);
            // We probably want to add support for "Remember me" here.
            Auth::attempt($loginData, $remember);
            //return Redirect::intended('/')
            return Redirect::home()
                ->withSuccess(trans('gitamin.signin.success'));
        }

        return redirect('/auth/login')
            ->withInput(Request::except('password'))
            ->withError(trans('gitamin.signin.invalid'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @return \Illuminate\Http\Response
     */
    protected function register()
    {
        $code = 'gitamin';
        try {
            $user = dispatch(new SignupUserCommand(
                Request::get('username'),
                Request::get('password'),
                Request::get('email'),
                2
            ));
        } catch (ValidationException $e) {
            return Redirect::to('/auth/register')
                ->withInput(Request::except('password'))
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('gitamin.signup.failure')))
                ->withErrors($e->getMessageBag());
        } catch (UserAlreadyTakenException $e) {
            return Redirect::to('/auth/register')
                ->withInput(Request::except('password'))
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('gitamin.signup.failure')))
                ->withErrors(trans('gitamin.signup.taken'));
        }

        return Redirect::to('/auth/login')
            ->withSuccess(sprintf('<strong>%s</strong> %s', trans('dashboard.notifications.awesome'), trans('gitamin.signup.success')));
    }

    /**
     * Handle the authenticated request.
     *
     * @return \Illuminate\View\View
     */
    protected function authenticated()
    {
        return Redirect::home()
                ->withSuccess(trans('gitamin.signin.success'));
    }
}
