<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Exceptions\Transformers;

use Exception;
use Gitamin\Exceptions\ExceptionInterface;
use GrahamCampbell\Exceptions\Transformers\TransformerInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ModelNotFoundTransformer implements TransformerInterface
{
    /**
     * Transform the provided exception.
     *
     * @param \Exception $exception
     *
     * @return \Exception
     */
    public function transform(Exception $exception)
    {
        if ($exception instanceof ExceptionInterface) {
            $exception = new BadRequestHttpException($exception->getMessage());
        } elseif ($exception instanceof ModelNotFoundException) {
            $exception = new NotFoundHttpException('Resource not found');
        }

        return $exception;
    }
}
