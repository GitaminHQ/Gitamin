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

use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    public function index()
    {
        $builder = new CaptchaBuilder();
        $builder->build($width = 100, $height = 34, $font = null);

        Session::put('phrase', $builder->getPhrase());

        header('Cache-Control: no-cache, must-revalidate');
        header('Content-Type: image/jpeg');
        $builder->output();
    }
}
