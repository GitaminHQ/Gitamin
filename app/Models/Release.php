<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// == Schema Information
//
// Table name: releases
//
//  id          :integer          not null, primary key
//  tag         :string(255)
//  description :text
//  project_id  :integer
//  created_at  :timestamp
//  updated_at  :timestamp
//

namespace Gitamin\Models;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    //
}
