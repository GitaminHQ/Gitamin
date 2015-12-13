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

use Gitamin\Models\Issue;

final class RemoveIssueCommand
{
    /**
     * The issue to remove.
     *
     * @var \Gitamin\Models\Issue
     */
    public $issue;

    /**
     * Create a new remove issue command instance.
     *
     * @param \Gitamin\Models\Issue $issue
     */
    public function __construct(Issue $issue)
    {
        $this->issue = $issue;
    }
}
