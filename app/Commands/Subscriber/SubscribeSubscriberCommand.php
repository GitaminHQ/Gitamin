<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Commands\Subscriber;

final class SubscribeSubscriberCommand
{
    /**
     * The subscriber email.
     *
     * @var string
     */
    public $email;

    /**
     * The subscriber auto verification.
     *
     * @var bool
     */
    public $verified;

    /**
     * The validation rules.
     *
     * @var array
     */
    public $rules = [
        'email' => 'required|email',
    ];

    /**
     * Create a new subscribe subscriber command instance.
     *
     * @param string $email
     * @param bool   $verified
     */
    public function __construct($email, $verified = false)
    {
        $this->email = $email;
        $this->verified = $verified;
    }
}
