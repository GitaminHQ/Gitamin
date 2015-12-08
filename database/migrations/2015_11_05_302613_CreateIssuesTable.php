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

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('title');
            $table->integer('assignee_id')->nullable();
            $table->integer('author_id');
            $table->integer('project_id');
            $table->timestamps();
            $table->integer('position')->nullable()->default(0);
            $table->string('branch_name')->nullable();
            $table->text('description')->nullable();
            $table->integer('milestone_id')->nullable();
            $table->string('state')->nullable();
            $table->integer('iid')->nullable();
            $table->integer('updated_by_id')->nullable();

            $table->softDeletes();

            $table->index('assignee_id');
            $table->index('author_id');
            $table->index('project_id');
            $table->index('state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('issues');
    }
}
