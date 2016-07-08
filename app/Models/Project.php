<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * A project belongs to an owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function getRepository()
    {
        $path = config('gitamin.repositories_path').DIRECTORY_SEPARATOR.$this->owner->slug.DIRECTORY_SEPARATOR.$this->slug;

        return app('git')->getRepository($path);
    }
}
