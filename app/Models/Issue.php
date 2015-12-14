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
# Table name: issues
#
#  id            :integer          not null, primary key
#  title         :string(255)
#  assignee_id   :integer
#  author_id     :integer
#  project_id    :integer
#  created_at    :timestamp
#  updated_at    :timestamp
#  position      :integer          default(0)
#  branch_name   :string(255)
#  description   :text
#  milestone_id  :integer
#  state         :string(255)
#  iid           :integer
#  updated_by_id :integer
#

namespace Gitamin\Models;

use AltThree\Validator\ValidatingTrait;
use Gitamin\Presenters\IssuePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class Issue extends Model implements HasPresenter
{
    use SoftDeletes, ValidatingTrait;

    /**
     * The accessors to append to the model's serialized form.
     *
     * @var string[]
     */
    protected $appends = ['human_status'];

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
        'author_id',
        'project_id',
        'title',
        'description',
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
        'title' => 'required',
        'description' => 'required',
    ];

    /**
     * Finds all visible issues.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query)
    {
        return $query->where('state', null);
    }

    /**
     * An issue belongs to a project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    /**
     * An issue belongs to an author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * Returns all comments of the issue.
     *
     * @return \Gitamin\Models\Comment[]
     */
    public function comments()
    {
        return Comment::where('target_type', '=', 'Issue')->where('target_id', '=', $this->id)->orderBy('id', 'asc')->get();
    }

    /**
     * Returns a human readable version of the status.
     *
     * @return string
     */
    public function getHumanStatusAttribute()
    {
        $statuses = trans('gitamin.issues.status');

        return $statuses[rand(0, 2)];
        //return $statuses[$this->state];
    }

    public function getUrlAttribute()
    {
        return route('projects.issue_show', ['owner' => $this->project->owner_path, 'project' => $this->project->path, 'issue' => $this->id]);
    }

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
