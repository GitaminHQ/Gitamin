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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class ProfilesController extends Controller
{
    /**
     * Array of sub-menu items.
     *
     * @var array
     */
    protected $subMenu = [];

    /**
     * Creates a new project controller instance.
     */
    public function __construct()
    {
        $this->subMenu = [
            'profiles' => [
                'title' => trans('gitamin.profiles.profiles'),
                'url' => route('profile.index'),
                'icon' => 'fa fa-user',
                'active' => false,
            ],
            'account' => [
                'title' => trans('gitamin.profiles.account'),
                'url' => route('profile.index'),
                'icon' => 'fa fa-gear',
                'active' => false,
            ],
            'emails' => [
                'title' => trans('gitamin.profiles.emails'),
                'url' => route('profile.index'),
                'icon' => 'fa fa-envelope-o',
                'active' => false,
            ],
            'password' => [
                'title' => trans('gitamin.profiles.password'),
                'url' => route('profile.index'),
                'icon' => 'fa fa-lock',
                'active' => false,
            ],
            'notifications' => [
                'title' => trans('gitamin.profiles.notifications'),
                'url' => route('profile.index'),
                'icon' => 'fa fa-inbox',
                'active' => false,
            ],
            'ssh_keys' => [
                'title' => trans('gitamin.profiles.ssh_keys'),
                'url' => route('profile.index'),
                'icon' => 'fa fa-key',
                'active' => false,
            ],
            'applications' => [
                'title' => trans('gitamin.profiles.applications'),
                'url' => route('profile.index'),
                'icon' => 'fa fa-cloud',
                'active' => false,
            ],
            'preferences' => [
                'title' => trans('gitamin.profiles.preferences'),
                'url' => route('profile.index'),
                'icon' => 'fa fa-image',
                'active' => false,
            ],
            'audit_log' => [
                'title' => trans('gitamin.profiles.audit_log'),
                'url' => route('profile.index'),
                'icon' => 'fa fa-history',
                'active' => false,
            ],
        ];

        View::share([
            'sub_menu' => $this->subMenu,
            'sub_title' => trans_choice('dashboard.projects.projects', 2),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction()
    {
        //
        $this->subMenu['profiles']['active'] = true;

        return View::make('profiles.index')
            ->withSubMenu($this->subMenu)
            ->withPageTitle(trans('gitamin.profiles.profiles').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAction()
    {
        // Do something
        $userData = Request::get('user');

        try {
            Auth::user()->update($userData);
        } catch (ValidationException $e) {
            return Redirect::route('profile.index')
                ->withInput($userData)
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('gitamin.profiles.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('profile.index')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('gitamin.profiles.edit.success')));
    }

    public function showAction()
    {
        return View::make('profiles.index')
            ->withSubMenu($this->subMenu)
            ->withPageTitle(trans('gitamin.profiles.profiles').' - '.trans('dashboard.dashboard'));
    }
}
