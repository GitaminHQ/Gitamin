<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Services\DataCollector\Criteria;

use Gitamin\Services\DataCollector\Contracts\DataCollectorInterface as DataCollector;

abstract class Criteria
{
    abstract public function apply($model, DataCollector $dataCollector);
}
