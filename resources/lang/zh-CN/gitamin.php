<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    // Projects
    'projects' => [
        'status' => [
            1 => '公开',
            2 => '内部',
            3 => '私有',
        ],
    ],

    // Issues
    'issues' => [
        'none' => '无工单记录',
        'past' => '最近工单',
        'previous_week' => '前一周',
        'next_week' => '后一周',
        'none' => '当日无工单',
        'scheduled' => '计划',
        'scheduled_at' => '，计划于 :timestamp',
        'status' => [
            0 => '计划中', // TODO: Hopefully remove this.
            1 => '确认中',
            2 => '修复中',
            3 => '已更新',
            4 => '已解决',
        ],
    ],

    // Service Status
    'service' => [
        'good' => '所有项目状态正常',
        'bad' => '部分项目状态异常',
    ],

    'api' => [
        'regenerate' => '重新生成 API 密钥',
        'revoke' => '注销 API 密钥',
    ],

    // Subscriber
    'subscriber' => [
        'subscribe' => '订阅最新的更新。',
        'button' => '订阅',
        'email' => [
            'subscribe' => '订阅电子邮件更新。',
            'subscribed' => '您已经订阅电子邮件通知，请检查您的电子邮件，确认您的订阅。',
            'verified' => '您的电子邮件订阅已确认。谢谢！',
            'unsubscribe' => '取消电子邮件订阅。',
            'unsubscribed' => '您的电子邮件订阅已被取消。',
            'failure' => '邮件订阅失败。',
            'verify' => [
                'text' => '请确认您的 :app_name 电子邮件订阅。\\n:link\\n此致，:app_name',
                'html-preheader' => '请确认您的 :app_name 状态更新邮件订阅。',
                'html' => '<p>请确认您的 :app_name 电子邮件订阅。</p><p><a href=":link">:link</a></p><p>此致，:app_name</p>',
            ],
            'maintenance' => [
                'text' => '新的维护计划已被安排在 :app_name 上。\\n此致，:app_name',
                'html-preheader' => '新的维护计划已被安排在 :app_name 上。',
                'html' => '<p>新的维护计划已被安排在 :app_name 上。</p><p>此致，:app_name</p>',
            ],
            'issue' => [
                'text' => ':app_name 有新事件报告。\\n此致，:app_name',
                'html-preheader' => ':app_name 有新事件报告。',
                'html' => '<p>:app_name 有新事件报告。</p><p>此致，:app_name</p>',
            ],
        ],
    ],

    'users' => [
        'email' => [
            'invite' => [
                'text' => "您已被邀请加入 :app_name 团队的状态页, 请点击以下链接进行注册。\n:link\n谢谢, :app_name",
                'html-preheader' => '您已被邀请加入 :app_name.',
                'html' => '<p>您已被邀请加入 :app_name 团队的状态页, 请点击以下链接进行注册。</p><p><a href=":link">:link</a></p><p>谢谢, :app_name</p>',
            ],
        ],
    ],

    // Signin fields
    'signin' => [
        'signin' => '登陆',
        'title' => '登陆',
        'email' => '邮箱',
        'password' => '密码',
        '2fauth' => '验证码',
        'invalid' => '邮箱或密码错误',
        'invalid-token' => 'Token无效',
        'cookies' => '您必须启用Cookie功能来登陆。',
        'success' => '登陆成功。',
    ],

    'signup' => [
        'title' => '注册',
        'username' => '用户名',
        'email' => '邮箱',
        'password' => '密码',
        'success' => '您的账号已注册成功。',
        'failure' => '注册失败。',
    ],

    // Other
    'powered_by' => 'Powered by :app,  &copy; 2015-2016 <a href="https://gitamin.com">Gitamin.com</a>.',
    'about_this_site' => '关于我们',
    'rss-feed' => 'RSS 订阅',
    'atom-feed' => 'Atom 订阅',
    'feed' => '项目',

];
