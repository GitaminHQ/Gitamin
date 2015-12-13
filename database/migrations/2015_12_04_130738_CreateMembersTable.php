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

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $t) {
            $t->engine = 'InnoDB';

            $t->increments('id');
            $t->integer('access_level');
            $t->integer('source_id');
            $t->string('source_type');
            $t->integer('user_id');
            $t->integer('notification_level');
            $t->string('type');
            $t->timestamps();
            $t->integer('created_by_id');
            $t->string('invite_email');
            $t->string('invite_token');
            $t->timestamp('invite_accepted_at');

            $t->index('access_level');
            $t->index('created_at');
            $t->index(['source_id', 'source_type']);
            $t->index('type');
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
        Schema::drop('members');
    }
}
