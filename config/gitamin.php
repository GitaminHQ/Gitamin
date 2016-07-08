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

    'client' => env('GITAMIN_GIT_CLIENT', '"C:\Program Files (x86)\Git\bin\git.exe"'),

    'repositories_path' => env('GITAMIN_REPOSITORIES_PATH', 'D:\Code'),

    'default_branch' => 'master',

    'cache_archives' => '/tmp',

];
