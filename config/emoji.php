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

    /*
    |--------------------------------------------------------------------------
    | GitHub Token
    |--------------------------------------------------------------------------
    |
    | Here you may get us to use your personal github access token to increase
    | your rate limit while contacting GitHub's API.
    |
    */

    'token' => env('GITHUB_TOKEN', null),

];
