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

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $t) {
            $t->engine = 'InnoDB';

            $t->increments('id');
            $t->string('name');
            $t->string('path');
            $t->text('description');
            $t->timestamps();
            $t->integer('creator_id')->nullable();
            $t->boolean('issues_enabled')->default(true);
            $t->boolean('wall_enabled')->default(true);
            $t->boolean('pull_requests_enabled')->default(true);
            $t->boolean('wiki_enabled')->default(true);
            $t->integer('owner_id');
            $t->string('issues_tracker')->default('gitamin');
            $t->string('issues_tracker_id')->nullable();
            $t->boolean('snippets_enabled')->default(true);
            $t->timestamp('last_activity_at')->nullable();
            $t->string('import_url')->nullable();
            $t->integer('visibility_level')->default(0);
            $t->boolean('archived')->default(false);
            $t->string('avatar')->nullable();
            $t->string('import_status')->nullable();
            $t->float('repository_size')->default(0.0);
            $t->integer('star_count')->default(0);
            $t->string('import_type')->nullable();
            $t->string('import_source')->nullable();
            $t->integer('commit_count')->default(0);
            $t->boolean('pull_requests_ff_only_enabled')->default(false);
            $t->text('issues_template')->nullable();
            $t->text('import_error')->nullable();

            $t->softDeletes();

            $t->index(['created_at', 'id']);
            $t->index('creator_id');
            $t->index('last_activity_at');
            $t->index('owner_id');
            $t->index('path');
            $t->index('star_count');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
