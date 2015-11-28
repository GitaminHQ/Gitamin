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
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Jenssegers\Date\Date;

class ExploreController extends Controller
{
    /**
     * Displays the explore page.
     *
     * @return \Illuminate\View\View
     */
    public function showIndex()
    {
        $today = Date::now();
        $startDate = Date::now();

        // Check if we have another starting date
        if (Binput::has('start_date')) {
            try {
                // If date provided is valid
                $oldDate = Date::createFromFormat('Y-m-d', Binput::get('start_date'));

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

        $issueVisiblity = Auth::check() ? 0 : 1;

        $allIssues = Issue::where('visible', '>=', $issueVisiblity)->whereBetween('created_at', [
            $startDate->copy()->subDays($daysToShow)->format('Y-m-d').' 00:00:00',
            $startDate->format('Y-m-d').' 23:59:59',
        ])->orderBy('scheduled_at', 'desc')->orderBy('created_at', 'desc')->get()->groupBy(function (Issue $issue) use ($dateTimeZone) {
            // If it's scheduled, get the scheduled at date.
            if ($issue->is_scheduled) {
                return (new Date($issue->scheduled_at))
                    ->setTimezone($dateTimeZone)->toDateString();
            }

            return (new Date($issue->created_at))
                ->setTimezone($dateTimeZone)->toDateString();
        });

        // Add in days that have no issues
        foreach ($issueDays as $i) {
            $date = (new Date($startDate))->setTimezone($dateTimeZone)->subDays($i);

            if (!isset($allIssues[$date->toDateString()])) {
                $allIssues[$date->toDateString()] = [];
            }
        }

        // Sort the array so it takes into account the added days
        $allIssues = $allIssues->sortBy(function ($value, $key) {
            return strtotime($key);
        }, SORT_REGULAR, true)->all();

        return View::make('index')
            ->withDaysToShow($daysToShow)
            ->withAllIssues($allIssues)
            ->withCanPageForward((bool) $today->gt($startDate))
            ->withCanPageBackward(Issue::where('created_at', '<', $startDate->format('Y-m-d'))->count() > 0)
            ->withPreviousDate($startDate->copy()->subDays($daysToShow)->toDateString())
            ->withNextDate($startDate->copy()->addDays($daysToShow)->toDateString());
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
