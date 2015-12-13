<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Handlers\Events\Issue;

use Gitamin\Events\Issue\IssueWasAddedEvent;
use Gitamin\Models\Subscriber;
use Illuminate\Contracts\Mail\MailQueue;
use Illuminate\Mail\Message;
use McCool\LaravelAutoPresenter\Facades\AutoPresenter;

class SendIssueEmailNotificationHandler
{
    /**
     * The mailer instance.
     *
     * @var \Illuminate\Contracts\Mail\Mailer
     */
    protected $mailer;

    /**
     * The subscriber instance.
     *
     * @var \Gitamin\Models\Subscriber
     */
    protected $subscriber;

    /**
     * Create a new send issue email notification handler.
     *
     * @param \Illuminate\Contracts\Mail\Mailer $mailer
     * @param \Gitamin\Models\Subscriber        $subscriber
     */
    public function __construct(MailQueue $mailer, Subscriber $subscriber)
    {
        $this->mailer = $mailer;
        $this->subscriber = $subscriber;
    }

    /**
     * Handle the event.
     *
     * @param \Gitamin\Events\Issue\IssueHasAddedEvent $event
     */
    public function handle(IssueWasAddedEvent $event)
    {
        if (! $event->issue->notify) {
            //return false;
        }

        $issue = AutoPresenter::decorate($event->issue);
        $project = AutoPresenter::decorate($event->issue->project);

        // Only send emails for public issues.
        if (1 === 1) {
            foreach ($this->subscriber->all() as $subscriber) {
                $mail = [
                    'email' => $subscriber->email,
                    'subject' => 'New issue reported.',
                    'has_project' => ($event->issue->project) ? true : false,
                    'project_name' => $project ? $project->name : null,
                    'status' => $issue->humanStatus,
                    'html_content' => $issue->formattedMessage,
                    'text_content' => $issue->message,
                    'token' => $subscriber->token,
                    'unsubscribe_link' => route('subscribe.unsubscribe', ['code' => $subscriber->verify_code]),
                ];
                error_log(var_export($mail, true), 3, '/tmp/mail.log');
                $this->mailer->queue([
                    'html' => 'emails.issues.new-html',
                    'text' => 'emails.issues.new-text',
                ], $mail, function (Message $message) use ($mail) {
                    $message->to($mail['email'])->subject($mail['subject']);
                });
            }
        }
    }
}
