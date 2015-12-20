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

use Gitamin\Models\Group;
use Gitamin\Models\Moment;
use Gitamin\Models\Owner;
use Gitamin\Models\Project;
use Gitamin\Models\User;
use Illuminate\Support\Facades\View;

class OwnersController extends Controller
{
    /**
     * Shows the owner view.
     *
     * @return \Illuminate\View\View
     */
    public function showAction($path)
    {
        $owner = Owner::findByPath($path);

        if ($owner->type == 'User') {
            $user = User::find($owner->user_id);

            return $this->showUser($user);
        } else {
            return $this->showGroup($owner);
        }
    }

    /**
     * Shows the group view.
     *
     * @return \Illuminate\View\View
     */
    protected function showGroup(Owner &$group)
    {
        $usedProjects = Project::where('owner_id', '=', $group->id)->lists('id')->toArray();
        $moments = Moment::whereIn('project_id', $usedProjects)->get();

        return View::make('groups.show')
            ->withPageTitle($group->name)
            ->withGroup($group)
            ->withMoments($moments);
    }

    /**
     * Shows the user profile view.
     *
     * @return \Illuminate\View\View
     */
    protected function showUser(User &$user)
    {
        $usedProjects = Project::where('owner_id', '=', $user->id)->lists('id')->toArray();
        $moments = Moment::whereIn('project_id', $usedProjects)->get();

        return View::make('profiles.show')
            ->withPageTitle($user->name)
            ->withUser($user)
            ->withMoments($moments);
    }
}
