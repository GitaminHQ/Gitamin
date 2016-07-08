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
    public $authorId;

    public $projectId;

    public $title;

    public $description;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'authorId'    => 'required|int',
        'projectId'   => 'required|int',
        'title'       => 'required|string',
        'description' => 'string',
    ];

    /**
     * Create a new add issue command instance.
     *
     * @param int    $authorId
     * @param int    $projectId
     * @param string $title
     * @param string $description
     */
    public function __construct($authorId, $projectId, $title, $description)
    {
        $this->authorId = $authorId;
        $this->projectId = $projectId;
        $this->title = $title;
        $this->description = $description;
    }
}
