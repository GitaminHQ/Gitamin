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
use Gitamin\Models\Owner;
use GrahamCampbell\Markdown\Facades\Markdown;
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
        $this->feed->title = Setting::get('app_name');
        $this->feed->description = trans('gitamin.feed');
        $this->feed->link = Str::canonicalize(Setting::get('app_domain'));
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
        $this->feed->lang = Setting::get('app_locale');

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
    private function feedAction(Owner &$owner, $isRss)
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
    private function feedAddItem($issue, $isRss)
    {
        $this->feed->add(
            $issue->name,
            Setting::get('app_name'),
            Str::canonicalize($issue->url),
            $isRss ? $issue->created_at->toRssString() : $issue->created_at->toAtomString(),
            $isRss ? $issue->message : Markdown::convertToHtml($issue->message)
        );
    }
}
