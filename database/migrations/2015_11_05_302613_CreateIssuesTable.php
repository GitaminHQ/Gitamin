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
        Schema::create('issues', function (Blueprint $t) {
            $t->engine = 'InnoDB';

            $t->increments('id');
            $t->string('title');
            $t->integer('assignee_id')->nullable();
            $t->integer('author_id');
            $t->integer('project_id');
            $t->timestamps();
            $t->integer('position')->nullable()->default(0);
            $t->string('branch_name')->nullable();
            $t->text('description')->nullable();
            $t->integer('milestone_id')->nullable();
            $t->string('state')->nullable();
            $t->integer('iid')->nullable();
            $t->integer('updated_by_id')->nullable();

            $t->softDeletes();

            $t->index('assignee_id');
            $t->index('author_id');
            $t->index('project_id');
            $t->index('state');
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
