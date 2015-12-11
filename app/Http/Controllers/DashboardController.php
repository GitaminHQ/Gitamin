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

use Gitamin\Facades\Setting;
use Gitamin\Models\Issue;
use Gitamin\Models\Project;
use Gitamin\Models\Subscriber;
use Illuminate\Support\Facades\View;
use Jenssegers\Date\Date;

class DashboardController extends Controller
{
    /**
     * Start date.
     *
     * @var \Jenssegers\Date\Date
     */
    protected $startDate;

    /**
     * The timezone the system is running in.
     *
     * @var string
     */
    protected $timeZone;

    /**
     * Creates a new dashboard controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->startDate = new Date();
        $this->dateTimeZone = Setting::get('app_timezone');
    }

    /**
     * Shows the dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function indexAction()
    {
        $projects = Project::get();
        $issues = $this->getIssues();
        $subscribers = $this->getSubscribers();

        return View::make('dashboard.index')
            ->withPageTitle(trans('dashboard.dashboard'))
            ->withProjects($projects)
            ->withIssues($issues)
            ->withSubscribers($subscribers);
    }

    /**
     * Shows the notifications view.
     *
     * @return \Illuminate\View\View
     */
    public function showNotifications()
    {
        return View::make('dashboard.notifications.index')
            ->withPageTitle(trans('dashboard.notifications.notifications').' '.trans('dashboard.dashboard'));
    }

    /**
     * Fetches all of the issues over the last 30 days.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getIssues()
    {
        $allIssues = Issue::whereBetween('created_at', [
            $this->startDate->copy()->subDays(30)->format('Y-m-d').' 00:00:00',
            $this->startDate->format('Y-m-d').' 23:59:59',
        ])->orderBy('created_at', 'desc')->get()->groupBy(function (Issue $issue) {
            return (new Date($issue->created_at))
                ->setTimezone($this->dateTimeZone)->toDateString();
        });

        // Add in days that have no issues
        foreach (range(0, 30) as $i) {
            $date = (new Date($this->startDate))->setTimezone($this->dateTimeZone)->subDays($i);

            if (!isset($allIssues[$date->toDateString()])) {
                $allIssues[$date->toDateString()] = [];
            }
        }

        // Sort the array so it takes into account the added days
        $allIssues = $allIssues->sortBy(function ($value, $key) {
            return strtotime($key);
        }, SORT_REGULAR, false);

        return $allIssues;
    }

    /**
     * Fetches all of the subscribers over the last 30 days.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getSubscribers()
    {
        $allSubscribers = Subscriber::whereBetween('created_at', [
            $this->startDate->copy()->subDays(30)->format('Y-m-d').' 00:00:00',
            $this->startDate->format('Y-m-d').' 23:59:59',
        ])->orderBy('created_at', 'desc')->get()->groupBy(function (Subscriber $issue) {
            return (new Date($issue->created_at))
                ->setTimezone($this->dateTimeZone)->toDateString();
        });

        // Add in days that have no issues
        foreach (range(0, 30) as $i) {
            $date = (new Date($this->startDate))->setTimezone($this->dateTimeZone)->subDays($i);

            if (!isset($allSubscribers[$date->toDateString()])) {
                $allSubscribers[$date->toDateString()] = [];
            }
        }

        // Sort the array so it takes into account the added days
        $allSubscribers = $allSubscribers->sortBy(function ($value, $key) {
            return strtotime($key);
        }, SORT_REGULAR, false);

        return $allSubscribers;
    }
}
