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

class CreateSnippetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snippets', function (Blueprint $t) {
            $t->engine = 'InnoDB';

            $t->increments('id');
            $t->string('title');
            $t->text('content');
            $t->integer('author_id');
            $t->integer('project_id');
            $t->timestamps();
            $t->string('file_name');
            $t->timestamp('expires_at');
            $t->string('type');
            $t->integer('visibility_level')->default(0);

            $t->index('author_id');
            $t->index(['created_at', 'id']);
            $t->index('created_at');
            $t->index('expires_at');
            $t->index('project_id');
            $t->index('visibility_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('snippets');
    }
}
