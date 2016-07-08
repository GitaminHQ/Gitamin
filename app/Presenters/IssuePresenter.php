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

use McCool\LaravelAutoPresenter\Facades\AutoPresenter;

class IssuePresenter extends AbstractPresenter
{
    public function author_url()
    {
        return AutoPresenter::decorate($this->wrappedObject->author)->url;
    }
}
