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
     | Uploader Directory
     |--------------------------------------------------------------------------
     |
     | Set the directory where your uploaded files will be placed.
     |
     */

    'dir' => 'uploads',

    /*
     |--------------------------------------------------------------------------
     | Uploader File Field
     |--------------------------------------------------------------------------
     |
     | Set the directory where your uploaded files will be placed.
     |
     */

    'file_field' => 'file',

    /*
     |--------------------------------------------------------------------------
     | Uploader Route
     |--------------------------------------------------------------------------
     |
     | Every AJAX call needs an URL for file upload process. Set the route and
     | make sure no another route defined.
     |
     */

    'route' => 'dashboard/api/upload/avatar',

    /*
     |--------------------------------------------------------------------------
     | Middleware
     |--------------------------------------------------------------------------
     |
     | If you want to restrict the upload call, set the middleware.
     |
     */

    'middleware' => 'auth',

    /*
     |--------------------------------------------------------------------------
     | Max File Size
     |--------------------------------------------------------------------------
     |
     | Make sure you give a limitation of file size uploaded (in KiloBytes).
     |
     */

    'max_size' => 10240,

    /*
     |--------------------------------------------------------------------------
     | Uploader MIME Types
     |--------------------------------------------------------------------------
     |
     | It's the flexibility of this package. You can define the type of upload
     | file methods. For example, you want to upload for profile picture,
     | article post, background, etc. Here is 
     |
     */

    'types' => [
        'default' => [
            'middleware' => 'auth',
            'format' => 'image|video',
            // 'image' => [
            //  'resize' => [1024, 768],
            //  'crop' => [800, 800],
            //  'fit' => [400, 400],
            //  'thumbs' => [
            //      'small' => [50, 50],
            //      'medium' => [100, 100],
            //  ]
            // ],
            'multiple' => false,
            'save_original' => false,
        ],
    ],

];
