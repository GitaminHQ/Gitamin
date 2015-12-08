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

class CreateMergeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merge_requests', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('target_branch');
            $table->integer('source_branch');
            $table->integer('source_project_id');
            $table->integer('author_id');
            $table->integer('assignee_id');
            $table->string('title');
            $table->timestamps();
            $table->integer('milestone_id');
            $table->string('state');
            $table->string('merge_status');
            $table->integer('target_project_id');
            $table->integer('iid');
            $table->text('description');
            $table->integer('position');
            $table->datetime('locked_at');
            $table->integer('updated_by_id');
            $table->string('merge_error');

            $table->index('assignee_id');
            $table->index('author_id');
            $table->index(['created_at', 'id']);
            $table->index('created_at');
            $table->index('milestone_id');
            $table->index('source_branch');
            $table->index('source_project_id');
            $table->index('target_branch');
            $table->index(['target_project_id', 'iid'])->unique();
            $table->index('title');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('merge_requests');
    }
}
