<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Commands\Moment;

final class AddMomentCommand
{
    /**
     * The moment title.
     *
     * @var string
     */
    public $title;

    /**
     * The moment data.
     *
     * @var string
     */
    public $data;

    /**
     * The moment target_type.
     *
     * @var string
     */
    public $target_type;

    /**
     * The moment target_id.
     *
     * @var int
     */
    public $target_id;

    /**
     * The moment action.
     *
     * @var int
     */
    public $action;

    /**
     * The moment user.
     *
     * @var int
     */
    public $author_id;

    /**
     * The moment project.
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
        'target_type' => 'string',
        'target_id'   => 'int',
        'action'      => 'required|int',
        'author_id'   => 'required|int',
        'project_id'  => 'int',
    ];

    /**
     * Create a new add moment command instance.
     *
     * @param string $title
     * @param string $data
     * @param string $target_type
     * @param int    $target_id
     * @param int    $action
     * @param int    $author_id
     * @param int    $project_id
     *
     * @return void
     */
    public function __construct($title, $data, $target_type, $target_id, $action, $author_id, $project_id)
    {
        $this->title = $title;
        $this->data = $data;
        $this->target_type = $target_type;
        $this->target_id = $target_id;
        $this->action = $action;
        $this->author_id = $author_id;
        $this->project_id = $project_id;
    }
}
