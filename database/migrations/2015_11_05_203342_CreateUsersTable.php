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

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $t) {
            $t->engine = 'InnoDB';

            $t->increments('id');
            $t->string('username');
            $t->string('password');
            $t->string('name')->nullable();
            $t->rememberToken();
            $t->string('email');
            $t->string('avatar')->nullable();
            $t->string('api_key');
            $t->boolean('active')->default(1);
            $t->tinyInteger('level')->default(2);
            $t->timestamps();
            $t->string('location')->nullable();
            $t->string('public_email')->default('');
            $t->string('website_url')->default('');

            $t->index('remember_token');
            $t->index('active');
            $t->unique('username');
            $t->unique('api_key');
            $t->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('users');
    }
}
