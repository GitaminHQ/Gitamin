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
     * The issue project.
     *
     * @var int
     */
    public $project_id;

    /**
     * The project status.
     *
     * @var int
     */
    public $project_status;

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
        'project_id'     => 'int',
        'project_status' => 'int|min:1|max:4|required_with:project_id',
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
     * @param int         $project_id
     * @param int         $project_status
     * @param bool        $notify
     * @param string|null $issue_date
     *
     * @return void
     */
    public function __construct($name, $status, $message, $visible, $project_id, $project_status, $notify, $issue_date)
    {
        $this->name = $name;
        $this->status = $status;
        $this->message = $message;
        $this->visible = $visible;
        $this->project_id = $project_id;
        $this->project_status = $project_status;
        $this->notify = $notify;
        $this->issue_date = $issue_date;
    }
}
