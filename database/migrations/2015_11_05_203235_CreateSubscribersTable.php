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

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $t) {
            $t->engine = 'InnoDB';

            $t->increments('id');
            $t->string('email');
            $t->string('verify_code');
            $t->timestamp('verified_at')->nullable();
            $t->timestamps();
            $t->softDeletes();

            $t->unique(['email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('subscribers');
    }
}
