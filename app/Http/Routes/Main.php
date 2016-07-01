<?php

/*
 * This file is part of Gitamin.
 *
 * (c) Gitamin.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

/**
 * This is the status page routes class.
 */
class Main
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
        $router->group(['middleware' => ['web']], function (Registrar $router) {
            $router->get('/', [
                'as'   => 'home',
                'uses' => 'HomeController@index',
            ]);

            $router->get('/', [
                'as'   => 'homepage',
                'uses' => 'HomeController@index',
            ]);

            $router->get('/refresh',[
                'as'   => 'refresh',
                'uses'  => 'HomeController@refresh',
            ]);

            $router->get('/{owner}/{project}/{branch}/rss', [
                'as' => 'rss',
                'uses' => 'HomeController@rss',
            ]);

            $router->get('{owner}/{project}/commits/{commitishPath}', [
                'as' => 'commits',
                'uses' => 'CommitController@index',
            ]);

            $router->get('{owner}/{project}/commit/{commit}', [
                'as'   => 'commit',
                'uses' => 'CommitController@show',
            ]);

            $router->get('{owner}/{project}/stats/{branch}', [
                'as' => 'stats',
                'uses' => 'HomeController@stats',
            ]);

            $router->get('{owner}/{project}/network/{commitishPath}', [
                'as' => 'network',
                'uses' => 'NetworkController@index',
            ]);

            $router->get('{owner}/{project}/network_data/{commitishPath}/{page}', [
                'as' => 'networkData',
                'uses' => 'NetworkController@data',
            ]);

            $router->get('{owner}/{project}/treegraph/{commitishPath}', [
                'as' => 'treegraph',
                'uses' => 'TreeGraphController@index',
            ]);

            $router->get('{owner}/{project}/{format}ball/{branch}', [
                'as' => 'archive',
                'uses' => 'TreeController@archive',
            ]);

            $router->get('{owner}/{project}/blob/{commitishPath}', [
                'as' => 'blob',
                'uses' => 'BlobController@index',
            ]);

            $router->get('{owner}/{project}/raw/{commitishPath}', [
                'as' => 'blob_raw',
                'uses' => 'BlobController@raw',
            ]);

            $router->get('{owner}/{project}/blame/{commitishPath}', [
                'as' => 'blame',
                'uses' => 'CommitController@blame',
            ]);

            $router->get('{owner}/{project}/tree/{commitishPath}/', [
                'as' => 'tree',
                'uses' => 'TreeController@tree',
            ]);

            $router->get('/{owner}/{project}', [
                'as' => 'repository',
                'uses'  => 'TreeController@index',
            ]);

            $router->any('{owner}/{project}/tree/{branch}/search', [
                'as' => 'search',
                'uses' => 'TreeController@search',
            ]);

            $router->get('{owner}/{project}/{branch}', [
                'as'   => 'branch',
                'uses' => 'TreeController@tree',
            ]);

        });
    }
}