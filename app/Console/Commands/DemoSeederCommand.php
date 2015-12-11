<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Console\Commands;

use Gitamin\Models\Comment;
use Gitamin\Models\Issue;
use Gitamin\Models\Moment;
use Gitamin\Models\Owner;
use Gitamin\Models\Project;
use Gitamin\Models\Setting;
use Gitamin\Models\Subscriber;
use Gitamin\Models\User;
use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Symfony\Component\Console\Input\InputOption;

/**
 * This is the demo seeder command.
 */
class DemoSeederCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'gitamin:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds Gitamin with demo data.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (!$this->confirmToProceed()) {
            return;
        }

        $this->seedOwners();
        $this->seedProjects();
        $this->seedIssues();
        $this->seedComments();
        $this->seedMoments();
        $this->seedSettings();
        $this->seedSubscribers();
        $this->seedUsers();

        $this->info('Database seeded with demo data successfully!');
    }

    /**
     * Seed the project teams table.
     *
     * @return void
     */
    protected function seedOwners()
    {
        $defaultOwners = [
            [
                'name'        => 'Baidu',
                'path'        => 'Baidu',
                'user_id'     => 1,
                'description' => 'www.baidu.com',
                'type'        => 'Group',
            ],
            [
                'name'        => 'Alibaba',
                'path'        => 'Alibaba',
                'user_id'     => 1,
                'description' => 'www.alibaba.com',
                'type'        => 'Group',
            ],
            [
                'name'        => 'Tencent',
                'path'        => 'Tencent',
                'user_id'     => 1,
                'description' => 'www.qq.com',
                'type'        => 'Group',
            ],
            [
                'name'        => 'demo',
                'path'        => 'demo',
                'user_id'     => 1,
                'description' => '',
                'type'        => 'User',
            ],
        ];

        Owner::truncate();

        foreach ($defaultOwners as $owner) {
            Owner::create($owner);
        }
    }

    /**
     * Seed the projects table.
     *
     * @return void
     */
    protected function seedProjects()
    {
        $defaultProjects = [
            [
                'name'             => 'API',
                'description'      => 'Used by third-parties to connect to us',
                'visibility_level' => 0,
                'owner_id'         => 1,
                'creator_id'       => 1,
                'path'             => 'api',
            ], [
                'name'             => 'Documentation',
                'description'      => 'Kindly powered by Readme.io',
                'visibility_level' => 1,
                'owner_id'         => 2,
                'creator_id'       => 1,
                'path'             => 'doc',
            ], [
                'name'             => 'Website',
                'description'      => 'Tencent Holdings Limited is a Chinese investment holding company',
                'visibility_level' => 1,
                'owner_id'         => 3,
                'creator_id'       => 1,
                'path'             => 'website',
            ], [
                'name'             => 'Blog',
                'description'      => 'The Gitamin Blog.',
                'visibility_level' => 1,
                'owner_id'         => 4,
                'creator_id'       => 1,
                'path'             => 'blog',
            ],
        ];

        Project::truncate();

        foreach ($defaultProjects as $project) {
            Project::create($project);
        }
    }

    /**
     * Seed the issues table.
     *
     * @return void
     */
    protected function seedIssues()
    {
        $defaultIssues = [
            [
                'title'       => 'Awesome',
                'description' => ':+1: We totally nailed the fix.',
                'author_id'   => 1,
                'project_id'  => 1,
            ],
            [
                'title'       => 'Monitoring the fix',
                'description' => ":ship: We've deployed a fix.",
                'author_id'   => 3,
                'project_id'  => 2,
            ],
            [
                'title'       => 'Update',
                'description' => "We've identified the problem. Our engineers are currently looking at it.",
                'author_id'   => 2,
                'project_id'  => 1,
            ],
            [
                'title'       => 'Test Issue',
                'description' => 'Something went wrong, with something or another.',
                'author_id'   => 1,
                'project_id'  => 2,
            ],
            [
                'title'       => 'Investigating the API',
                'description' => ':zap: We\'ve seen high response times from our API. It looks to be fixing itself as time goes on.',
                'author_id'   => 1,
                'project_id'  => 3,
            ],
        ];

        Issue::truncate();

        foreach ($defaultIssues as $issue) {
            Issue::create($issue);
        }
    }

    /**
     * Seed the comments table.
     *
     * @return void
     */
    protected function seedComments()
    {
        $defaultComments = [
            [
                'message'     => ':+1: We totally nailed the fix.',
                'target_type' => 'Issue',
                'target_id'   => 3,
                'author_id'   => 1,
                'project_id'  => 1,
            ],
            [
                'message'     => ":ship: We've deployed a fix.",
                'target_type' => 'MergeRequest',
                'target_id'   => 1,
                'author_id'   => 3,
                'project_id'  => 2,
            ],
            [
                'message'     => "We've identified the problem. Our engineers are currently looking at it.",
                'target_type' => 'Issue',
                'target_id'   => 1,
                'author_id'   => 2,
                'project_id'  => 1,
            ],
            [
                'message'     => 'Something went wrong, with something or another.',
                'target_type' => 'Issue',
                'target_id'   => 1,
                'author_id'   => 1,
                'project_id'  => 2,
            ],
            [
                'message'     => ':zap: We\'ve seen high response times from our API. It looks to be fixing itself as time goes on.',
                'target_type' => 'MergeRequest',
                'target_id'   => 1,
                'author_id'   => 1,
                'project_id'  => 3,
            ],
        ];

        Comment::truncate();

        foreach ($defaultComments as $comment) {
            Comment::create($comment);
        }
    }

    /**
     * Seed the comments table.
     *
     * @return void
     */
    protected function seedMoments()
    {
        $defaultMoments = [
            [
                'message'     => ':+1: We totally nailed the fix.',
                'target_type' => 'Issue',
                'target_id'   => 3,
                'action'      => Moment::COMMENTED,
                'author_id'   => 1,
                'project_id'  => 1,
            ],
            [
                'message'     => ":ship: We've deployed a fix.",
                'target_type' => 'Issue',
                'target_id'   => 2,
                'action'      => Moment::CREATED,
                'author_id'   => 1,
                'project_id'  => 2,
            ],
        ];

        Moment::truncate();

        foreach ($defaultMoments as $moment) {
            Moment::create($moment);
        }
    }

    /**
     * Seed the settings table.
     *
     * @return void
     */
    protected function seedSettings()
    {
        $defaultSettings = [
            [
                'name'  => 'app_name',
                'value' => 'Gitamin Demo',
            ],
            [
                'name'  => 'app_domain',
                'value' => 'https://demo.gitamin.com',
            ],
            [
                'name'  => 'app_locale',
                'value' => 'en',
            ],
            [
                'name'  => 'app_timezone',
                'value' => 'Asia/Shanghai',
            ],
            [
                'name'  => 'app_issue_days',
                'value' => '7',
            ],
        ];

        Setting::truncate();

        foreach ($defaultSettings as $setting) {
            Setting::create($setting);
        }
    }

    /**
     * Seed the subscribers.
     *
     * @return void
     */
    protected function seedSubscribers()
    {
        Subscriber::truncate();
    }

    /**
     * Seed the users table.
     *
     * @return void
     */
    protected function seedUsers()
    {
        $users = [
            [
                'username' => 'demo',
                'password' => 'demo',
                'email'    => 'demo@gitamin.com',
                'level'    => 1,
                'api_key'  => '9yMHsdioQosnyVK4iCVR',
            ],
        ];

        User::truncate();

        foreach ($users as $user) {
            User::create($user);
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'],
        ];
    }
}
