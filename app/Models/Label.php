<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

#
# Table name: labels
#
#  id         :integer          not null, primary key
#  title      :string(255)
#  color      :string(255)
#  project_id :integer
#  created_at :datetime
#  updated_at :datetime
#  template   :boolean          default(FALSE)
#

namespace Gitamin\Models;

use Gitamin\Presenters\LabelPresenter;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;

class Label  extends Model implements HasPresenter
{
    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'color',
        'project_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the issues that are assigned this label.
     */
    public function issues()
    {
        return $this->morphedByMany(Issue::class, 'labelable');
    }

    /**
     * Get all of the projects that are assigned this label.
     */
    public function pull_requests()
    {
        return $this->morphedByMany(PullRequest::class, 'labelable');
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return LabelPresenter::class;
    }
}
