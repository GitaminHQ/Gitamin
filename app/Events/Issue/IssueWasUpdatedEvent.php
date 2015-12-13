<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Events\Issue;

use Gitamin\Models\Issue;

class IssueWasUpdatedEvent implements IssueEventInterface
{
    /**
     * The issue that has been updated.
     *
     * @var \Gitamin\Models\Issue
     */
    public $issue;

    /**
     * Create a new issue has updated event instance.
     */
    public function __construct(Issue $issue)
    {
        $this->issue = $issue;
    }
}
