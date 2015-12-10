<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Gitamin\Events\Issue\IssueWasAddedEvent' => [
            'Gitamin\Handlers\Events\Issue\SendIssueEmailNotificationHandler',
        ],
        // Project related moments
        'Gitamin\Events\Project\ProjectWasAdedEvent' => [
            'Gitamin\Handlers\Events\Project\SendProjectMomentHandler',
        ],
        'Gitamin\Events\Project\ProjectWasUpdatedEvent' => [
            'Gitamin\Handlers\Events\Project\SendProjectMomentHandler',
        ],
        'Gitamin\Events\Project\ProjectWasRemovedEvent' => [
            'Gitamin\Handlers\Events\Project\SendProjectMomentHandler',
        ],
        // Suscriber
        'Gitamin\Events\Subscriber\SubscriberHasSubscribedEvent' => [
            'Gitamin\Handlers\Events\Subscriber\SendSubscriberVerificationEmailHandler',
        ],
        'Gitamin\Events\User\UserWasAddedEvent' => [
            //
        ],
        'Gitamin\Events\User\UserWasInvitedEvent' => [
            'Gitamin\Handlers\Events\User\SendInviteUserEmailHandler',
        ],
    ];
}
