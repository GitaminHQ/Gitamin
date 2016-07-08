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
use Gitamin\Presenters\UserPresenter;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, HasPresenter
{
    use Authenticatable, CanResetPassword, ValidatingTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'username' => ['required', 'max:15', 'regex:/\A[A-Za-z0-9\-\_\.]+\z/'],
        'email'    => 'required|max:255',
        'password' => 'required',
    ];

    public function getAvatarAttribute()
    {
        return $this->avatar_url ? $this->avatar_url : '/img/avatar.jpg';
    }

    public function getAvatarSmallAttribute()
    {
        return $this->avatar_url ? $this->avatar_url : '/img/avatar_small.jpg';
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return UserPresenter::class;
    }
}
