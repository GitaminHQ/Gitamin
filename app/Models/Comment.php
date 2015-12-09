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
# Table name: comments
#
#  id            :integer          not null, primary key
#  message       :text
#  target_type   :string(255)
#  author_id     :integer
#  created_at    :datetime
#  updated_at    :datetime
#  project_id    :integer
#  attachment    :string(255)
#  line_code     :string(255)
#  commit_id     :string(255)
#  target_id     :integer
#  system        :boolean          default(FALSE), not null
#  st_diff       :text
#  updated_by_id :integer
#  is_award      :boolean
#

namespace Gitamin\Models;

use AltThree\Validator\ValidatingTrait;
use Gitamin\Presenters\CommentPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class Comment extends Model implements HasPresenter
{
    use SoftDeletes, ValidatingTrait;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'author_id',
        'project_id',
        'message',
        'target_type',
        'target_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'author_id'   => 'int',
        'project_id'  => 'int',
        'message'     => 'required',
        'target_type' => 'string|required',
        'target_id'   => 'int',
    ];

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return CommentPresenter::class;
    }
}
