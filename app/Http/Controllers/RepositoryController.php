<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers;

use Gitamin\Facades\Setting;
use Gitamin\Models\Project;
use Gitter\Client;
use Illuminate\Support\Facades\View;

class RepositoryController extends Controller
{
    protected $client;
    protected $hidden;

    public function __construct()
    {
        $this->hidden = [];
        $this->client = new Client(Setting::get('git_client_path'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project = null)
    {
        //
        var_dump($project);
    }

    public function showRepo($team, $project)
    {
        return $this->showTree($team.'/'.$project, '');
    }

    public function showTree($repo, $path)
    {
        $repository = $this->getRepositoryFromName([Setting::get('git_repositories_path')], $repo);

        if (!$path) {
            $path = $repository->getHead();
        }

        if (strpos($path, '/') !== false) {
            $branch = strstr($path, '/', true);
            $tree = str_replace($branch.'/', '', $path);
        } else {
            $branch = $path;
            $tree = '';
        }

        $parent = null;
        if (($slash = strrpos($tree, '/')) !== false) {
            $parent = substr($tree, 0, $slash);
        } elseif (!empty($tree)) {
            $parent = '';
        }

        $files = $repository->getTree($tree ? "$branch:\"$tree\"/" : $branch);

        $pageTitle = sprintf('"%s" - %s - %s', 'project title', trans('dashboard.projects.edit.title'), trans('dashboard.dashboard'));

        return View::make('dashboard.repositories.tree')
            ->withPageTitle($pageTitle)
            ->withRepository($repository)
            ->withRepo($repo)
            ->withCurrentBranch($branch)
            ->withBranches($repository->getBranches())
            ->withPath($tree ? $tree.'/' : $tree)
            ->withParentPath($parent)
            ->withFiles($files->output());
    }

    public function showBlob($repo, $path)
    {
        $pageTitle = sprintf('"%s" - %s - %s', 'project title', trans('dashboard.projects.edit.title'), trans('dashboard.dashboard'));

        return View::make('dashboard.repositories.blob')
            ->withPageTitle($pageTitle)
            ->withProject([])
            ->withGroups([]);
    }

    public function showCommits($repo, $path)
    {
        $pageTitle = sprintf('"%s" - %s - %s', 'project title', trans('dashboard.projects.edit.title'), trans('dashboard.dashboard'));

        return View::make('dashboard.repositories.commits')
            ->withPageTitle($pageTitle)
            ->withProject([])
            ->withGroups([]);
    }

    public function showRaw($repo, $path)
    {
        $pageTitle = sprintf('"%s" - %s - %s', 'project title', trans('dashboard.projects.edit.title'), trans('dashboard.dashboard'));

        return View::make('dashboard.repositories.raw')
            ->withPageTitle($pageTitle)
            ->withProject([])
            ->withGroups([]);
    }

    public function showBlame($repo, $path)
    {
        $pageTitle = sprintf('"%s" - %s - %s', 'project title', trans('dashboard.projects.edit.title'), trans('dashboard.dashboard'));

        return View::make('dashboard.repositories.blame')
            ->withPageTitle($pageTitle)
            ->withProject([])
            ->withGroups([]);
    }

    public function getRepositoryFromName($paths, $repo)
    {
        $repositories = $this->getRepositories($paths);
        $path = $repositories[$repo]['path'];

        return $this->client->getRepository($path);
    }

    /**
     * Searches for valid repositories on the specified path.
     *
     * @param array $paths Array of paths where repositories will be searched
     *
     * @return array Found repositories, containing their name, path and description sorted
     *               by repository name
     */
    public function getRepositories($paths)
    {
        $allRepositories = [];

        foreach ($paths as $path) {
            $repositories = $this->recurseDirectory($path);

            if (empty($repositories)) {
                throw new \RuntimeException('There are no GIT repositories in '.$path);
            }

            $allRepositories = $allRepositories + $repositories;
        }

        $allRepositories = array_unique($allRepositories, SORT_REGULAR);
        uksort($allRepositories, function ($k1, $k2) {
            return strtolower($k2) < strtolower($k1);
        });

        return $allRepositories;
    }

    private function recurseDirectory($path, $topLevel = true)
    {
        $dir = new \DirectoryIterator($path);

        $repositories = [];

        foreach ($dir as $file) {
            if ($file->isDot()) {
                continue;
            }

            if (strrpos($file->getFilename(), '.') === 0) {
                continue;
            }

            if (!$file->isReadable()) {
                continue;
            }

            if ($file->isDir()) {
                $isBare = file_exists($file->getPathname().'/HEAD');
                $isRepository = file_exists($file->getPathname().'/.git/HEAD');

                if ($isRepository || $isBare) {
                    if (in_array($file->getPathname(), $this->getHidden())) {
                        continue;
                    }

                    if ($isBare) {
                        $description = $file->getPathname().'/description';
                    } else {
                        $description = $file->getPathname().'/.git/description';
                    }

                    if (file_exists($description)) {
                        $description = file_get_contents($description);
                    } else {
                        $description = null;
                    }

                    if (!$topLevel) {
                        $repoName = $file->getPathInfo()->getFilename().'/'.$file->getFilename();
                    } else {
                        $repoName = $file->getFilename();
                    }

                    $repositories[$repoName] = [
                        'name' => $repoName,
                        'path' => $file->getPathname(),
                        'description' => $description,
                    ];

                    continue;
                } else {
                    $repositories = array_merge($repositories, $this->recurseDirectory($file->getPathname(), false));
                }
            }
        }

        return $repositories;
    }

    /**
     * Get hidden repository list.
     *
     * @return array List of repositories to hide
     */
    protected function getHidden()
    {
        return $this->hidden;
    }
}
