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

use Gitamin\Commands\Subscriber\SubscribeSubscriberCommand;
use Gitamin\Commands\Subscriber\UnsubscribeSubscriberCommand;
use Gitamin\Models\Subscriber;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SubscriberController extends AbstractApiController
{
    use DispatchesJobs;

    /**
     * Get all subscribers.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubscribers(Request $request)
    {
        $subscribers = Subscriber::paginate($request->get('per_page', 20));

        return $this->paginator($subscribers, $request);
    }

    /**
     * Create a new subscriber.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postSubscribers(Request $request)
    {
        try {
            $subscriber = $this->dispatch(new SubscribeSubscriberCommand($request->get('email'), $request->get('verify', false)));
        } catch (QueryException $e) {
            throw new BadRequestHttpException();
        }

        return $this->item($subscriber);
    }

    /**
     * Delete a subscriber.
     *
     * @param \Gitamin\Models\Subscriber $subscriber
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteSubscriber(Subscriber $subscriber)
    {
        $this->dispatch(new UnsubscribeSubscriberCommand($subscriber));

        return $this->noContent();
    }
}
