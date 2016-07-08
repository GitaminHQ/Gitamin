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

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->integer('access_level');
            $table->integer('source_id');
            $table->string('source_type');
            $table->integer('user_id');
            $table->integer('notification_level');
            $table->string('type');
            $table->timestamps();

            $table->index('access_level');
            $table->index('user_id');
            $table->index('type');
            $table->index(['source_id', 'source_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('members');
    }
}
