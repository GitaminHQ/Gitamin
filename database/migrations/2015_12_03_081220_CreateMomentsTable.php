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

class CreateMomentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('moments', function (Blueprint $t) {
            $t->engine = 'InnoDB';

            $t->increments('id');
            $t->string('momentable_type')->nullable();
            $t->integer('momentable_id')->nullable();
            $t->string('title')->nullable();
            $t->text('data')->nullable();

            $t->integer('project_id')->nullable();
            $t->timestamps();
            $t->integer('action');
            $t->integer('author_id');

            $t->index('author_id');
            $t->index('project_id');
            $t->index('momentable_id');
            $t->index('momentable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('moments');
    }
}
