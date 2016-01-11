<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Config;

use Gitamin\Models\Setting;

class Config
{
    /**
     * The eloquent model instance.
     *
     * @var \Gitamin\Models\Setting
     */
    protected $model;

    /**
     * Is the config state stale?
     *
     * @var bool
     */
    protected $stale = false;

    /**
     * Create a new settings service instance.
     *
     * @param \Gitamin\Models\Setting $model
     */
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    /**
     * Returns all settings from the database.
     *
     * @return array
     */
    public function all()
    {
        return $this->model->all(['name', 'value'])->pluck('value', 'name')->toArray();
    }

    /**
     * Creates or updates a setting value.
     *
     * @param string  $name
     * @param string|null  $value
     */
    public function set($name, $value)
    {
        $this->stale = true;

        if ($value === null) {
            $this->model->where('name', $name)->delete();
        } else {
            $this->model->updateOrCreate(compact('name'), compact('value'));
        }
    }

    /**
     * Is the config state stale?
     *
     * @return bool
     */
    public function stale()
    {
        return $this->stale;
    }
}
