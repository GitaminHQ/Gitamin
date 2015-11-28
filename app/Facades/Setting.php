<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Gitamin\Services\SettingsService
 */
class Setting extends Facade
{
    /**
     * Get the registered name of the project.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'setting';
    }
}
