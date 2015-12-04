<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

/**
 * This is the dashboard routes class.
 */
class DashboardRoutes
{
    /**
     * Define the dashboard routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        // Dashboard
        $router->group([
            'middleware' => ['app.hasSetting', 'auth'],
            'setting'    => 'app_name',
            'as'         => 'dashboard.',
        ], function ($router) {
            $router->get('dashboard', [
                'as'   => 'index',
                'uses' => 'DashboardController@showDashboard',
            ]);

            
        });

        $router->group([
            'middleware' => 'auth',
            'prefix'     => 'dashboard',
            'namespace'  => 'Dashboard',
            'as'         => 'dashboard.',
        ], function ($router) {
            
            // Projects
            $router->group([
                'as'     => 'projects.',
                'prefix' => 'projects',
            ], function ($router) {
                $router->get('/', [
                    'as'   => 'index',
                    'uses' => 'ProjectController@index',
                ]);
                $router->get('starred', [
                    'as'   => 'starred',
                    'uses' => 'ProjectController@starred',
                ]);
                $router->get('add', [
                    'as'   => 'add',
                    'uses' => 'ProjectController@showAddProject',
                ]);
                $router->post('add', 'ProjectController@createProjectAction');
                $router->get('{project}', [
                    'as'   => 'show',
                    'uses' => 'ProjectController@showProject',
                ]);
                $router->get('{project}/edit', [
                    'as'   => 'edit',
                    'uses' => 'ProjectController@showEditProject',
                ]);
                $router->delete('{project}/delete', 'ProjectController@deleteProjectAction');
                $router->post('{project}/edit', 'ProjectController@updateProjectAction');
            });

            //Teams
            $router->group([
                'as'     => 'groups.',
                'prefix' => 'groups',
            ], function ($router) {
                $router->get('/', [
                    'as'   => 'index',
                    'uses' => 'GroupsController@index',
                ]);

            });

            // Activity
            $router->group([
                'as'     => 'activity.',
                'prefix' => 'activity',
                ], function ($router) {
                   $router->get('/', [
                    'as'   => 'index',
                    'uses' => 'ActivityController@index',
                ]);
            });

            // Milestones
            $router->group([
                'as'     => 'milestones.',
                'prefix' => 'milestones',
                ], function ($router) {
                   $router->get('/', [
                    'as'   => 'index',
                    'uses' => 'MilestoneController@showMilestones',
                ]);
            });

            // Merge Requests
            $router->group([
                'as'     => 'merge_requests.',
                'prefix' => 'merge_requests',
                ], function ($router) {
                   $router->get('/', [
                    'as'   => 'index',
                    'uses' => 'MergeRequestController@showMergeRequests',
                ]);
            });

            // Snippets
            $router->group([
                'as'     => 'snippets.',
                'prefix' => 'snippets',
                ], function ($router) {
                   $router->get('/', [
                    'as'   => 'index',
                    'uses' => 'SnippetController@showSnippets',
                ]);
            });

            // Issues
            $router->group([
                'as'     => 'issues.',
                'prefix' => 'issues',
            ], function ($router) {
                $router->get('/', [
                    'as'   => 'index',
                    'uses' => 'IssueController@showIssues',
                ]);
                $router->get('add', [
                    'as'   => 'add',
                    'uses' => 'IssueController@showAddIssue',
                ]);
                $router->post('add', 'IssueController@createIssueAction');
                $router->delete('{issue}/delete', [
                    'as'   => 'delete',
                    'uses' => 'IssueController@deleteIssueAction',
                ]);
                $router->get('{issue}/edit', [
                    'as'   => 'edit',
                    'uses' => 'IssueController@showEditIssueAction',
                ]);
                $router->post('{issue}/edit', 'IssueController@editIssueAction');
            });

            // Subscribers
            $router->group([
                'as'     => 'subscribers.',
                'prefix' => 'subscribers',
            ], function ($router) {
                $router->get('/', [
                    'as'   => 'index',
                    'uses' => 'SubscriberController@showSubscribers',
                ]);
                $router->get('add', [
                    'as'   => 'add',
                    'uses' => 'SubscriberController@showAddSubscriber',
                ]);
                $router->post('add', 'SubscriberController@createSubscriberAction');
                $router->delete('{subscriber}/delete', 'SubscriberController@deleteSubscriberAction');
            });

            // Group Members
            $router->group([
                'as'     => 'group.',
                'prefix' => 'group',
            ], function ($router) {
                $router->get('/', [
                    'as'   => 'index',
                    'uses' => 'GroupController@showGroupView',
                ]);

                $router->group(['middleware' => 'admin'], function ($router) {
                    $router->get('add', [
                        'as'   => 'add',
                        'uses' => 'GroupController@showAddGroupMemberView',
                    ]);
                    $router->get('invite', [
                        'as'   => 'invite',
                        'uses' => 'GroupController@showInviteGroupMemberView',
                    ]);
                    $router->get('{user}', 'GroupController@showGroupMemberView');
                    $router->post('add', 'GroupController@postAddUser');
                    $router->post('invite', 'GroupController@postInviteUser');
                    $router->post('{user}', 'GroupController@postUpdateUser');
                    $router->delete('{user}/delete', 'GroupController@deleteUser');
                });
            });

            // Settings
            $router->group([
                'as'     => 'settings.',
                'prefix' => 'settings',
            ], function ($router) {
                $router->get('general', [
                    'as'   => 'general',
                    'uses' => 'SettingsController@showGeneralView',
                ]);
                $router->get('localization', [
                    'as'   => 'localization',
                    'uses' => 'SettingsController@showLocalizationView',
                ]);
                $router->get('timezone', [
                    'as'   => 'timezone',
                    'uses' => 'SettingsController@showTimezoneView',
                ]);
                $router->get('theme', [
                    'as'   => 'theme',
                    'uses' => 'SettingsController@showThemeView',
                ]);
                $router->get('stylesheet', [
                    'as'   => 'stylesheet',
                    'uses' => 'SettingsController@showStylesheetView',
                ]);
                $router->post('/', 'SettingsController@postSettings');
            });

            // User Settings
            $router->group(['prefix' => 'user'], function ($router) {
                $router->get('/', [
                    'as'   => 'user',
                    'uses' => 'UserController@showUser',
                ]);
                $router->post('/', 'UserController@postUser');
                $router->get('{user}/api/regen', 'UserController@regenerateApiKey');
            });

            /*
             * Internal API.
             * This should only be used for making requests within the dashboard.
             */
            $router->group(['prefix' => 'api'], function ($router) {
                $router->post('projects/teams/order', 'ApiController@postUpdateProjectTeamOrder');
                $router->post('projects/order', 'ApiController@postUpdateProjectOrder');
                $router->post('projects/{project}', 'ApiController@postUpdateProject');
            });
        });
    }
}
