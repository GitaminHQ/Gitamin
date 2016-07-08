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

class CreateIssuesTable extends Migration
{
    public function up()
    {
        // Create table for storing issues
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('assignee_id');
            $table->integer('author_id');
            $table->integer('project_id');
            $table->timestamps();
            $table->integer('position')->default(0);
            $table->string('branch_name');
            $table->text('description')->nullable();
            $table->integer('comment_count')->default(0);
            $table->integer('milestone_id');
            $table->string('state');
            $table->integer('iid');
            $table->boolean('confidential');

            $table->index('assignee_id');
            $table->index('author_id');
            $table->index('confidential');
            $table->index('project_id');
            $table->index('milestone_id');
            $table->index('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('issues');
    }
}
