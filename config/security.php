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
    | Evil attributes
    |--------------------------------------------------------------------------
    |
    | This defines the evil attributes and they will be always be removed from
    | the input.
    |
    */
    'evil' => ['(?<!\w)on\w*', 'style', 'xmlns', 'formaction', 'form', 'xlink:href', 'FSCommand', 'seekSegmentTime'],

];
