<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Presenters\Traits;

use Gitamin\Scopes\VisibilityScope;

trait HasVisibilities
{
    public static function bootHasVisibilities()
    {
        static::addGlobalScope(new VisibilityScope);
    }
}
