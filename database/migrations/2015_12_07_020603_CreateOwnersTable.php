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

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $t) {
            $t->engine = 'InnoDB';

            $t->increments('id');
            $t->string('name');
            $t->string('path');
            $t->integer('user_id')->nullable();
            $t->string('type')->nullable();
            $t->string('description');
            $t->string('avatar')->nullable();
            $t->boolean('public')->nullable()->default(false);
            $t->timestamps();

            $t->index(['created_at', 'id']);
            $t->index('name');
            $t->index('user_id');
            $t->unique('path');
            $t->index('public');
            $t->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('owners');
    }
}
