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

use Gitamin\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Visibility scope.
 *
 * This is an Eloquent scope that can (globally) restrict access to a model.
 *
 * Assumptions:
 *
 * - The model has a `visibility_level` column of an integer type.
 * - The model has a `user_id`(creator_id) column that refers to a user model.
 */
final class VisibilityScope implements ScopeInterface
{
    // The item is visible to anyone
    const VISIBILITY_PUBLIC = 0;
    // The item is only visible to its owner
    const VISIBILITY_PRIVATE = 1;
    // The item is only visible to its owner and other logged in users
    const VISIBILITY_LOGGED_IN = 2;

    private $tableName;

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
        $this->tableName = $model->getTable();

        if (Auth::check() && Auth::user()->isApproved()) {
            $this->applyLoggedInScope($builder, Auth::user());
        } else {
            $this->applyPublicScope($builder);
        }
    }

    /**
     * Apply public scope.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function applyPublicScope(Builder $query)
    {
        return $query->where('visibility_level', '=', self::VISIBILITY_PUBLIC);
    }

    /**
     * Apply logged in scope.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param \Gitamin\Models\User  $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function applyLoggedInScope(Builder $query, User $user)
    {
        $isPrivate = function ($query) use ($user) {
            $query->where('visibility_level', '=', self::VISIBILITY_PRIVATE)
                  ->where("{$this->tableName}.creator_id", '=', $user->id);
        };

        $whereVisible = function ($query) use ($isPrivate) {
            $query->whereIn('visibility_level', [self::VISIBILITY_PUBLIC, self::VISIBILITY_LOGGED_IN])
                  ->orWhere($isPrivate);
        };

        return $query->where($whereVisible);
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
