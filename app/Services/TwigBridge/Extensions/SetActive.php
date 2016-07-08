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

class SetActive extends Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'TwigBridge_Extension_SetActive';
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
                'set_active', function ($path, array $classes = [], $active = 'active') {
                    return set_active($path, $classes, $active);
                }
            ),
        ];
    }
}
