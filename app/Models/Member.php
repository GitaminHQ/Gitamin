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
# Table name: members
#
#  id                 :integer          not null, primary key
#  access_level       :integer          not null
#  target_id          :integer          not null
#  target_type        :string(255)      not null
#  user_id            :integer
#  notification_level :integer          not null
#  type               :string(255)
#  created_at         :timestamp
#  updated_at         :timestamp
#  created_by_id      :integer
#  invite_email       :string(255)
#  invite_token       :string(255)
#  invite_accepted_at :timestamp
#

namespace Gitamin\Models;

use AltThree\Validator\ValidatingTrait;
use Gitamin\Presenters\IssuePresenter;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;

class Member extends Model implements HasPresenter
{
    use ValidatingTrait;

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'access_level' => 'int',
        'target_id' => 'int',
        'target_type' => 'string',
        'user_id' => 'int',
        'notification_level' => 'int',
        'type' => 'string',
        'created_by_id' => 'int',
    ];

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'access_level',
        'target_id',
        'target_type',
        'user_id',
        'notification_level',
        'type',
        'created_by_id',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'target_id' => 'required|int',
        'target_type' => 'required|string',
        'user_id' => 'int',
        'type' => 'string',
        'created_by_id' => 'int',
    ];

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return IssuePresenter::class;
    }
}
