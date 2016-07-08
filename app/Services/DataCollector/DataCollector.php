<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Services\DataCollector;

use Gitamin\Services\DataCollector\Eloquent\DataCollector as BaseDataCollector;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;

class DataCollector extends BaseDataCollector
{
    protected $modelName;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function model($modelName = null)
    {
        $this->modelName = $modelName;
        $this->resetScope();
        $this->makeModel();

        return $this;
    }

    public function makeModel()
    {
        $model = $this->app->make($this->modelName);
        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    public function getIssuesList($limit = 10)
    {
        $this->applyCriteria();

        return $this->model->with('author')->paginate($limit);
    }
}
