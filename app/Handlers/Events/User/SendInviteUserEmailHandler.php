<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Events\User;

use Gitamin\Events\User\UserWasInvitedEvent;
use Illuminate\Contracts\Mail\MailQueue;
use Illuminate\Mail\Message;

class SendInviteUserEmailHandler
{
    /**
     * The mailer instance.
     *
     * @var \Illuminate\Contracts\Mail\MailQueue
     */
    protected $mailer;

    /**
     * Create a new send invite user email handler.
     *
     * @param \Illuminate\Contracts\Mail\Mailer $mailer
     */
    public function __construct(MailQueue $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param \Gitamin\Events\UserWasInvitedEvent $event
     */
    public function handle(UserWasInvitedEvent $event)
    {
        $mail = [
            'email' => $event->invite->email,
            'subject' => 'You have been invited.',
            'link' => route('signup.invite', ['code' => $event->invite->code]),
        ];

        $this->mailer->queue([
            'html' => 'emails.users.invite-html',
            'text' => 'emails.users.invite-text',
        ], $mail, function (Message $message) use ($mail) {
            $message->to($mail['email'])->subject($mail['subject']);
        });
    }
}
