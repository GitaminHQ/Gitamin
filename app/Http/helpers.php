<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Jenssegers\Date\Date;

if (! function_exists('back_url')) {
    /**
     * Create a new back url.
     *
     * @param string|null  $route
     * @param array  $parameters
     * @param int  $status
     * @param array  $headers
     *
     * @return string
     */
    function back_url($route = null, $parameters = [], $status = 302, $headers = [])
    {
        $url = app('url');

        if ($route !== null && $url->previous() === $url->full()) {
            return $url->route($route, $parameters, $status, $headers);
        }

        return $url->previous();
    }
}

if (! function_exists('bread_crumbs')) {

    /**
     * Create brandcrumb array.
     *
     * @param string|null  $spec
     *
     * @return []string
     */
    function bread_crumbs($spec)
    {
        if (! $spec) {
            return [];
        }

        $paths = explode('/', $spec);

        foreach ($paths as $i => $path) {
            $breadcrumbs[] = [
                'dir' => $path,
                'path' => implode('/', array_slice($paths, 0, $i + 1)),
            ];
        }

        return $breadcrumbs;
    }
}

if (! function_exists('set_active')) {
    /**
     * Set active class if request is in path.
     *
     * @param string  $path
     * @param array  $classes
     * @param string  $active
     *
     * @return string
     */
    function set_active($path, array $classes = [], $active = 'active')
    {
        if (Request::is($path)) {
            $classes[] = $active;
        }

        $class = e(implode(' ', $classes));

        return empty($classes) ? '' : "class=\"{$class}\"";
    }
}

if (! function_exists('formated_filesize')) {
    /**
     * Formats a filesize to a human readable string.
     *
     * @param int  $filesize
     *
     * @return string
     */
    function formated_filesize($filesize)
    {
        $size = $filesize / 1024;
        if ($size < 1024) {
            $size = number_format($size, 2);
            $size .= 'KB';
        } else {
            if ($size / 1024 < 1024) {
                $size = number_format($size / 1024, 2);
                $size .= 'MB';
            } elseif ($size / 1024 / 1024 < 1024) {
                $size = number_format($size / 1024 / 1024, 2);
                $size .= 'GB';
            }
        }

        return $size;
    }
}

if (! function_exists('formatted_date')) {
    /**
     * Formats a date with the user timezone and the selected format.
     *
     * @param string  $date
     *
     * @return \Jenssegers\Date\Date
     */
    function formatted_date($date)
    {
        $dateFormat = Config::get('setting.date_format', 'jS F Y');

        return (new Date($date))->format($dateFormat);
    }
}

if (! function_exists('subscribers_enabled')) {
    /**
     * Is the subscriber functionality enabled and configured.
     *
     * @return bool
     */
    function subscribers_enabled()
    {
        $isEnabled = Config::get('setting.enable_subscribers', false);
        $mailAddress = Config::get('mail.from.address', false);
        $mailFrom = Config::get('mail.from.name', false);

        return $isEnabled && $mailAddress && $mailFrom;
    }
}

if (! function_exists('color_darken')) {
    /**
     * Darken a color.
     *
     * @param string  $hex
     * @param int  $percent
     *
     * @return string
     */
    function color_darken($hex, $percent)
    {
        $hex = preg_replace('/[^0-9a-f]/i', '', $hex);
        $new_hex = '#';

        if (strlen($hex) < 6) {
            $hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
        }

        for ($i = 0; $i < 3; ++$i) {
            $dec = hexdec(substr($hex, $i * 2, 2));
            $dec = min(max(0, $dec + $dec * $percent), 255);
            $new_hex .= str_pad(dechex($dec), 2, 0, STR_PAD_LEFT);
        }

        return $new_hex;
    }
}

if (! function_exists('color_contrast')) {
    /**
     * Calculates colour contrast.
     *
     * https://24ways.org/2010/calculating-color-contrast/
     *
     * @param string  $hexcolor
     *
     * @return string
     */
    function color_contrast($hexcolor)
    {
        $r = hexdec(substr($hexcolor, 0, 2));
        $g = hexdec(substr($hexcolor, 2, 2));
        $b = hexdec(substr($hexcolor, 4, 2));
        $yiq = (($r * 100) + ($g * 400) + ($b * 114)) / 1000;

        return ($yiq >= 128) ? 'black' : 'white';
    }
}
