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
use Gitamin\Commands\Subscriber\SubscribeSubscriberCommand;
use Gitamin\Commands\Subscriber\UnsubscribeSubscriberCommand;
use Gitamin\Commands\Subscriber\VerifySubscriberCommand;
use Gitamin\Facades\Setting;
use Gitamin\Models\Subscriber;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SubscribeController extends Controller
{
    use DispatchesJobs;

    /**
     * Show the subscribe by email page.
     *
     * @return \Illuminate\View\View
     */
    public function showSubscribe()
    {
        return View::make('subscribe')
            ->withAboutApp(Markdown::convertToHtml(Setting::get('app_about')));
    }

    /**
     * Handle the subscribe user.
     *
     * @return \Illuminate\View\View
     */
    public function postSubscribe()
    {
        try {
            $this->dispatch(new SubscribeSubscriberCommand(Request::get('email')));
        } catch (ValidationException $e) {
            return Redirect::route('subscribe.subscribe')
                ->withInput(Request::all())
                ->withTitle(sprintf('<strong>%s</strong> %s', trans('dashboard.notifications.whoops'), trans('gitamin.subscriber.email.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('explore')
            ->withSuccess(sprintf('<strong>%s</strong> %s', trans('dashboard.notifications.awesome'), trans('gitamin.subscriber.email.subscribed')));
    }

    /**
     * Handle the verify subscriber email.
     *
     * @param string|null $code
     *
     * @return \Illuminate\View\View
     */
    public function getVerify($code = null)
    {
        if ($code === null) {
            throw new NotFoundHttpException();
        }

        $subscriber = Subscriber::where('verify_code', '=', $code)->first();

        if (! $subscriber || $subscriber->verified()) {
            throw new BadRequestHttpException();
        }

        $this->dispatch(new VerifySubscriberCommand($subscriber));

        return Redirect::route('explore')
            ->withSuccess(sprintf('<strong>%s</strong> %s', trans('dashboard.notifications.awesome'), trans('gitamin.subscriber.email.verified')));
    }

    /**
     * Handle the unsubscribe.
     *
     * @param string|null $code
     *
     * @return \Illuminate\View\View
     */
    public function getUnsubscribe($code = null)
    {
        if ($code === null) {
            throw new NotFoundHttpException();
        }

        $subscriber = Subscriber::where('verify_code', '=', $code)->first();

        if (! $subscriber || ! $subscriber->verified()) {
            throw new BadRequestHttpException();
        }

        $this->dispatch(new UnsubscribeSubscriberCommand($subscriber));

        return Redirect::route('explore')
            ->withSuccess(sprintf('<strong>%s</strong> %s', trans('dashboard.notifications.awesome'), trans('gitamin.subscriber.email.unsubscribed')));
    }
}
