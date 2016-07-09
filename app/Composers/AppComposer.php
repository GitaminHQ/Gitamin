<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Composers;

use Illuminate\Contracts\View\View;

class AppComposer
{
    public function compose(View $view)
    {
        $app = [
            'theme'    => 'default',
            'request' => [
                'basepath' => '',
            ],
        ];
        //$owner = 'Gitamin';
        //$view->withOwner($owner);
        $view->withApp($app);
        $view->withGitaminVersion(GITAMIN_VERSION);
    }
}
