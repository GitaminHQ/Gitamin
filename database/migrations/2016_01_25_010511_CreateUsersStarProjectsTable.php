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

class CreateUsersStarProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_star_projects', function (Blueprint $t) {
            $t->engine = 'InnoDB';

            $t->increments('id');
            $t->integer('project_id');
            $t->integer('user_id');
            $t->timestamps();

            $t->index('project_id');
            $t->unique(['user_id', 'project_id']);
            $t->index('user_id');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_star_projects');
    }
}
