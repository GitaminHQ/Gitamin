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

    // Install form fields
    'install' => [
        'email'                 => '电子邮箱',
        'username'              => '用户名',
        'password'              => '密码',
        'site_name'             => '系统名称',
        'site_domain'           => '网址',
        'git_client_path'       => 'Git路径',
        'git_repositories_path' => '仓储路径',
        'site_timezone'         => '选择您的时区',
        'site_locale'           => '选择您的语言',
        'enable_google2fa'      => '启用谷歌双因素身份验证',
        'cache_driver'          => '缓存驱动',
        'session_driver'        => '会话驱动',
    ],

    // Login form fields
    'login' => [
        'email'         => '电子邮箱',
        'password'      => '密码',
        '2fauth'        => '双因素验证代码',
        'invalid'       => '无效的电子邮件或密码。',
        'invalid-token' => '无效的令牌。',
        'cookies'       => '您必须启用 cookies 来进行登录。',
    ],

    // Issues form fields
    'issues' => [
        'name'               => '标题',
        'status'             => '状态',
        'project'            => '项目',
        'message'            => '描述',
        'message-help'       => '可以使用Markdown语言。',
        'scheduled_at'       => '预计执行时间',
        'issue_time'         => '发生时间',
        'notify_subscribers' => '通知订阅者',
        'visibility'         => '谁能看到该工单？',
        'public'             => '完全公开',
        'logged_in_only'     => '仅登录用户可见',
    ],

    // Projects form fields
    'projects' => [
        'name'        => '项目名称',
        'status'      => '项目属性',
        'team'        => '所属团队',
        'description' => '项目介绍',
        'slug'        => '项目路径',
        'tags'        => '标签',
        'tags-help'   => '以逗号分隔。',
        'enabled'     => '启用',
    ],

    // Teams form fields
    'teams' => [
        'name' => '团队名称',
        'slug' => '团队路径',
    ],

    // Settings
    'settings' => [
        /// Application setup
        'general' => [
            'site-name'             => '系统名称',
            'site-url'              => '网址',
            'git-client-path'       => 'Git路径',
            'git-repositories-path' => '仓储路径',
            'display-graphs'        => '是否显示图表',
            'about-app'             => '系统介绍',
            'days-of-issues'        => '工单显示天数',
            'banner'                => '横幅图像',
            'banner-help'           => '建议上传文件宽度不大于930像素。',
            'subscribers'           => '允许用户订阅邮件通知吗?',
        ],
        'localization' => [
            'site-locale'       => '系统语言',
            'select-language'   => '请选择系统显示语言',
        ],
        'timezone' => [
            'site-timezone'     => '系统时区',
            'date-format'       => '日期格式',
            'issue-date-format' => '时间显示格式',
        ],
        'stylesheet' => [
            'custom-css' => '自定义样式表',
        ],
        'theme' => [
            'background-color'        => '页面背景色',
            'background-fills'        => '区块填充色(组件, 工单, 页尾)',
            'banner-background-color' => '横幅背景色',
            'banner-padding'          => '横幅Padding值',
            'fullwidth-banner'        => '横幅全宽？',
            'text-color'              => '文字颜色',
            'dashboard-login'         => '在页尾显示 管理后台 的入口？',
            'reds'                    => '红 (用于错误类提示)',
            'blues'                   => '蓝 (用于信息类提示)',
            'greens'                  => '绿 (用于成功类提示)',
            'yellows'                 => '黄 (用于警告类提示)',
            'oranges'                 => '橙 (用于通知类提示)',
            'links'                   => '链接',
        ],
    ],

    'user' => [
        'username'       => '用户名',
        'email'          => '电子邮箱',
        'password'       => '密码',
        'api-token'      => 'API Token',
        'api-token-help' => '重新生成您的 API Token将阻止现有的应用程序访问Gitamin。',
        'gravatar'       => '修改您的 Gravatar 头像。',
        'user_level'     => '用户等级',
        'levels'         => [
            'admin' => '管理员',
            'user'  => '普通用户',
        ],
        '2fa'            => [
            'help' => '启用双因素身份验证会增加您的帐户安全。您将需要下载 <a href="https://support.google.com/accounts/answer/1066447?hl=en">Google Authenticator</a> 或类似的应用到您的移动设备。当您登录时将会要求您提供由应用程序生成的一个短码。',
        ],
        'group' => [
            'description' => '请输入您要邀请的团队成员的邮件地址：',
            'email'       => 'Email #:id',
        ],
    ],

    // Buttons
    'add'    => '添加',
    'save'   => '保存​​',
    'update' => '更新',
    'create' => '创建',
    'edit'   => '编辑',
    'delete' => '删除',
    'submit' => '提交',
    'cancel' => '取消',
    'remove' => '移除',
    'invite' => '邀请',
    'signup' => '注册',

    // Other
    'optional' => '* 可选',
];
