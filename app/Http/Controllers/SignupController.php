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
use Gitamin\Commands\Owner\AddOwnerCommand;
use Gitamin\Commands\User\SignupUserCommand;
use Gitamin\Models\Invite;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
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

        if (!$invite || $invite->claimed()) {
            //throw new BadRequestHttpException();
        }

        return View::make('signup')
            ->withCode($invite ? $invite->code : '')
            ->withUsername(Binput::old('username'))
            ->withEmail(Binput::old('emai', $invite ? $invite->email : ''));
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

        try {
            $user = $this->dispatch(new SignupUserCommand(
                Binput::get('username'),
                Binput::get('password'),
                Binput::get('email'),
                2
            ));
            $ownerData = [
                'name'        => $user->username,
                'path'        => $user->username,
                'user_id'     => $user->id,
                'description' => '',
                'type'        => 'User',
            ];
            $this->dispatchFromArray(AddOwnerCommand::class, $ownerData);
        } catch (ValidationException $e) {
            return Redirect::route('auth.signup', ['code' => $code])
                ->withInput(Binput::except('password'))
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('gitamin.signup.failure')))
                ->withErrors($e->getMessageBag());
        }

        //$this->dispatch(new ClaimInviteCommand($invite));

        return Redirect::route('auth.login')
            ->withSuccess(sprintf('<strong>%s</strong> %s', trans('dashboard.notifications.awesome'), trans('gitamin.signup.success')));
    }
}
