<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    'dashboard' => 'Dashboard',

    // Projects
    'projects' => [
        'projects'         => 'Projects',
        'project_statuses' => 'Project Statuses',
        'listed_team'      => 'Teamed under :name',

        'all'              => 'All',
        'yours'            => 'Your Projects',
        'starred'          => 'Starred Projects',
        'explore'          => 'Explore Projects',

        'new'              => [
            'title'   => 'New Project',
            'message' => 'You don\'t have access to any projects right now. You can create up to 100000 projects.',
            'success' => 'Project was successfully created.',
            'failure' => 'Something went wrong with the project.',
        ],
        'edit' => [
            'title'   => 'Project settings',
            'success' => 'Project was successfully updated.',
            'failure' => 'Something went wrong with the project.',
        ],
        'delete' => [
            'success' => 'Project deleted.',
            'failure' => 'The Project could not be deleted. Please try again.',
        ],

        // Project labels
        'labels' => [
            'labels'    => 'Project label|Project labels',
            'no_labels' => 'You should add a project label.',
            'add'       => [
                'title'   => 'Add a Project Label',
                'success' => 'Project label added.',
                'failure' => 'Something went wrong with the project label.',
            ],
            'edit' => [
                'title'   => 'Edit a Project Label',
                'success' => 'Project label updated.',
                'failure' => 'Something went wrong with the project label.',
            ],
            'delete' => [
                'success' => 'Project :abel deleted.',
                'failure' => 'The Project Label could not be deleted. Please try again.',
            ],
        ],
    ],

    // Moments
    'moments' => [
        'moments'         => 'Moments',
        'all'             => 'All',
        'project_update'  => 'Project updated',
        'topic'           => 'Topic',
        'watched_project' => 'Project watched',
        'add'             => [
            'title'   => 'No Moments.',
            'message' => 'There are no activities.',
        ],
    ],

    // Subscribers
    'subscribers' => [
        'subscribers'  => 'Subscribers',
        'description'  => 'Subscribers will receive email updates when issues are created.',
        'verified'     => 'Verified',
        'not_verified' => 'Not Verified',
        'add'          => [
            'title'   => 'Add a New Subscriber',
            'success' => 'Subscriber added.',
            'failure' => 'Something went wrong with the project.',
        ],
        'edit' => [
            'title'   => 'Update Subscriber',
            'success' => 'Subscriber updated.',
            'failure' => 'Something went wrong when updating.',
        ],
    ],

    // Group
    'groups' => [
        'groups'      => 'Groups',
        'no_items'    => 'You should add a group.',
        'member'      => 'Member',
        'profile'     => 'Profile',
        'description' => 'Group Members will be able to add, modify &amp; edit projects and issues.',
        'new'         => [
            'title'   => 'New Group',
            'message' => 'You can create a group for several dependent projects. Groups are the best way to manage projects and members.',
            'success' => 'Group added.',
            'failure' => 'Something went wrong with the user.',
        ],
        'edit' => [
            'title'   => 'Update Profile',
            'success' => 'Profile updated.',
            'failure' => 'Something went wrong when updating.',
        ],
        'delete' => [
            'success' => 'User deleted.',
            'failure' => 'Something went wrong when deleting this user.',
        ],
        'invite' => [
            'title'   => 'Invite a New Group Member',
            'success' => 'The users invited.',
            'failure' => 'Something went wrong with the invite.',
        ],
    ],

    // Milestones
    'milestones' => [
        'milestones' => 'Milestones',
        'add'        => [
            'title'   => 'Add a New Milestone',
            'message' => 'You should add a Milestone.',
        ],
    ],

    // Issues
    'issues' => [
        'issues'   => 'Issues',
        'title'    => 'Issues',
        'all'      => 'All',
        'open'     => 'Open',
        'closed'   => 'Closed',
        'no_items' => 'No issues to show',
        'logged'   => '{0} There are no issues, good work.|You have logged one issue.|You have reported <strong>:count</strong> issues.',
        'add'      => [
            'title'   => 'New Issue',
            'success' => 'Issue added.',
            'failure' => 'Something went wrong with the issue.',
        ],
        'edit' => [
            'title'   => 'Edit an Issue',
            'success' => 'Issue updated.',
            'failure' => 'Something went wrong with the issue.',
        ],
        'delete' => [
            'success' => 'The issue has been deleted and will not show on your Gitamin.',
            'failure' => 'The issue could not be deleted. Please try again.',
        ],
    ],

    // Pull Requests
    'pull_requests' => [
        'pull_requests' => 'Pull Requests',
        'add'           => [
            'title'   => 'Add a New pull request.',
            'message' => 'There are no pull requests.',
        ],
    ],

    //Snippets
    'snippets' => [
        'snippets' => 'Snippets',
        'add'      => [
            'title'   => 'Add a New Snippet',
            'message' => 'There are no snippets.',
        ],
    ],

    // Login
    'login' => [
        'login'      => 'Login',
        'signup'     => 'Sign up',
        'logged_in'  => 'You\'re logged in.',
        'welcome'    => 'Welcome Back!',
        'two-factor' => 'Please enter your token.',
    ],

    // Navbar
    'profile'     => 'Profile',

    // Sidebar footer
    'help'        => 'Help',
    'explore'     => 'Explore',
    'logout'      => 'Logout',

    // Notifications
    'notifications' => [
        'notifications' => 'Notifications',
        'awesome'       => 'Awesome.',
        'whoops'        => 'Whoops.',
    ],

    // Welcome modal
    'welcome' => [
        'welcome' => 'Welcome to your Gitamin!',
        'message' => 'Your Gitamin is almost ready! You might want to configure these extra settings',
        'close'   => 'Just go straight to my dashboard',
        'steps'   => [
            'project'    => 'Create projects',
            'issue'      => 'Create issues',
            'customize'  => 'Customize',
            'group'      => 'Add users',
            'api'        => 'Generate API token',
            'two-factor' => 'Two Factor Authentication',
        ],
    ],

];
