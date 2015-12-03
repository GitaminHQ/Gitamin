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
# Table name: events
#
#  id          :integer          not null, primary key
#  target_type :string(255)
#  target_id   :integer
#  title       :string(255)
#  data        :text
#  project_id  :integer
#  created_at  :datetime
#  updated_at  :datetime
#  action      :integer
#  author_id   :integer
#

namespace Gitamin\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
}
