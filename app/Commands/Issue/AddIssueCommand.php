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
     * The issue title.
     *
     * @var string
     */
    public $title;

    /**
     * The issue description.
     *
     * @var string
     */
    public $description;

    /**
     * The issue user.
     *
     * @var int
     */
    public $author_id;

    /**
     * The issue project.
     *
     * @var int
     */
    public $project_id;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'title' => 'required|string',
        'description' => 'string',
        'author_id' => 'int',
        'project_id' => 'int',
    ];

    /**
     * Create a new add issue command instance.
     *
     * @param string $title
     * @param string $description
     * @param int    $author_id
     * @param int    $project_id
     */
    public function __construct($title, $description, $author_id, $project_id)
    {
        $this->title = $title;
        $this->description = $description;
        $this->author_id = $author_id;
        $this->project_id = $project_id;
    }
}
