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
use Gitamin\Models\ProjectNamespace;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Roumen\Feed\Facades\Feed;

class FeedController extends Controller
{
    /**
    * Feed facade.
    *
    * @var Roumen\Feed\Facades\Feed
    */
    private $feed;

    /**
    * Create a new feed controller instance.
    *
    * @return void
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
     * @param \Gitamin\Models\ProjectTeam|null $namespace
     *
     * @return \Illuminate\Http\Response
     */
    public function atomAction(ProjectNamespace $namespace = null)
    {
        return $this->feedAction($namespace, false);
    }

    /**
     * Generates a Rss feed of all issues.
     *
     * @param \Gitamin\Models\ProjectTeam|null $group
     *
     * @return \Illuminate\Http\Response
     */
    public function rssAction(ProjectNamespace $namespace = null)
    {
        $this->feed->lang = Setting::get('app_locale');

        return $this->feedAction($namespace, true);
    }

    /**
     * Generates a feed of all issues.
     *
     * @param \Gitamin\Models\ProjectTeam|null $namespace
     * @param bool                             $isRss
     *
     * @return \Illuminate\Http\Response
     */
    private function feedAction(ProjectNamespace &$namespace, $isRss)
    {
        if ($namespace->exists) {
            $namespace->projects->map(function ($project) {
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
     * @param \Gitamin\Models\Issue     $issue
     * @param bool                      $isRss
     */
    private function feedAddItem($issue, $isRss)
    {
        $this->feed->add(
            $issue->name,
            Setting::get('app_name'),
            Str::canonicalize(route('issue', ['id' => $issue->id])),
            $isRss ? $issue->created_at->toRssString() : $issue->created_at->toAtomString(),
            $isRss ? $issue->message : Markdown::convertToHtml($issue->message)
        );
    }
