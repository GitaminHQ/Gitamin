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

use Gitamin\Models\Project;
use Gitamin\Models\ProjectTeam;
use Gitamin\Models\Issue;
use Gitamin\Models\Setting;
use Gitamin\Models\Subscriber;
use Gitamin\Models\User;
use DateInterval;
use DateTime;
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

        $this->seedProjectTeams();
        $this->seedProjects();
        $this->seedIssues();
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
    protected function seedProjectTeams()
    {
        $defaultTeams = [
            [
                'name'  => 'Websites',
                'order' => 1,
            ],
        ];

        ProjectTeam::truncate();

        foreach ($defaultTeams as $team) {
            ProjectTeam::create($team);
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
                'name'        => 'API',
                'description' => 'Used by third-parties to connect to us',
                'status'      => 1,
                'order'       => 0,
                'team_id'     => 0,
                'slug'        => 'Gitamin',
            ], [
                'name'        => 'Documentation',
                'description' => 'Kindly powered by Readme.io',
                'status'      => 1,
                'order'       => 0,
                'team_id'     => 1,
                'slug'        => 'Baidu',
            ], [
                'name'        => 'Website',
                'description' => '',
                'status'      => 1,
                'order'       => 0,
                'team_id'     => 1,
                'slug'        => 'Alibaba',
            ], [
                'name'        => 'Blog',
                'description' => 'The Gitamin Blog.',
                'status'      => 1,
                'order'       => 0,
                'team_id'     => 1,
                'slug'        => 'Tencent',
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
                'name'         => 'Awesome',
                'message'      => ':+1: We totally nailed the fix.',
                'status'       => 4,
                'project_id'   => 0,
                'scheduled_at' => null,
                'visible'      => 1,
            ],
            [
                'name'         => 'Monitoring the fix',
                'message'      => ":ship: We've deployed a fix.",
                'status'       => 3,
                'project_id'   => 0,
                'scheduled_at' => null,
                'visible'      => 1,
            ],
            [
                'name'         => 'Update',
                'message'      => "We've identified the problem. Our engineers are currently looking at it.",
                'status'       => 2,
                'project_id'   => 0,
                'scheduled_at' => null,
                'visible'      => 1,
            ],
            [
                'name'         => 'Test Issue',
                'message'      => 'Something went wrong, with something or another.',
                'status'       => 1,
                'project_id'   => 0,
                'scheduled_at' => null,
                'visible'      => 1,
            ],
            [
                'name'         => 'Investigating the API',
                'message'      => ':zap: We\'ve seen high response times from our API. It looks to be fixing itself as time goes on.',
                'status'       => 1,
                'project_id'   => 1,
                'scheduled_at' => null,
                'visible'      => 1,
            ],
        ];

        Issue::truncate();

        foreach ($defaultIssues as $issue) {
            Issue::create($issue);
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
                'value' => 'https://demo.gitaminhq.io',
            ],
            [
                'name'  => 'app_locale',
                'value' => 'en',
            ],
            [
                'name'  => 'app_timezone',
                'value' => 'Europe/London',
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
                'username' => 'test',
                'password' => 'test123',
                'email'    => 'test@test.com',
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
