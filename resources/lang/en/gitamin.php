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
    // Projects
    'projects' => [
        'projects' => 'Projects',
        'project_statuses' => 'Project Statuses',
        'listed_team' => 'Teamed under :name',

        'all' => 'All',
        'yours' => 'Your Projects',
        'starred' => 'Starred Projects',
        'explore' => 'Explore Projects',

        'new' => [
            'title' => 'New Project',
            'message' => 'You should add a project.',
            'success' => 'Project created.',
            'failure' => 'Something went wrong with the project.',
        ],
        'edit' => [
            'title' => 'Edit a Project',
            'success' => 'Project updated.',
            'failure' => 'Something went wrong with the project.',
        ],
        'delete' => [
            'success' => 'Project deleted.',
            'failure' => 'The Project could not be deleted. Please try again.',
        ],
        'status' => [
            1 => 'Public',
            2 => 'Internal',
            3 => 'Private',
        ],
    ],

     // Project teams
    'groups' => [
        'groups' => 'Groups',
        'no_projects' => 'You should add a project group.',
        'yours' => 'Your Groups',
        'explore' => 'Explore Groups',
        'add' => [
            'title' => 'New Group',
            'success' => 'Project group added.',
            'failure' => 'Something went wrong with the project group.',
        ],
        'edit' => [
            'title' => 'Group settings',
            'success' => 'Project group updated.',
            'failure' => 'Something went wrong with the project group.',
        ],
        'delete' => [
            'success' => 'Project Group deleted.',
            'failure' => 'The Project Team could not be deleted. Please try again.',
        ],
    ],

    // Issues
    'issues' => [
        'none' => 'No Issues Reported.',
        'past' => 'Past Issues',
        'previous_week' => 'Previous Week',
        'next_week' => 'Next Week',
        'none' => 'Nothing to report.',
        'scheduled' => 'Scheduled Maintenance',
        'scheduled_at' => ', scheduled :timestamp',
        'status' => [
            0 => 'Scheduled', // TODO: Hopefully remove this.
            1 => 'Investigating',
            2 => 'Identified',
            3 => 'Watching',
            4 => 'Fixed',
        ],
    ],

    // Moments
    'moments' => [
        'created' => 'created',
        'updated' => 'updated',
        'closed' => 'closed',
        'commented' => 'commented on',
    ],

    'profiles' => [
        'profiles' => 'Profile',
        'account' => 'Account settings',
        'applications' => 'Applications',
        'emails' => 'Emails',
        'password' => 'Password',
        'notifications' => 'Notifications',
        'ssh_keys' => 'SSH Keys',
        'preferences' => 'Preferences',
        'audit_log' => 'Audit Log',
    ],

    // Service Status
    'service' => [
        'good' => 'All Projects Are Functional',
        'bad' => 'Some Projects Are Experiencing Issues',
    ],

    'api' => [
        'regenerate' => 'Regenerate API Key',
        'revoke' => 'Revoke API Key',
    ],

    // Subscriber
    'subscriber' => [
        'subscribe' => 'Subscribe to Get the Most Recent Updates',
        'button' => 'Subscribe',
        'email' => [
            'subscribe' => 'Subscribe to email updates.',
            'subscribed' => 'You\'ve been subscribed to email notifications, please check your email to confirm your subscription.',
            'verified' => 'Your email subscription has been confirmed. Thank you!',
            'unsubscribe' => 'Unsubscribe from email updates.',
            'unsubscribed' => 'Your email subscription has been cancelled.',
            'failure' => 'Something went wrong with the subscription.',
            'verify' => [
                'text' => "Please confirm your email subscription to :app_name status updates.\n:link\nThank you, :app_name",
                'html-preheader' => 'Please confirm your email subscription to :app_name status updates.',
                'html' => '<p>Please confirm your email subscription to :app_name status updates.</p><p><a href=":link">:link</a></p><p>Thank you, :app_name</p>',
            ],
            'maintenance' => [
                'text' => "New maintenance has been scheduled on :app_name.\nThank you, :app_name",
                'html-preheader' => 'New maintenance has been scheduled on :app_name.',
                'html' => '<p>New maintenance has been scheduled on :app_name.</p>',
            ],
            'issue' => [
                'text' => "New issue has been reported on :app_name.\nThank you, :app_name",
                'html-preheader' => 'New issue has been reported on :app_name.',
                'html' => '<p>New issue has been reported on :app_name.</p><p>Thank you, :app_name</p>',
            ],
        ],
    ],

    'users' => [
        'email' => [
            'invite' => [
                'text' => "You have been invited to the team :app_name, to sign up follow the next link.\n:link\nThank you, :app_name",
                'html-preheader' => 'You have been invited to the team :app_name.',
                'html' => '<p>You have been invited to the team :app_name, to sign up follow the next link.</p><p><a href=":link">:link</a></p><p>Thank you, :app_name</p>',
            ],
        ],
    ],

    // Signin fields
    'signin' => [
        'signin' => 'Existing user? Sign in',
        'title' => 'Sign in',
        'email' => 'Email',
        'password' => 'Password',
        '2fauth' => 'Authentication Code',
        'invalid' => 'Invalid email or password',
        'invalid-token' => 'Invalid token',
        'cookies' => 'You must enable cookies to sign in.',
        'success' => 'Signed in successfully.',
    ],

    'signup' => [
        'signup' => 'Dont\'t have user? Sign up',
        'title' => 'Sign Up',
        'username' => 'Username',
        'email' => 'Email',
        'password' => 'Password',
        'success' => 'Your account has been created.',
        'failure' => 'Something went wrong with the signup.',
        'taken' => 'Username or email has already been taken.',
    ],

    // Other
    'powered_by' => ':app is powered by <a href="https://gitamin.com" class="links">Gitamin</a>.',
    'about_this_site' => 'About This Site',
    'rss-feed' => 'RSS',
    'atom-feed' => 'Atom',
    'feed' => 'Project Feed',

];
