<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Commands\Issue;

final class AddIssueCommand
{
    /**
     * The issue name.
     *
     * @var string
     */
    public $name;

    /**
     * The issue status.
     *
     * @var int
     */
    public $status;

    /**
     * The issue message.
     *
     * @var string
     */
    public $message;

    /**
     * The issue visibility.
     *
     * @var int
     */
    public $visible;

    /**
     * The issue user.
     *
     * @var int
     */
    public $user_id;

    /**
     * The issue project.
     *
     * @var int
     */
    public $project_id;

    /**
     * Whether to notify about the issue or not.
     *
     * @var bool
     */
    public $notify;

    /**
     * The date at which the issue occurred.
     *
     * @var string|null
     */
    public $issue_date;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'           => 'required|string',
        'status'         => 'required|int|min:0|max:4',
        'message'        => 'string',
        'visible'        => 'bool',
        'user_id'        => 'int',
        'project_id'     => 'int',
        'notify'         => 'bool',
        'issue_date'     => 'string',
    ];

    /**
     * Create a new add issue command instance.
     *
     * @param string      $name
     * @param int         $status
     * @param string      $message
     * @param int         $visible
     * @param int         $user_id
     * @param int         $project_id
     * @param bool        $notify
     * @param string|null $issue_date
     *
     * @return void
     */
    public function __construct($name, $status, $message, $visible, $user_id, $project_id, $notify, $issue_date)
    {
        $this->name = $name;
        $this->status = $status;
        $this->message = $message;
        $this->visible = $visible;
        $this->user_id = $user_id;
        $this->project_id = $project_id;
        $this->notify = $notify;
        $this->issue_date = $issue_date;
    }
}
