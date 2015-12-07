<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\Carbon;
use Gitamin\Models\Issue;
use Gitamin\Models\Project;
use Gitamin\Models\Owner;
use Gitamin\Models\Subscriber;
use Gitamin\Models\User;

$factory->define(Project::class, function ($faker) {
    return [
        'name'             => $faker->words(2, true),
        'description'      => $faker->paragraph(),
        'path'             => $faker->word(),
        'owner_id'         => 1,
        'creator_id'       => 1,
        'visibility_level' => 1,
    ];
});

$factory->define(Owner::class, function ($faker) {
    return [
        'name'        => $faker->words(2, true),
        'description' => $faker->paragraph(),
        'path'        => $faker->word(),
        'type'        => 'Group',
        'public'      => 1,
        'user_id'     => 1,
    ];
});

$factory->define(Issue::class, function ($faker) {
    return [
        'title'       => $faker->sentence(),
        'description' => $faker->paragraph(),
        'project_id'  => 1,
        'author_id'   => 1,
    ];
});

$factory->define(Subscriber::class, function ($faker) {
    return [
        'email'       => $faker->email,
        'verify_code' => 'Mqr80r2wJtxHCW5Ep4azkldFfIwHhw98M9HF04dn0z',
        'verified_at' => Carbon::now(),
    ];
});

$factory->define(User::class, function ($faker) {
    return [
        'username'       => $faker->userName,
        'email'          => $faker->email,
        'password'       => str_random(10),
        'remember_token' => str_random(10),
        'api_key'        => str_random(20),
        'active'         => true,
        'level'          => 1,
    ];
});
