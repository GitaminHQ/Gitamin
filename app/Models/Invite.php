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

class Invite extends Model
{
    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'email' => 'string',
    ];

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = ['email'];

    /**
     * Overrides the models boot method.
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($invite) {
            if (!$invite->code) {
                $invite->code = self::generateInviteCode();
            }
        });
    }

    /**
     * Returns an invite code.
     *
     * @return string
     */
    public static function generateInviteCode()
    {
        return str_random(20);
    }

    /**
     * Determines if the invite was claimed.
     *
     * @return bool
     */
    public function claimed()
    {
        return $this->claimed_at !== null;
    }
}
