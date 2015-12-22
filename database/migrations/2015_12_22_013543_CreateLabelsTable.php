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

class CreateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $t) {
            $t->engine = 'InnoDB';

            $t->increments('id');
            $t->string('title');
            $t->string('color')->nullable();
            $t->integer('project_id')->default(0);
            $t->timestamps();
            $t->boolean('template')->default(false);

            $t->index('project_id');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('labels');
    }
}
