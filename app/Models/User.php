<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

# == Schema Information
#
# Table name: users
#
#  id             :integer          not null, primary key
#  username       :string(255)
#  password       :string(255)
#  remember_token :string(100)
#  email          :integer
#  api_key        :string(255)
#  active         :boolean          default(FALSE)
#  level          :integer          default(2)
#  created_at     :timestamp
#  updated_at     :timestamp
#  location       :string(255)      default('')
#  public_email   :string(255)      default('')
#  website_url    :string(255)      default('')
#

namespace Gitamin\Models;

use AltThree\Validator\ValidatingTrait;
use Gitamin\Exceptions\UserAlreadyTakenException;
use Gitamin\Models\Members\GroupMember;
use Gitamin\Models\Members\ProjectMember;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, ValidatingTrait, EntrustUserTrait;

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id' => 'int',
        'username' => 'string',
        'email' => 'string',
        'api_key' => 'string',
        'active' => 'bool',
        'level' => 'int',
    ];

    /**
     * The properties that cannot be mass assigned.
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * The hidden properties.
     *
     * These are excluded when we are serializing the model.
     *
     * @var string[]
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'username' => ['required', 'regex:/\A(?!.*[:;]-\))[ -~]+\z/'],
        'email' => 'required|email',
        'password' => 'required',
    ];

    /**
     * Overrides the models boot method.
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($user) {
            $ownerExists = Owner::where('path', '=', $user->username)->exists();
            $userExists = User::where('username', '=', $user->username)->orWhere('email', '=', $user->email)->exists();
            if ($ownerExists === true || $userExists === true) {
                throw new UserAlreadyTakenException('Username or email has already been taken.');
            }

            if (! $user->api_key) {
                $user->api_key = self::generateApiKey();
            }
        });
    }

    /**
     * Hash any password being inserted by default.
     *
     * @param string $password
     *
     * @return \Gitamin\Models\User
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);

        return $this;
    }

    /**
     * Get check permissions of user.
     * 
     * @param string  $check
     */
    public function hasPermission($check)
    {
        return true;
    }

    /**
     * Returns a Gravatar URL for the users email address.
     *
     * @param int $size
     *
     * @return string
     */
    public function getGravatarAttribute($size = 200)
    {
        return 'https://avatars2.githubusercontent.com/u/15867969?v=3&s=40';
        //return sprintf('https://www.gravatar.com/avatar/%s?size=%d', md5($this->email), $size);
    }

    /**
     * Returns a Gravatar URL for the users email address.
     *
     * @param int $size
     *
     * @return string
     */
    public function getAvatarAttribute($size = 200)
    {
        return '/img/no_user_avatar.png';
        //return sprintf('https://www.gravatar.com/avatar/%s?size=%d', md5($this->email), $size);
    }

    /**
     * Returns a user profile URL.
     *
     * @param int $size
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('owners.owner_show', ['path' => $this->username]);
        //return sprintf('https://www.gravatar.com/avatar/%s?size=%d', md5($this->email), $size);
    }

    /**
     * Find by api_key, or throw an exception.
     *
     * @param string   $token
     * @param string[] $columns
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return \Gitamin\Models\User
     */
    public static function findByApiToken($token, $columns = ['*'])
    {
        $user = static::where('api_key', $token)->first($columns);

        if (! $user) {
            throw new ModelNotFoundException();
        }

        return $user;
    }

    /**
     * Returns an API key.
     *
     * @return string
     */
    public static function generateApiKey()
    {
        return str_random(20);
    }

    /**
     * Returns whether a user is approved.
     *
     * @return bool
     */
    public function isApproved()
    {
        return $this->active == 1;
    }

    /**
     * Returns whether a user is at admin level.
     *
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        return $this->level === 1;
    }

    /**
     * A user can have many issues.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function issues()
    {
        return $this->hasMany(Issue::class, 'user_id', 'id');
    }

    /**
     * A owner can have many groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function owned_groups()
    {
        return $this->hasMany(Group::class, 'owner_id', 'id');
    }

    /**
     * Returns the groups a user is authorized to access.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authorized_groups()
    {
        $groupIds = GroupMember::where('user_id', '=', $this->id)->where('target_type', '=', 'Group')->lists('target_id')->toArray();

        return Group::whereIn('id', $groupIds)->get();
    }

    /**
     * A owner can have many projects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function owned_projects()
    {
        return $this->hasMany(Project::class, 'owner_id', 'id');
    }

    /**
     * Returns the projects a user is authorized to access.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authorized_projects()
    {
        $projectIds = ProjectMember::where('user_id', '=', $this->id)->where('target_type', '=', 'Project')->lists('target_id')->toArray();

        return Project::whereIn('id', $projectIds)->get();
    }
}
