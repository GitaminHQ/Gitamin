<?php

/*
 * This file is part of Gitamin.
 * 
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Commands\User;

final class InviteGroupMemberCommand
{
    /**
     * The invte emails.
     *
     * @var string
     */
    public $email;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'emails' => 'required|array|email',
    ];

    /**
     * Create a new invite group member command instance.
     *
     * @param array $email
     *
     * @return void
     */
    public function __construct($emails)
    {
        $this->emails = $emails;
    }
}
