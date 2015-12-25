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
     * Cache of the settings.
     *
     * @var array|null
     */
    protected $settings;

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
     * Returns a setting from the database.
     *
     * @param string      $name
     * @param string|null $default
     *
     * @return string|null
     */
    public function get($name, $default = null)
    {
        if (! $this->settings) {
            $this->settings = $this->model->all()->pluck('value', 'name');
        }

        if (! empty($this->settings[$name])) {
            return $this->settings[$name];
        }

        return $default;
    }

    /**
     * Creates or updates a setting value.
     *
     * @param string  $name
     * @param string|null  $value
     */
    public function set($name, $value)
    {
        if ($value === null) {
            $this->model->where('name', $name)->delete();
            if ($this->settings && isset($this->settings[$name])) {
                unset($this->settings[$name]);
            }
        } else {
            $this->model->updateOrCreate(compact('name'), compact('value'));

            if ($this->settings) {
                $this->settings[$name] = $value;
            }
        }
    }
}
