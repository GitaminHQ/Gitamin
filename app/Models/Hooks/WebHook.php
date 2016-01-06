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
// Table name: web_hooks
//
//  id                      :integer          not null, primary key
//  url                     :string(255)
//  project_id              :integer
//  created_at              :timestamp
//  updated_at              :timestamp
//  type                    :string(255)      default("ProjectHook")
//  service_id              :integer
//  push_events             :boolean          default(TRUE), not null
//  issues_events           :boolean          default(FALSE), not null
//  pull_requests_events    :boolean          default(FALSE), not null
//  tag_push_events         :boolean          default(FALSE)
//  comment_events          :boolean          default(FALSE), not null
//  enable_ssl_verification :boolean          default(TRUE)
//

namespace Gitamin\Models\Hooks;

use Illuminate\Database\Eloquent\Model;

class WebHook extends Model
{
    //
}
