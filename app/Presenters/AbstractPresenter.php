<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Presenters;

use Illuminate\Contracts\Support\Arrayable;
use McCool\LaravelAutoPresenter\BasePresenter as BaseLaravelAutoPresenter;

abstract class AbstractPresenter extends BaseLaravelAutoPresenter implements Arrayable
{
    /**
     * The setting config.
     *
     * @var \Gitamin\Config\Config
     */
    protected $setting;

    /**
     * Create a issue presenter instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $resource
     */
    public function __construct($resource)
    {
        parent::__construct($resource);

        $this->setting = app('setting');
    }
}
