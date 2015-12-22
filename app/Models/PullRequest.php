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
# Table name: pull_requests
#
#  id                :integer          not null, primary key
#  target_branch     :string(255)      not null
#  source_branch     :string(255)      not null
#  source_project_id :integer          not null
#  author_id         :integer
#  assignee_id       :integer
#  title             :string(255)
#  created_at        :timestamp
#  updated_at        :timestamp
#  milestone_id      :integer
#  state             :string(255)
#  merge_status      :string(255)
#  target_project_id :integer          not null
#  iid               :integer
#  description       :text
#  position          :integer          default(0)
#  locked_at         :timestamp
#  updated_by_id     :integer
#  merge_error       :string(255)
#

namespace Gitamin\Models;

use Illuminate\Database\Eloquent\Model;

class PullRequest extends Model
{
    /**
     * Get all of the labels for the issue.
     */
    public function labels()
    {
        return $this->morphToMany(Label::class, 'labelable');
    }
}
