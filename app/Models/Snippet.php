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
# Table name: snippets
#
#  id               :integer          not null, primary key
#  title            :string(255)
#  content          :text
#  author_id        :integer          not null
#  project_id       :integer
#  created_at       :timestamp
#  updated_at       :timestamp
#  file_name        :string(255)
#  expires_at       :timestamp
#  type             :string(255)
#  visibility_level :integer          default(0), not null
#


namespace Gitamin\Models;

use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    //
}
