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
use Gitamin\Models\ProjectTeam;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Roumen\Feed\Facades\Feed;

class FeedController extends Controller
{
    protected $feed;

    public function __construct()
    {
        $this->feed = Feed::make();
        $this->feed->title = Setting::get('app_name');
        $this->feed->description = trans('gitamin.feed');
        $this->feed->link = Str::canonicalize(Setting::get('app_domain'));
        $this->feed->setDateFormat('datetime');
    }
    /**
     * Generates a Rss feed of all issues.
     *
     * @param \Gitamin\Models\ProjectTeam|null $group
     *
     * @return \Illuminate\Http\Response
     */
    public function rssAction(ProjectTeam $group = null)
    {
        
        $this->feed->lang = Setting::get('app_locale');
        
        if ($group->exists) {
            $group->projects->map(function ($project) {
                $project->issues()->visible()->orderBy('created_at', 'desc')->get()->map(function ($issue) {
                    $this->feedAddItem($issue);
                });
            });
        } else {
            Issue::visible()->orderBy('created_at', 'desc')->get()->map(function ($issue) {
                $this->feedAddItem($issue);
            });
        }

        return $this->feed->render('rss');
    }
    
    /**
     * Generates an Atom feed of all issues.
     *
     * @param \Gitamin\Models\ProjectTeam|null $group
     *
     * @return \Illuminate\Http\Response
     */
    public function atomAction(ProjectTeam $group = null)
    {
        if ($group->exists) {
            $group->projects->map(function ($project) {
                $project->issues()->visible()->orderBy('created_at', 'desc')->get()->map(function ($issue) {
                    $this->feedAddItem($issue, false);
                });
            });
        } else {
            Issue::visible()->orderBy('created_at', 'desc')->get()->map(function ($issue) {
                $this->feedAddItem($issue, false);
            });
        }

        return $this->feed->render('atom');
    }

    /**
     * Adds an item to the feed.
     *
     * @param \Gitamin\Models\Issue     $issue
     * @param bool                      $isRss
     */
    private function feedAddItem($issue, $isRss = true)
    {
        $this->feed->add(
            $issue->name,
            Setting::get('app_name'),
            Str::canonicalize(route('issue', ['id' => $issue->id])),
            $isRss ? $issue->created_at->toRssString() : $issue->created_at->toAtomString(),
            $isRss ? $issue->message : Markdown::convertToHtml($issue->message)
        );
    }
}
