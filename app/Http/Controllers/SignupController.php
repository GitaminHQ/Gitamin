<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers;

use AltThree\Validator\ValidationException;
use Gitamin\Commands\Invite\ClaimInviteCommand;
use Gitamin\Commands\User\SignupUserCommand;
use Gitamin\Exceptions\UserAlreadyTakenException;
use Gitamin\Models\Invite;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SignupController extends Controller
{
    use DispatchesJobs;

    /**
     * Handle the signup with invite.
     *
     * @param string|null $code
     *
     * @return \Illuminate\View\View
     */
    public function getSignup($code = null)
    {
        if ($code === null) {
            //throw new NotFoundHttpException();
        }

        $invite = Invite::where('code', '=', $code)->first();

        if (! $invite || $invite->claimed()) {
            //throw new BadRequestHttpException();
        }

        return View::make('signup')
            ->withCode($invite ? $invite->code : '')
            ->withPageTitle('signup')
            ->withUsername(Request::old('username'))
            ->withEmail(Request::old('emai', $invite ? $invite->email : ''));
    }

    /**
     * Handle the unsubscribe.
     *
     * @param string|null $code
     *
     * @return \Illuminate\View\View
     */
    public function postSignup($code = null)
    {
        /*
        if ($code === null) {
            throw new NotFoundHttpException();
        }

        $invite = Invite::where('code', '=', $code)->first();

        if (!$invite || $invite->claimed()) {
            throw new BadRequestHttpException();
        }
        */
        $code = 'gitamin';
        try {
            $user = $this->dispatch(new SignupUserCommand(
                Request::get('username'),
                Request::get('password'),
                Request::get('email'),
                2
            ));
        } catch (ValidationException $e) {
            return Redirect::route('signup.signup', ['code' => $code])
                ->withInput(Request::except('password'))
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('gitamin.signup.failure')))
                ->withErrors($e->getMessageBag());
        } catch (UserAlreadyTakenException $e) {
            return Redirect::route('signup.signup', ['code' => $code])
                ->withInput(Request::except('password'))
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('gitamin.signup.failure')))
                ->withErrors(trans('gitamin.signup.taken'));
        }

        //$this->dispatch(new ClaimInviteCommand($invite));

        return Redirect::route('auth.login')
            ->withSuccess(sprintf('<strong>%s</strong> %s', trans('dashboard.notifications.awesome'), trans('gitamin.signup.success')));
    }
}
