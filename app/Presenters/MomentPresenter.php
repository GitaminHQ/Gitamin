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

use Gitamin\Models\Comment;
use Gitamin\Models\Issue;
use Gitamin\Models\Moment;
use Gitamin\Models\Owner;
use Gitamin\Models\Project;
use Gitamin\Traits\TimestampsTrait;
use GrahamCampbell\Markdown\Facades\Markdown;

class MomentPresenter extends AbstractPresenter
{
    use TimestampsTrait;

    /**
     * Renders the message from Markdown into HTML.
     *
     * @return string
     */
    public function formattedData()
    {
        return Markdown::convertToHtml($this->wrappedObject->data);
    }

    public function formattedTarget()
    {
        if ($this->wrappedObject->target instanceof Comment) {
            return Markdown::convertToHtml($this->wrappedObject->target->message);
        } elseif ($this->wrappedObject->target instanceof Issue) {
            return Markdown::convertToHtml($this->wrappedObject->target->description);
        } elseif ($this->wrappedObject->target instanceof Project) {
            return Markdown::convertToHtml($this->wrappedObject->target->description);
        }
    }

    /** 
     * Get the moment action summary.
     *
     * @return string
     */
    protected function actionName()
    {
        switch ($this->wrappedObject->action) {
            case Moment::CREATED:
                return trans('gitamin.moments.created');
            case Moment::UPDATED:
                return trans('gitamin.moments.updated');
            case Moment::CLOSED:
                return trans('gitamin.moments.closed');
            case Moment::COMMENTED:
                return trans('gitamin.moments.commented');
            default:
                return 'Unknow';
        }
    }

    public function icon()
    {
        if ($this->wrappedObject->momentable instanceof Project) {
            return 'fa fa-cubes';
        } elseif ($this->wrappedObject->momentable instanceof Comment) {
            return 'fa fa-comments-o';
        } elseif ($this->wrappedObject->momentable instanceof Issue) {
            return 'fa fa-exclamation-circle';
        } elseif ($this->wrappedObject->momentable instanceof Owner) {
            return 'fa fa-user';
        } else {
            return 'fa fa-code-fork';
        }
    }

    public function momentableName()
    {
        return str_replace('Gitamin\\Models\\', '', get_class($this->wrappedObject->momentable));
    }

    /**
     * Convert presented moment to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'summary' => $this->summary(),
            'created_at_iso' => $this->created_at_iso(),
        ];
    }
}
