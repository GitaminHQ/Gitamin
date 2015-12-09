<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Presenters;

use Gitamin\Facades\Setting;
use Gitamin\Presenters\Traits\TimestampsTrait;
use GrahamCampbell\Markdown\Facades\Markdown;
use Jenssegers\Date\Date;

class CommentPresenter extends AbstractPresenter
{
    use TimestampsTrait;

    /**
     * Renders the message from Markdown into HTML.
     *
     * @return string
     */
    public function formattedMessage()
    {
        return Markdown::convertToHtml($this->wrappedObject->message);
    }

    /**
     * Present diff for humans date time.
     *
     * @return string
     */
    public function created_at_diff()
    {
        return (new Date($this->wrappedObject->created_at))
            ->setTimezone($this->setting->get('app_timezone'))
            ->diffForHumans();
    }

    /**
     * Present formatted date time.
     *
     * @return string
     */
    public function created_at_formatted()
    {
        return ucfirst((new Date($this->wrappedObject->created_at))
            ->setTimezone($this->setting->get('app_timezone'))
            ->format($this->setting->get('issue_date_format', 'l jS F Y H:i:s')));
    }

    /**
     * Formats the created_at time ready to be used by bootstrap-datetimepicker.
     *
     * @return string
     */
    public function created_at_datetimepicker()
    {
        return $this->wrappedObject->created_at->setTimezone($this->setting->get('app_timezone'))->format('d/m/Y H:i');
    }

    /**
     * Present formatted date time.
     *
     * @return string
     */
    public function created_at_iso()
    {
        return $this->wrappedObject->created_at->setTimezone($this->setting->get('app_timezone'))->toISO8601String();
    }

    /**
     * Returns a formatted timestamp for use within the timeline.
     *
     * @return string
     */
    public function timestamp_formatted()
    {
        return $this->created_at_formatted;
    }

    /**
     * Return the iso timestamp for use within the timeline.
     *
     * @return string
     */
    public function timestamp_iso()
    {
        return $this->created_at_iso;
    }

    /**
     * Convert the presenter instance to an array.
     *
     * @return string[]
     */
    public function toArray()
    {
        return array_merge($this->wrappedObject->toArray(), [
            'created_at'   => $this->created_at(),
            'updated_at'   => $this->updated_at(),
        ]);
    }
}
