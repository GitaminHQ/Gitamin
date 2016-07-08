<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Models;

use AltThree\Validator\ValidatingTrait;
use Gitamin\Presenters\IssuePresenter;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;

class Issue extends Model implements HasPresenter
{
    use ValidatingTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id', 'project_id', 'title', 'description', 'iid',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'author_id'    => 'required|int',
        'project_id'   => 'required|int',
        'title'        => 'required|string',
        'description'  => 'string',
    ];

    public static function boot()
    {
        parent::boot();

        self::saving(function ($issue) {
            $issue->set_iid();
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    protected function set_iid()
    {
        $max = $this->where('project_id', $this->project_id)->max('iid');
        $this->iid = $max + 1;
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return IssuePresenter::class;
    }
}
