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

    // Install form fields
    'install' => [
        'email' => 'Email',
        'username' => 'Username',
        'password' => 'Password',
        'site_name' => 'Site Name',
        'site_domain' => 'Site Domain',
        'git_client_path' => 'Git Client Path',
        'git_repositories_path' => 'Git Repositories Path',
        'site_timezone' => 'Select your timezone',
        'site_locale' => 'Select your language',
        'enable_google2fa' => 'Enable Google Two Factor Authentication',
        'cache_driver' => 'Cache Driver',
        'session_driver' => 'Session Driver',
    ],

    // Logout
    'logout' => [
        'success' => 'Logged out successfully.',
    ],

    // Issues form fields
    'issues' => [
        'title' => 'Title',
        'status' => 'Status',
        'project' => 'Project',
        'description' => 'Description',
        'description-help' => 'You may also use Markdown.',
        'scheduled_at' => 'When to schedule the maintenance for?',
        'issue_time' => 'When did this issue occur?',
        'notify_subscribers' => 'Notify Subscribers?',
        'visibility' => 'Issue Visibility',
        'public' => 'Viewable by public',
        'logged_in_only' => 'Only visible to logged in users',
        'assign_to' => 'Assign to',
        'assign_to_me' => 'Assign to me',
    ],

    // Comments form fields.
    'comments' => [
        'message' => 'Message',
    ],

    // Projects form fields
    'projects' => [
        'name' => 'Name',
        'visibility_level' => 'Visibility Level',
        'team' => 'Team',
        'description' => 'Description',
        'path' => 'Project path',
        'owner' => 'Owner',
        'import' => 'Import project from',
        'tags' => 'Tags',
        'tags-help' => 'Comma separated.',
        'enabled' => 'Project enabled?',
    ],

    'groups' => [
        'name' => 'Group name',
        'path' => 'Group path',
        'description' => 'Details',
        'avatar' => 'Group avatar',
        'add' => 'Create Group',
    ],

    // Settings
    'settings' => [
        /// General
        'general' => [
            'site-name' => 'Site Name',
            'site-url' => 'Site URL',
            'git-client-path' => 'Git Client Path',
            'git-repositories-path' => 'Repositories Path',
            'display-graphs' => 'Display graphs on home page?',
            'about-app' => 'About this application',
            'days-of-issues' => 'issues show days',
            'banner' => 'Banner Image',
            'banner-help' => "It's recommended that you upload files no bigger than 930px wide .",
            'subscribers' => 'Allow people to signup to email notifications?',
        ],
        'localization' => [
            'select-language' => 'Select Language',
            'site-locale' => 'Site Language',
        ],
        'timezone' => [
            'site-timezone' => 'Site Timezone',
            'date-format' => 'Date Format',
            'issue-date-format' => 'Time Format',
        ],
        'stylesheet' => [
            'custom-css' => 'Custom Stylesheet',
        ],
        'theme' => [
            'background-color' => 'Background Color',
            'background-fills' => 'Background Fills (Projects, Issues, Footer)',
            'banner-background-color' => 'Banner Background Color',
            'banner-padding' => 'Banner Padding',
            'fullwidth-banner' => 'Enable fullwidth banner?',
            'text-color' => 'Text Color',
            'dashboard-login' => 'Show dashboard button in the footer?',
            'reds' => 'Red (Used for errors)',
            'blues' => 'Blue (Used for information)',
            'greens' => 'Green (Used for success)',
            'yellows' => 'Yellow (Used for alerts)',
            'oranges' => 'Orange (Used for notices)',
            'links' => 'Links',
        ],
    ],

    'user' => [
        'username' => 'Username',
        'email' => 'Email',
        'password' => 'Password',
        'api-token' => 'API Token',
        'api-token-help' => 'Regenerating your API token will prevent existing applications from accessing Gitamin.',
        'gravatar' => 'Change your profile picture at Gravatar.',
        'user_level' => 'User Level',
        'levels' => [
            'admin' => 'Admin',
            'user' => 'User',
        ],
        'group' => [
            'description' => 'Invite your group members by entering their email addresses here.',
            'email' => 'Email #:id',
        ],
    ],

    // Buttons
    'add' => 'Add',
    'save' => 'Save',
    'update' => 'Update',
    'create' => 'Create',
    'edit' => 'Edit',
    'delete' => 'Delete',
    'submit' => 'Submit',
    'cancel' => 'Cancel',
    'remove' => 'Remove',
    'invite' => 'Invite',
    'signin' => 'Sign In',
    'signup' => 'Sign Up',

    // Other
    'optional' => '* Optional',
];
