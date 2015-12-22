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

use Exception;
use Gitamin\Facades\Setting;
use Gitamin\Models\Issue;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Jenssegers\Date\Date;

class ExploreController extends Controller
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
            'yours' => [
                'title' => trans('dashboard.projects.yours'),
                'url' => route('dashboard.projects.index'),
                'icon' => 'fa fa-edit',
                'active' => false,
            ],
            'starred' => [
                'title' => trans('dashboard.projects.starred'),
                'url' => route('dashboard.projects.starred'),
                'icon' => 'fa fa-umbrella',
                'active' => false,
            ],
            'explore' => [
                'title' => trans('dashboard.projects.explore'),
                'url' => route('explore.index'),
                'icon' => 'fa fa-eye',
                'active' => false,
            ],
        ];

        View::share([
            'sub_menu' => $this->subMenu,
            'sub_title' => trans_choice('dashboard.projects.projects', 2),
        ]);
    }

    /**
     * Displays the explore page.
     *
     * @return \Illuminate\View\View
     */
    public function indexAction()
    {
        $this->subMenu['explore']['active'] = true;

        $today = Date::now();
        $startDate = Date::now();

        // Check if we have another starting date
        if (Request::has('start_date')) {
            try {
                // If date provided is valid
                $oldDate = Date::createFromFormat('Y-m-d', Request::get('start_date'));

                // If trying to get a future date fallback to today
                if ($today->gt($oldDate)) {
                    $startDate = $oldDate;
                }
            } catch (Exception $e) {
                // Fallback to today
            }
        }

        $daysToShow = Setting::get('app_issue_days', 0) - 1;
        if ($daysToShow < 0) {
            $daysToShow = 0;
            $issueDays = [];
        } else {
            $issueDays = range(0, $daysToShow);
        }
        $dateTimeZone = Setting::get('app_timezone');

        $allIssues = Issue::whereBetween('created_at', [
            $startDate->copy()->subDays($daysToShow)->format('Y-m-d').' 00:00:00',
            $startDate->format('Y-m-d').' 23:59:59',
        ])->orderBy('created_at', 'desc')->get()->groupBy(function (Issue $issue) use ($dateTimeZone) {
            return (new Date($issue->created_at))
                ->setTimezone($dateTimeZone)->toDateString();
        });

        // Add in days that have no issues
        foreach ($issueDays as $i) {
            $date = (new Date($startDate))->setTimezone($dateTimeZone)->subDays($i);

            if (! isset($allIssues[$date->toDateString()])) {
                $allIssues[$date->toDateString()] = [];
            }
        }

        // Sort the array so it takes into account the added days
        $allIssues = $allIssues->sortBy(function ($value, $key) {
            return strtotime($key);
        }, SORT_REGULAR, true)->all();

        return View::make('explore.index')
            ->withPageTitle(trans('dashboard.explore'))
            ->withProjects([])
            ->withSubMenu($this->subMenu)
            ->withDaysToShow($daysToShow)
            ->withAllIssues($allIssues)
            ->withCanPageForward((bool) $today->gt($startDate))
            ->withCanPageBackward(Issue::where('created_at', '<', $startDate->format('Y-m-d'))->count() > 0)
            ->withPreviousDate($startDate->copy()->subDays($daysToShow)->toDateString())
            ->withNextDate($startDate->copy()->addDays($daysToShow)->toDateString());
    }

    public function groupsAction()
    {
        $this->subMenu = [
            'yours' => [
                'title' => trans('gitamin.groups.yours'),
                'url' => route('dashboard.groups.index'),
                'icon' => 'fa fa-edit',
                'active' => false,
            ],
            'explore' => [
                'title' => trans('gitamin.groups.explore'),
                'url' => route('explore.groups'),
                'icon' => 'fa fa-eye',
                'active' => false,
            ],
        ];

        $this->subMenu['explore']['active'] = true;

        return View::make('explore.groups')
            ->withPageTitle(trans('dashboard.explore'))
            ->withSubMenu($this->subMenu)
            ->withSubTitle(trans_choice('dashboard.groups.groups', 2))
            ->withProjects([]);
    }

    /**
     * Shows an issue in more detail.
     *
     * @param \Gitamin\Models\Issue $issue
     *
     * @return \Illuminate\View\View
     */
    public function showIssue(Issue $issue)
    {
        return View::make('issue')
            ->withIssue($issue);
    }
}
