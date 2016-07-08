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
 * This is the projects routes class.
 */
class Projects
{
    /**
     * Define the status page routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    public function map(Registrar $router)
    {
        $router->group(['middleware' => ['web'], 'namespace' => 'Projects'], function (Registrar $router) {
            $router->get('{owner}/{project}/issues', [
                'as'   => 'issues',
                'uses' => 'IssueController@index',
            ]);

            $router->get('{owner}/{project}/issues/new', [
                'as'   => 'issue_new',
                'uses' => 'IssueController@create',
            ]);

            $router->post('{owner}/{project}/issues', [
                'as'   => 'issue_store',
                'uses' => 'IssueController@store',
            ]);

            $router->get('{owner}/{project}/issues/{issue}', [
                'as'   => 'issue_show',
                'uses' => 'IssueController@show',
            ]);

            $router->get('/{owner}/{project}/{branch}/rss', [
                'as'   => 'rss',
                'uses' => 'RssController@show',
            ]);

            $router->get('{owner}/{project}/merge_requests', [
                'as'   => 'merge_requests',
                'uses' => 'MergeRequestController@index',
            ]);

            $router->get('{owner}/{project}/commits/{commitishPath}', [
                'as'   => 'commits',
                'uses' => 'CommitController@index',
            ]);

            $router->get('{owner}/{project}/commit/{commit}', [
                'as'   => 'commit',
                'uses' => 'CommitController@show',
            ]);

            $router->get('{owner}/{project}/stats/{branch}', [
                'as'   => 'stats',
                'uses' => 'StatsController@show',
            ]);

            $router->get('{owner}/{project}/network/{commitishPath}', [
                'as'   => 'network',
                'uses' => 'NetworkController@index',
            ]);

            $router->get('{owner}/{project}/network_data/{commitishPath}/{page}', [
                'as'   => 'networkData',
                'uses' => 'NetworkController@data',
            ]);

            $router->get('{owner}/{project}/treegraph/{commitishPath}', [
                'as'   => 'treegraph',
                'uses' => 'TreeGraphController@index',
            ]);

            $router->get('{owner}/{project}/{format}ball/{branch}', [
                'as'   => 'archive',
                'uses' => 'TreeController@archive',
            ]);

            $router->get('{owner}/{project}/blob/{commitishPath}', [
                'as'   => 'blob',
                'uses' => 'BlobController@index',
            ]);

            $router->get('{owner}/{project}/raw/{commitishPath}', [
                'as'   => 'blob_raw',
                'uses' => 'BlobController@raw',
            ]);

            $router->get('{owner}/{project}/blame/{commitishPath}', [
                'as'   => 'blame',
                'uses' => 'BlameController@show',
            ]);

            $router->get('{owner}/{project}/tree/{commitishPath}/', [
                'as'   => 'tree',
                'uses' => 'TreeController@tree',
            ]);

            $router->get('/{owner}/{project}', [
                'as'    => 'repository',
                'uses'  => 'TreeController@index',
            ]);

            $router->get('/{owner}', [
                'as'    => 'owner',
                'uses'  => 'OwnerController@index',
            ]);

            $router->any('{owner}/{project}/tree/{branch}/search', [
                'as'   => 'search',
                'uses' => 'TreeController@search',
            ]);

            $router->get('{owner}/{project}/{branch}', [
                'as'   => 'branch',
                'uses' => 'TreeController@tree',
            ]);
        });
    }
}
