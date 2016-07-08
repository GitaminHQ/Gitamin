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

use Carbon\Carbon;
use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class DateTime extends Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'TwigBridge_Extension_DateTime';
    }

    /**
     * @return Twig_SimpleFunction[]
     */
    public function getFunctions()
    {
        return [
            /*
             * Diff in months helper. We use it to calculate the age of the topic.
             */
            new Twig_SimpleFunction(
                'diff_in_months',
                function ($dateTime, $now = null) {
                    $dateTime = $this->toCarbon($dateTime);

                    if (!$now) {
                        $now = Carbon::now();
                    } else {
                        $now = $this->toCarbon($now);
                    }

                    return $now->diffInMonths($dateTime);
                }
            ),
        ];
    }

    /**
     * Dodatkowe filtry Twig zwiazane z formatowaniem danych uzytkownika.
     *
     * @return Twig_SimpleFilter[]
     */
    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('format_date', function ($dateTime, $diffForHumans = true) {
                if (!$dateTime) {
                    return;
                }

                $format = 'Y-m-d H:i:s';

                return $dateTime->format($format);
            }),

            new Twig_SimpleFilter('timestamp', function ($dateTime) {
                return $this->toCarbon($dateTime)->getTimestamp();
            }),

            new Twig_SimpleFilter('iso_8601', function ($dateTime) {
                return $this->toCarbon($dateTime)->format(Carbon::ISO8601);
            }),
        ];
    }

    private function toCarbon($dateTime)
    {
        if (!$dateTime instanceof Carbon) {
            $dateTime = new Carbon($dateTime);
        }

        return $dateTime;
    }
}
