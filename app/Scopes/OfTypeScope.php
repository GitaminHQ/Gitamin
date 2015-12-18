<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Scopes;

use Gitamin\Models\Group;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;

/**
 * OffType scope.
 *
 * This is an Eloquent scope that can (globally) restrict access to a model.
 */
final class OfTypeScope implements ScopeInterface
{
    /**
     * Apply the scopes for model.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $builder
     * @param \Illuminate\Database\Eloquent\Model  $model
     *
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if ($model instanceof Group) {
            $this->applyGroupScope($builder);
        } else {
            // TODO: defaut fetch all now.
        }
    }

    /**
     * Apply Group-owner scope.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function applyGroupScope(Builder $query)
    {
        return $query->where('type', '=', 'Group');
    }

    /**
     * Apply User-owner scope.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function applyUserScope(Builder $query)
    {
        return $query->where('type', '=', 'User');
    }

    /**
     * Remove the scopes for model.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $builder
     * @param \Illuminate\Database\Eloquent\Model  $model
     *
     * @return void
     */
    public function remove(Builder $builder, Model $model)
    {
        // TODO: Implement me
    }
}
