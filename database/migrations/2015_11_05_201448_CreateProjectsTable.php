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
        Schema::create('projects', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name');
            $table->string('path');
            $table->text('description');
            $table->timestamps();
            $table->integer('creator_id')->nullable();
            $table->boolean('issues_enabled')->default(true);
            $table->boolean('wall_enabled')->default(true);
            $table->boolean('merge_requests_enabled')->default(true);
            $table->boolean('wiki_enabled')->default(true);
            $table->integer('owner_id');
            $table->string('issues_tracker')->default('gitamin');
            $table->string('issues_tracker_id')->nullable();
            $table->boolean('snippets_enabled')->default(true);
            $table->datetime('last_activity_at')->nullable();
            $table->string('import_url')->nullable();
            $table->integer('visibility_level')->default(0);
            $table->boolean('archived')->default(false);
            $table->string('avatar')->nullable();
            $table->string('import_status')->nullable();
            $table->float('repository_size')->default(0.0);
            $table->integer('star_count')->default(0);
            $table->string('import_type')->nullable();
            $table->string('import_source')->nullable();
            $table->integer('commit_count')->default(0);
            $table->boolean('merge_requests_ff_only_enabled')->default(false);
            $table->text('issues_template')->nullable();
            $table->text('import_error')->nullable();

            $table->softDeletes();

            $table->index('owner_id');
            $table->index('creator_id');
            $table->index('path');

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
