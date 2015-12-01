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
        'my'               => 'Mine',
        'joined'           => 'Teams',
        'watched'          => 'Watching',

        'add'              => [
            'title'   => 'Add a Project',
            'message' => 'You should add a project.',
            'success' => 'Project created.',
            'failure' => 'Something went wrong with the project.',
        ],
        'edit' => [
            'title'   => 'Edit a Project',
            'success' => 'Project updated.',
            'failure' => 'Something went wrong with the project.',
        ],
        'delete' => [
            'success' => 'Project deleted.',
            'failure' => 'The Project could not be deleted. Please try again.',
        ],

        // Project teams
        'teams' => [
            'teams'       => 'Project team|Project teams',
            'no_projects' => 'You should add a project team.',
            'add'         => [
                'title'   => 'Add a Project Team',
                'success' => 'Project team added.',
                'failure' => 'Something went wrong with the project team.',
            ],
            'edit'        => [
                'title'   => 'Edit a Project Team',
                'success' => 'Project team updated.',
                'failure' => 'Something went wrong with the project team.',
            ],
            'delete'      => [
                'success' => 'Project Team deleted.',
                'failure' => 'The Project Team could not be deleted. Please try again.',
            ],
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

    // Project teams
    'teams' => [
        'teams'       => 'Teams',
        'no_projects' => 'You should add a project team.',
        'add'         => [
            'title'   => 'Add a Project Team',
            'success' => 'Project team added.',
            'failure' => 'Something went wrong with the project team.',
        ],
        'edit'        => [
            'title'   => 'Edit a Project Team',
            'success' => 'Project team updated.',
            'failure' => 'Something went wrong with the project team.',
        ],
        'delete'      => [
            'success' => 'Project Team deleted.',
            'failure' => 'The Project Team could not be deleted. Please try again.',
        ],
    ],

    // Activities
    'activities' => [
        'activities'      => 'Activities',
        'all'             => 'All',
        'project_update'  => 'Project updated',
        'topic'           => 'Topic',
        'watched_project' => 'Project watched',
        'add'             => [
            'title'   => 'No Activities.',
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
    'group' => [
        'group'       => 'Groups',
        'member'      => 'Member',
        'profile'     => 'Profile',
        'description' => 'Group Members will be able to add, modify &amp; edit projects and issues.',
        'add'         => [
            'title'   => 'Add a New Group Member',
            'success' => 'Group member added.',
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
        'title'                 => 'Issues',
        'all'                   => 'All',
        'issues'                => 'Issues',
        'logged'                => '{0} There are no issues, good work.|You have logged one issue.|You have reported <strong>:count</strong> issues.',
        'add'                   => [
            'title'   => 'Add an Issue',
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

    // Merge Requests
    'merge_requests' => [
        'merge_requests' => 'Merge Requests',
        'add'            => [
            'title'   => 'Add a New merge request.',
            'message' => 'There are no merge requests.',
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

    // Settings
    'settings' => [
        'settings'  => 'Settings',
        'general'   => [
            'general'     => 'General',
            'images-only' => 'Only images may be uploaded.',
            'too-big'     => 'The file you uploaded is too big. Upload an image smaller than :size',
        ],
        'localization' => [
            'localization' => 'Localization',
        ],
        'timezone' => [
            'timezone' => 'Timezone',
        ],
        'stylesheet' => [
            'stylesheet' => 'Stylesheet',
        ],
        'theme' => [
            'theme' => 'Theme',
        ],
        'edit' => [
            'success' => 'Settings saved.',
            'failure' => 'Settings could not be saved.',
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
