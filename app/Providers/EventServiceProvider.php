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
        // Comment related moments
        'Gitamin\Events\Comment\CommentWasAddedEvent' => [
            'Gitamin\Handlers\Events\Comment\SendCommentMomentHandler',
        ],
        'Gitamin\Events\Comment\CommentWasRemovedEvent' => [
        ],
        'Gitamin\Events\Comment\CommentWasUpdatedEvent' => [
        ],

         // Issue email notifications
        'Gitamin\Events\Issue\IssueWasAddedEvent' => [
            'Gitamin\Handlers\Events\Issue\SendIssueMomentHandler',
            'Gitamin\Handlers\Events\Issue\SendIssueEmailNotificationHandler',
        ],
        'Gitamin\Events\Issue\IssueWasRemovedEvent' => [
        ],
        'Gitamin\Events\Issue\IssueWasUpdatedEvent' => [
        ],

        // Moment related
        'Gitamin\Events\Moment\MomentWasAddedEvent' => [
        ],
        'Gitamin\Events\Moment\MomentWasRemovedEvent' => [
        ],
        'Gitamin\Events\Moment\MomentWasUpdatedEvent' => [
        ],

        // Owner related moments
        'Gitamin\Events\Owner\OwnerWasAddedEvent' => [
            'Gitamin\Handlers\Events\Owner\SendOwnerMomentHandler',
        ],
        'Gitamin\Events\Owner\OwnerWasRemovedEvent' => [
        ],
        'Gitamin\Events\Owner\OwnerWasUpdatedEvent' => [
        ],

        // Project related moments
        'Gitamin\Events\Project\ProjectWasAddedEvent' => [
            'Gitamin\Handlers\Events\Project\SendProjectMomentHandler',
        ],
        'Gitamin\Events\Project\ProjectWasRemovedEvent' => [
            'Gitamin\Handlers\Events\Project\SendProjectMomentHandler',
        ],
        'Gitamin\Events\Project\ProjectWasUpdatedEvent' => [
            'Gitamin\Handlers\Events\Project\SendProjectMomentHandler',
        ],

        // Suscriber
        'Gitamin\Events\Subscriber\SubscriberHasSubscribedEvent' => [
            'Gitamin\Handlers\Events\Subscriber\SendSubscriberVerificationEmailHandler',
        ],
        'Gitamin\Events\Subscriber\SubscriberHasUnsubscribedEvent' => [],
        'Gitamin\Events\Subscriber\SubscriberHasVerifiedEvent' => [],

        // User
        'Gitamin\Events\User\UserWasAddedEvent' => [
            'Gitamin\Handlers\Events\Owner\AddOwnerAfterUserAddedHandler',
        ],
        'Gitamin\Events\User\UserWasInvitedEvent' => [
            'Gitamin\Handlers\Events\User\SendInviteUserEmailHandler',
        ],
    ];
}
