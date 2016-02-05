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

use Gitamin\Models\Issue;
use Gitamin\Models\Owner;
use GitaminHQ\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Roumen\Feed\Facades\Feed;

class FeedController extends Controller
{
    /**
     * Feed facade.
     *
     * @var \Roumen\Feed\Facades\Feed
     */
    protected $feed;

    /**
     * Create a new feed controller instance.
     */
    public function __construct()
    {
        $this->feed = Feed::make();
        $this->feed->title = Config::get('setting.app_name');
        $this->feed->description = trans('gitamin.feed');
        $this->feed->link = Str::canonicalize(Config::get('setting.app_domain'));
        $this->feed->setDateFormat('datetime');
    }

    /**
     * Generates an Atom feed of all issues.
     *
     * @param \Gitamin\Models\Owner|null $owner
     *
     * @return \Illuminate\Http\Response
     */
    public function atomAction(Owner $owner = null)
    {
        return $this->feedAction($owner, false);
    }

    /**
     * Generates a Rss feed of all issues.
     *
     * @param \Gitamin\Models\Owner|null $owner
     *
     * @return \Illuminate\Http\Response
     */
    public function rssAction(Owner $owner = null)
    {
        $this->feed->lang = Config::get('setting.app_locale');

        return $this->feedAction($owner, true);
    }

    /**
     * Generates a feed of all issues.
     *
     * @param \Gitamin\Models\Owner|null $owner
     * @param bool                       $isRss
     *
     * @return \Illuminate\Http\Response
     */
    protected function feedAction(Owner &$owner, $isRss)
    {
        if ($owner->exists) {
            $owner->projects->map(function ($project) {
                $project->issues()->visible()->orderBy('created_at', 'desc')->get()->map(function ($issue) use ($isRss) {
                    $this->feedAddItem($issue, $isRss);
                });
            });
        } else {
            Issue::visible()->orderBy('created_at', 'desc')->get()->map(function ($issue) use ($isRss) {
                $this->feedAddItem($issue, $isRss);
            });
        }

        return $this->feed->render($isRss ? 'rss' : 'atom');
    }

    /**
     * Adds an item to the feed.
     *
     * @param \Gitamin\Models\Issue $issue
     * @param bool                  $isRss
     */
    protected function feedAddItem($issue, $isRss)
    {
        // Project visibility_level
        if (! $issue->project) {
            return;
        }

        $this->feed->add(
            $issue->title,
            Config::get('setting.app_name'),
            $issue->url,
            $isRss ? $issue->created_at->toRssString() : $issue->created_at->toAtomString(),
            $isRss ? $issue->description : Markdown::convertToHtml($issue->description)
        );
    }
}
