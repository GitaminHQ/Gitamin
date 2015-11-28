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
use Gitamin\Models\ProjectTeam;
use Gitamin\Models\Issue;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Roumen\Feed\Facades\Feed;

class RssController extends Controller
{
    /**
     * Generates an Atom feed of all issues.
     *
     * @param \Gitamin\Models\ProjectTeam|null $group
     *
     * @return \Illuminate\Http\Response
     */
    public function feedAction(ProjectTeam $group = null)
    {
        $feed = Feed::make();
        $feed->title = Setting::get('app_name');
        $feed->lang = Setting::get('app_locale');
        $feed->description = trans('gitamin.feed');
        $feed->link = Str::canonicalize(Setting::get('app_domain'));

        $feed->setDateFormat('datetime');

        if ($group->exists) {
            $group->projects->map(function ($project) use ($feed) {
                $project->issues()->visible()->orderBy('created_at', 'desc')->get()->map(function ($issue) use ($feed) {
                    $this->feedAddItem($feed, $issue);
                });
            });
        } else {
            Issue::visible()->orderBy('created_at', 'desc')->get()->map(function ($issue) use ($feed) {
                $this->feedAddItem($feed, $issue);
            });
        }

        return $feed->render('rss');
    }

    /**
     * Adds an item to the feed.
     *
     * @param \Roumen\Feed\Facades\Feed        $feed
     * @param \Gitamin\Models\Issue $issue
     */
    private function feedAddItem(&$feed, $issue)
    {
        $feed->add(
            $issue->name,
            Setting::get('app_name'),
            Str::canonicalize(route('issue', ['id' => $issue->id])),
            $issue->created_at->toRssString(),
            $issue->message
        );
    }
}
