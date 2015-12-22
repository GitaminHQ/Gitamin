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

class Labelable extends Model
{
    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'label_id',
        'labelable_type',
        'labelable_id',
        'created_at',
        'updated_at',
    ];
}
