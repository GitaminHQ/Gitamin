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

use AltThree\Validator\ValidatingTrait;
use Gitamin\Presenters\SubscriberPresenter;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;

class Subscriber extends Model implements HasPresenter
{
    use ValidatingTrait;

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id' => 'int',
        'email' => 'string',
        'verify_code' => 'string',
        'verified_at' => 'date',
    ];

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = ['email'];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'email' => 'required|email',
    ];

    /**
     * Overrides the models boot method.
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($user) {
            if (! $user->verify_code) {
                $user->verify_code = self::generateVerifyCode();
            }
        });
    }

    /**
     * Determines if the subscriber is verified.
     *
     * @return bool
     */
    public function verified()
    {
        return $this->verified_at !== null;
    }

    /**
     * Returns an new verify code.
     *
     * @return string
     */
    public static function generateVerifyCode()
    {
        return str_random(42);
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return SubscriberPresenter::class;
    }
}
