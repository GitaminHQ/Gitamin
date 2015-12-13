<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Exceptions\Filters;

use Exception;
use Illuminate\Http\Request;

class ApiFilter
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new api filter instance.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Filter and return the displayers.
     *
     * @param \GrahamCampbell\Exceptions\Displayers\DisplayerInterface[] $displayers
     * @param \Exception                                                 $original
     * @param \Exception                                                 $transformed
     * @param int                                                        $code
     *
     * @return \GrahamCampbell\Exceptions\Displayers\DisplayerInterface[]
     */
    public function filter(array $displayers, Exception $original, Exception $transformed, $code)
    {
        if ($this->request->is('api*')) {
            foreach ($displayers as $index => $displayer) {
                if (!str_contains($displayer->contentType(), 'application/')) {
                    unset($displayers[$index]);
                }
            }
        }

        return array_values($displayers);
    }
}
