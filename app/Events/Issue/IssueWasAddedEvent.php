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

final class IssueWasAddedEvent implements IssueEventInterface
{
    /**
     * The issue that has been reported.
     *
     * @var \Gitamin\Models\Issue
     */
    public $issue;

    /**
     * Create a new issue has reported event instance.
     */
    public function __construct(Issue $issue)
    {
        $this->issue = $issue;
    }
}
