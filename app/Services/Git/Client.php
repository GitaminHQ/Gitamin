<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Services\Git;

use Gitter\Client as BaseClient;

class Client extends BaseClient
{
    protected $defaultBranch;
    protected $hidden;
    protected $projects;

    public function __construct($options = null)
    {
        parent::__construct($options['path']);
        $this->setDefaultBranch($options['default_branch']);
        $this->setHidden($options['hidden']);
        $this->setProjects($options['projects']);
    }

    /**
     * Set default branch as a string.
     *
     * @param string $branch Name of branch to use when repo's HEAD is detached.
     *
     * @return object
     */
    protected function setDefaultBranch($branch)
    {
        $this->defaultBranch = $branch;

        return $this;
    }

    /**
     * Return name of default branch as a string.
     */
    public function getDefaultBranch()
    {
        return $this->defaultBranch;
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

    /**
     * Set the hidden repository list.
     *
     * @param array $hidden List of repositories to hide
     *
     * @return object
     */
    protected function setHidden($hidden)
    {
        $this->hidden = $hidden;

        return $this;
    }

    /**
     * Get project list.
     *
     * @return array List of repositories to show
     */
    protected function getProjects()
    {
        return $this->projects;
    }

    /**
     * Set the shown repository list.
     *
     * @param array $projects List of repositories to show
     */
    protected function setProjects($projects)
    {
        $this->projects = $projects;

        return $this;
    }

    /**
     * Overloads the parent::createRepository method for the correct Repository class instance.
     *
     * {@inheritdoc}
     */
    public function createRepository($path, $bare = null)
    {
        if (file_exists($path.'/.git/HEAD') && !file_exists($path.'/HEAD')) {
            throw new \RuntimeException('A GIT repository already exists at '.$path);
        }

        $repository = new Repository($path, $this);

        return $repository->create($bare);
    }

    /**
     * Overloads the parent::getRepository method for the correct Repository class instance.
     *
     * {@inheritdoc}
     */
    public function getRepository($path)
    {
        if (!file_exists($path) || !file_exists($path.'/.git/HEAD') && !file_exists($path.'/HEAD')) {
            throw new \RuntimeException('There is no GIT repository at '.$path);
        }

        return new Repository($path, $this);
    }
}
