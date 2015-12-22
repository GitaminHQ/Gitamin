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
use Gitamin\Models\Member;
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
     */
    public function fire()
    {
        if (! $this->confirmToProceed()) {
            return;
        }
        $this->seedInit();
        $this->seedUsers();
        $this->seedOwners();
        $this->seedProjects();
        $this->seedMembers();
        $this->seedIssues();
        $this->seedComments();
        $this->seedMoments();
        $this->seedSettings();
        $this->seedSubscribers();

        $this->info('Database seeded with demo data successfully!');
    }

    /**
     * Truncate all tables.
     */
    protected function seedInit()
    {
        Owner::truncate();
        User::truncate();
        Project::truncate();
        Member::truncate();
        Issue::truncate();
        Comment::truncate();
        Moment::truncate();
        Setting::truncate();
        Subscriber::truncate();
    }

    /**
     * Seed the project teams table.
     */
    protected function seedOwners()
    {
        $defaultOwners = [
            [
                'name' => 'Baidu',
                'path' => 'Baidu',
                'user_id' => 1,
                'description' => 'www.baidu.com',
                'type' => 'Group',
            ],
            [
                'name' => 'Alibaba',
                'path' => 'Alibaba',
                'user_id' => 1,
                'description' => 'www.alibaba.com',
                'type' => 'Group',
            ],
            [
                'name' => 'Tencent',
                'path' => 'Tencent',
                'user_id' => 1,
                'description' => 'www.qq.com',
                'type' => 'Group',
            ],
            [
                'name' => 'demo',
                'path' => 'demo',
                'user_id' => 1,
                'description' => 'user',
                'type' => 'User',
            ],
            [
                'name' => 'jack',
                'path' => 'jack',
                'user_id' => 2,
                'description' => 'user',
                'type' => 'User',
            ],
            [
                'name' => 'larry',
                'path' => 'larry',
                'user_id' => 3,
                'description' => 'user',
                'type' => 'User',
            ],
        ];

        foreach ($defaultOwners as $owner) {
            Owner::create($owner);
        }
    }

    /**
     * Seed the projects table.
     */
    protected function seedProjects()
    {
        $defaultProjects = [
            [
                'name' => 'API',
                'description' => 'Used by third-parties to connect to us',
                'visibility_level' => 0,
                'owner_id' => 1,
                'creator_id' => 1,
                'path' => 'api',
            ], [
                'name' => 'Documentation',
                'description' => 'Kindly powered by Readme.io',
                'visibility_level' => 1,
                'owner_id' => 2,
                'creator_id' => 1,
                'path' => 'doc',
            ], [
                'name' => 'Website',
                'description' => 'Tencent Holdings Limited is a Chinese investment holding company',
                'visibility_level' => 1,
                'owner_id' => 3,
                'creator_id' => 1,
                'path' => 'website',
            ], [
                'name' => 'Blog',
                'description' => 'The Gitamin Blog.',
                'visibility_level' => 1,
                'owner_id' => 4,
                'creator_id' => 1,
                'path' => 'blog',
            ],
        ];

        foreach ($defaultProjects as $project) {
            Project::create($project);
        }
    }

    /**
     * Seed the members table.
     */
    protected function seedMembers()
    {
        $defaultMembers = [
            [
                'access_level' => 1,
                'target_type' => 'Project',
                'target_id' => 1,
                'user_id' => 1,
                'notification_level' => 1,
                'type' => 'Developer',
                'created_by_id' => 1,
            ],
        ];

        foreach ($defaultMembers as $member) {
            Member::create($member);
        }
    }

    /**
     * Seed the issues table.
     */
    protected function seedIssues()
    {
        $defaultIssues = [
            [
                'title' => 'Awesome',
                'description' => ':+1: We totally nailed the fix.',
                'author_id' => 1,
                'project_id' => 1,
            ],
            [
                'title' => 'Monitoring the fix',
                'description' => ":ship: We've deployed a fix.",
                'author_id' => 3,
                'project_id' => 2,
            ],
            [
                'title' => 'Update',
                'description' => "We've identified the problem. Our engineers are currently looking at it.",
                'author_id' => 2,
                'project_id' => 1,
            ],
            [
                'title' => 'Test Issue',
                'description' => 'Something went wrong, with something or another.',
                'author_id' => 1,
                'project_id' => 2,
            ],
            [
                'title' => 'Investigating the API',
                'description' => ':zap: We\'ve seen high response times from our API. It looks to be fixing itself as time goes on.',
                'author_id' => 1,
                'project_id' => 3,
            ],
        ];

        foreach ($defaultIssues as $issue) {
            Issue::create($issue);
        }
    }

    /**
     * Seed the comments table.
     */
    protected function seedComments()
    {
        $defaultComments = [
            [
                'message' => ':+1: We totally nailed the fix.',
                'commentable_type' => 'Gitamin\Models\Issue',
                'commentable_id' => 3,
                'author_id' => 1,
                'project_id' => 1,
            ],
            [
                'message' => ":ship: We've deployed a fix.",
                'commentable_type' => 'Gitamin\Models\MergeRequest',
                'commentable_id' => 1,
                'author_id' => 3,
                'project_id' => 2,
            ],
            [
                'message' => "We've identified the problem. Our engineers are currently looking at it.",
                'commentable_type' => 'Gitamin\Models\Issue',
                'commentable_id' => 1,
                'author_id' => 2,
                'project_id' => 1,
            ],
            [
                'message' => 'Something went wrong, with something or another.',
                'commentable_type' => 'Gitamin\Models\Issue',
                'commentable_id' => 1,
                'author_id' => 1,
                'project_id' => 2,
            ],
            [
                'message' => ':zap: We\'ve seen high response times from our API. It looks to be fixing itself as time goes on.',
                'commentable_type' => 'Gitamin\Models\MergeRequest',
                'commentable_id' => 1,
                'author_id' => 1,
                'project_id' => 3,
            ],
        ];

        foreach ($defaultComments as $comment) {
            Comment::create($comment);
        }
    }

    /**
     * Seed the comments table.
     */
    protected function seedMoments()
    {
        $defaultMoments = [
            [
                'message' => ':+1: We totally nailed the fix.',
                'momentable_type' => 'Gitamin\Models\Issue',
                'momentable_id' => 3,
                'action' => Moment::COMMENTED,
                'author_id' => 1,
                'project_id' => 1,
            ],
            [
                'message' => ":ship: We've deployed a fix.",
                'momentable_type' => 'Gitamin\Models\Issue',
                'momentable_id' => 2,
                'action' => Moment::CREATED,
                'author_id' => 1,
                'project_id' => 2,
            ],
        ];

        foreach ($defaultMoments as $moment) {
            Moment::create($moment);
        }
    }

    /**
     * Seed the settings table.
     */
    protected function seedSettings()
    {
        $defaultSettings = [
            [
                'name' => 'app_name',
                'value' => 'Gitamin Demo',
            ],
            [
                'name' => 'app_domain',
                'value' => 'https://demo.gitamin.com',
            ],
            [
                'name' => 'app_locale',
                'value' => 'en',
            ],
            [
                'name' => 'app_timezone',
                'value' => 'Asia/Shanghai',
            ],
            [
                'name' => 'app_issue_days',
                'value' => '7',
            ],
        ];

        foreach ($defaultSettings as $setting) {
            Setting::create($setting);
        }
    }

    /**
     * Seed the subscribers.
     */
    protected function seedSubscribers()
    {
        Subscriber::truncate();
    }

    /**
     * Seed the users table.
     */
    protected function seedUsers()
    {
        $users = [
            [
                'username' => 'demo',
                'password' => 'demo',
                'email' => 'demo@gitamin.com',
                'level' => 1,
            ],
            [
                'username' => 'jack',
                'password' => 'jack',
                'email' => 'jack@gitamin.com',
                'level' => 2,
            ],
            [
                'username' => 'larry',
                'password' => 'larry',
                'email' => 'larry@gitamin.com',
                'level' => 2,
            ],
        ];

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
