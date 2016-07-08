<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Services\DataCollector\Criteria\Issue;

use Gitamin\Services\DataCollector\Contracts\DataCollectorInterface as DataCollector;
use Gitamin\Services\DataCollector\Criteria\Criteria;

class BelongsToProject extends Criteria
{
    /**
     * @var int
     */
    protected $projectId;

    public function __construct($projectId)
    {
        $this->projectId = $projectId;
    }

    public function apply($model, DataCollector $dataCollector)
    {
        return $model->where('project_id', $this->projectId);
    }
}
