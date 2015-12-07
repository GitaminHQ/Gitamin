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
            $table->integer('creator_id');
            $table->boolean('issues_enabled')->default(true);
            $table->boolean('wall_enabled')->default(true);
            $table->boolean('merge_requests_enabled')->default(true);
            $table->boolean('wiki_enabled')->default(true);
            $table->integer('owner_id');
            $table->string('issues_tracker');
            $table->string('issues_tracker_id');
            $table->boolean('snippets_enabled')->default(true);
            $table->datetime('last_activity_at');
            $table->string('import_url');
            $table->integer('visibility_level')->default(0);
            $table->boolean('archived')->default(false);
            $table->string('avatar');
            $table->string('import_status');
            $table->float('repository_size')->default(0.0);
            $table->integer('star_count');
            $table->string('import_type');
            $table->string('import_source');
            $table->integer('commit_count')->default(0);

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
