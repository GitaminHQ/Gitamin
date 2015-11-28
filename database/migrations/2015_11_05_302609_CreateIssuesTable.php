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
            $table->integer('project_id')->default(0);
            $table->string('name');
            $table->integer('status');
            $table->boolean('visible')->default(1);
            $table->longText('message');
            $table->integer('user_id')->default(0);
            $table->timestamp('scheduled_at')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->index('project_id');
            $table->index('status');
            $table->index('user_id');
            $table->index('visible');
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
