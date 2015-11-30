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
 * This is the repository routes class.
 */
class RepositoryRoutes
{
    /**
     * Define the repository routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group([
            'middleware' => ['app.hasSetting', 'auth'],
            'setting'    => 'app_name',
        ], function ($router) {
            $router->get('/', [
                'as'   => 'explore',
                'uses' => 'ExploreController@showIndex',
            ]);

            $router->get('issue/{issue}', [
                'as'   => 'issue',
                'uses' => 'ExploreController@showIssue',
            ]);

            $router->get('{team}', [
                'as'   => 'team',
                'uses' => 'Dashboard\\TeamController@showProjectTeam',
            ]);

             $router->get('{repo}/issues', [
                'as'   => 'repo_tree',
                'uses' => 'Dashboard\\IssueController@showIndex',
            ])->where('repo', '.*');

            $router->get('{projectTeam}/{repo}', [
                'as'   => 'repo_main',
                'uses' => 'RepositoryController@showRepo',
            ])->where('projectTeam', '[A-Za-z]+');

             $router->get('{repo}/tree/{path}/', [
                'as'   => 'repo_tree',
                'uses' => 'RepositoryController@showTree',
            ])->where('repo', '.*')->where('path', '.*');

            $router->get('{repo}/blob/{path}', [
                'as'   => 'repo_blob',
                'uses' => 'RepositoryController@showBlob',
            ])->where('repo', '.*')->where('path', '.*');

            $router->get('{repo}/commits/{path}', [
                'as'   => 'repo_commits',
                'uses' => 'RepositoryController@showCommits',
            ])->where('repo', '.*')->where('path', '.*');

            $router->get('{repo}/raw/{path}', [
                'as'   => 'repo_raw',
                'uses' => 'RepositoryController@showRaw',
            ])->where('repo', '.*')->where('path', '.*');

            $router->get('{repo}/blame/{path}', [
                'as'   => 'repo_blame',
                'uses' => 'RepositoryController@showBlame',
            ])->where('repo', '.*')->where('path', '.*');

        });
    }
}
