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

final class SignupUserCommand
{
    /**
     * The user username.
     *
     * @var string
     */
    public $username;

    /**
     * The user password.
     *
     * @var string
     */
    public $password;

    /**
     * The user email.
     *
     * @var string
     */
    public $email;

    /**
     * The user level.
     *
     * @var int
     */
    public $level;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'username' => 'required|string',
        'password' => 'string',
        'email' => 'required|string|email',
        'level' => 'int',
    ];

    /**
     * Create a new signup user command instance.
     *
     * @param string $username
     * @param string $password
     * @param string $email
     * @param int    $level
     */
    public function __construct($username, $password, $email, $level)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->level = $level;
    }
}
