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
#  id               :integer          not null, primary key
#  message          :text
#  commentable_type :string(255)
#  commentable_id   :integer
#  author_id        :integer
#  created_at       :timestamp
#  updated_at       :timestamp
#  project_id       :integer
#  attachment       :string(255)
#  line_code        :string(255)
#  commit_id        :string(255)
#  system           :boolean          default(FALSE), not null
#  st_diff          :text
#  updated_by_id    :integer
#  is_award         :boolean
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
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id' => 'int',
        'deleted_at' => 'date',
    ];

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'message',
        'commentable_type',
        'commentable_id',
        'author_id',
        'project_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'author_id' => 'int',
        'project_id' => 'int',
        'message' => 'required',
        'commentable_type' => 'string|required',
        'commentable_id' => 'int',
    ];

    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * A comment belongs to a project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    /**
     * Comments can belong to an author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

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
