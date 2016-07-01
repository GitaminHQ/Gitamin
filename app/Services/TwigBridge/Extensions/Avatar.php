<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Services\TwigBridge\Extensions;

use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class Avatar extends Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'TwigBridge_Extension_Avatar';
    }

    /**
     * Dodatkowe filtry Twig zwiazane z formatowaniem danych uzytkownika.
     *
     * @return Twig_SimpleFilter[]
     */
    public function getFunctions()
    {
        return [

            new Twig_SimpleFunction(
                'avatar', function ($email, $size) {
                    return $this->getUserAvatar($email, $size);
                }
            ),
        ];
    }

    protected function getUserAvatar($email, $size)
    {
        $url = '//gravatar.com/avatar/';
        $query = ["s=$size"];
        $id = md5(strtolower($email));

        return $url.$id.'?'.implode('&', $query);
    }
}
