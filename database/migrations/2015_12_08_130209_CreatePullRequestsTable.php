<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePullRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pull_requests', function (Blueprint $t) {
            $t->engine = 'InnoDB';

            $t->increments('id');
            $t->string('target_branch');
            $t->integer('source_branch');
            $t->integer('source_project_id');
            $t->integer('author_id');
            $t->integer('assignee_id');
            $t->string('title');
            $t->timestamps();
            $t->integer('milestone_id');
            $t->string('state');
            $t->string('merge_status');
            $t->integer('target_project_id');
            $t->integer('iid');
            $t->text('description');
            $t->integer('position');
            $t->timestamp('locked_at');
            $t->integer('updated_by_id');
            $t->string('merge_error');

            $t->index('assignee_id');
            $t->index('author_id');
            $t->index(['created_at', 'id']);
            $t->index('created_at');
            $t->index('milestone_id');
            $t->index('source_branch');
            $t->index('source_project_id');
            $t->index('target_branch');
            $t->index(['target_project_id', 'iid'])->unique();
            $t->index('title');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pull_requests');
    }
}
