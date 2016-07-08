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
use Hifone\Repositories\Criteria\Criteria;

class Filter extends Criteria
{
    /**
     * @var int
     */
    protected $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    public function apply($model, DataCollector $dataCollector)
    {
        switch ($this->filter) {
            case 'unanswered':
                return $model->where('comment_count', 0)->recent();
                break;
            case 'like':
                return $model->orderBy('like_count', 'desc')->recent();
                break;
            case 'excellent':
                return $model->where('is_excellent', true)->recent();
                break;
            case 'recent':
                return $model->recent();
                break;
            case 'project':
                return $model->recentReply();
                break;
            default:
                return $model->pinAndRecentReply();
                break;
        }
    }
}
