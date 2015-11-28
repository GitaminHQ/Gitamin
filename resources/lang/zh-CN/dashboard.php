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

    'dashboard' => '控制台',

    // Projects
    'projects' => [
        'projects'         => '项目',
        'project_statuses' => '项目属性',
        'listed_team'      => '所属团队: :name',

        'all'              => '所有项目',
        'my'               => '我创建的',
        'joined'           => '我参与的',
        'watched'          => '我关注的',

        'add'              => [
            'title'   => '创建项目',
            'message' => '没有项目，马上创建一个吧',
            'success' => '项目已添加。',
            'failure' => '项目添加失败。',
        ],
        'edit' => [
            'title'   => '编辑项目',
            'success' => '项目已更新。',
            'failure' => '项目编辑失败。',
        ],
        'delete' => [
            'success' => '该项目已被删除.',
            'failure' => '项目删除失败，请重试.',
        ],
        'show'  => [
            'title' => '代码浏览',
        ],
        // Project teams
        'teams' => [
            'teams'       => '项目团队|项目团队',
            'no_projects' => '没有项目团队，马上添加一个吧',
            'add'         => [
                'title'   => '创建团队',
                'success' => '团队已添加。',
                'failure' => '团队添加失败。',
            ],
            'edit' => [
                'title'   => '更新团队信息',
                'success' => '团队信息已更新。',
                'failure' => '团队信息更新失败。',
            ],
            'delete' => [
                'success' => '项目团队已被删除。',
                'failure' => '项目团队删除失败，请重试。',
            ],
        ],
        // Project labels
        'labels' => [
            'labels'    => '项目标签|项目标签',
            'no_labels' => '没有项目标签，马上添加一个吧',
            'add'       => [
                'title'   => '创建标签',
                'success' => '标签已添加。',
                'failure' => '标签添加失败。',
            ],
            'edit' => [
                'title'   => '更新标签信息',
                'success' => '标签信息已更新。',
                'failure' => '标签信息更新失败。',
            ],
            'delete' => [
                'success' => '项目标签已被删除。',
                'failure' => '项目标签删除失败，请重试。',
            ],
        ],
    ],

    // Activities
    'activities' => [
        'activities'      => '动态',
        'all'             => '全部动态',
        'project_update'  => '项目更新',
        'topic'           => '项目讨论',
        'watched_project' => '关注的项目',
        'add'             => [
            'title'   => '添加',
            'message' => '没有最新动态',
        ],
    ],

    // Team
    'team' => [
        'team'        => '用户组',
        'member'      => '成员',
        'profile'     => '用户设置',
        'description' => '团队成员维护项目和工单等信息。',
        'add'         => [
            'title'   => '添加团队成员',
            'success' => '团队成员已添加。',
            'failure' => '创建项目失败。',
        ],
        'edit' => [
            'title'   => '更新配置文件',
            'success' => '配置文件已更新。',
            'failure' => '资料更新失败。',
        ],
        'delete' => [
            'success' => '团队成员已删除.',
            'failure' => '删除团队成员失败.',
        ],
        'invite' => [
            'title'   => '邀请团队成员',
            'success' => '团队成员已邀请成功.',
            'failure' => '邀请团队成员失败.',
        ],
    ],

    // Milestones
    'milestones' => [
        'milestones' => '里程碑',
        'add'        => [
            'title'   => '添加',
            'message' => '添加里程碑',
        ],
    ],

    // Issues
    'issues' => [
        'title'  => '工单',
        'all'    => '全部',
        'issues' => '工单',
        'logged' => '{0} 当前没有工单信息|您已经记录了一个工单|您已经报告了 <strong>:count</strong> 个工单',
        'add'    => [
            'title'   => '添加工单',
            'success' => '工单已添加',
            'failure' => '工单添加失败。',
        ],
        'edit' => [
            'title'   => '编辑工单',
            'success' => '工单已更新。',
            'failure' => '工单编辑失败。',
        ],
        'delete' => [
            'success' => '该工单已被删除，它将从首页上消失。',
            'failure' => '工单删除失败，请重试。',
        ],
    ],

    // Schedules
    'schedule' => [
        'schedule'     => '计划',
        'scheduled_at' => '计划在 :timestamp',
        'logged'       => '{0} 当前没有计划|您已经添加了一个计划|您已经添加了 <strong>:count</strong> 个计划',
        'add'          => [
            'title'   => '添加计划',
            'success' => '计划已添加。',
            'failure' => '计划添加失败。',
        ],
        'edit' => [
            'title'   => '编辑计划',
            'success' => '计划已更新！',
            'failure' => '计划更新失败。',
        ],
        'delete' => [
            'success' => '该计划已被删除，它将从首页上消失。',
            'failure' => '无法删除该计划。请再试一次。',
        ],
    ],

    // Merge Requests
    'merge_requests' => [
        'merge_requests' => '合并请求',
        'add'            => [
            'title'   => '添加',
            'message' => '添加合并请求',
        ],
    ],

    //Snippets
    'snippets' => [
        'snippets' => '代码段',
        'add'      => [
            'title'   => '添加',
            'message' => '添加代码片段',
        ],
    ],

    // Subscribers
    'subscribers' => [
        'subscribers'  => '通知',
        'description'  => '当有工单发生，订阅者将收到邮件通知.',
        'verified'     => '已认证',
        'not_verified' => '未认证',
        'add'          => [
            'title'   => '添加邮件订阅',
            'success' => '邮件订阅已添加成功。',
            'failure' => '邮件订阅添加失败。',
        ],
        'edit' => [
            'title'   => '更新订阅者',
            'success' => '订阅者信息已更新.',
            'failure' => '更新订阅者信息失败.',
        ],
    ],

    // Settings
    'settings' => [
        'settings'  => '设置',
        'general'   => [
            'general'     => '常规设置',
            'images-only' => '只能上传图像。',
            'too-big'     => '您上传的文件太大了。上传的图像大小应小于:size',
        ],
        'localization' => [
            'localization' => '系统语言',
        ],
        'timezone' => [
            'timezone'   => '时区设置',
        ],
        'stylesheet' => [
            'stylesheet' => '自定义样式',
        ],
        'theme' => [
            'theme' => '主题设置',
        ],
        'edit' => [
            'success' => '设置已保存。',
            'failure' => '无法保存设置。',
        ],
    ],

    // Login
    'login' => [
        'login'      => '登录',
        'signup'     => '注册账号',
        'logged_in'  => '您已登录',
        'welcome'    => '欢迎回来！',
        'two-factor' => '请输入您的双重验证Token。',
    ],

    // Sidebar footer
    'help'        => '帮助',
    'explore'     => '发现',
    'logout'      => '退出',

    // Notifications
    'notifications' => [
        'notifications' => '通知',
        'awesome'       => '太棒了！',
        'whoops'        => '抱歉，',
    ],

    // Welcome modal
    'welcome' => [
        'welcome' => '欢迎来到Gitamin',
        'message' => '系统即将准备好了！您可能想要配置这些额外的设置',
        'close'   => '您可以直接进入控制台',
        'steps'   => [
            'project'    => '创建项目',
            'issue'      => '添加工单',
            'customize'  => '主题设置',
            'team'       => '添加用户',
            'api'        => '生成 API Token',
            'two-factor' => '双因子身份验证',
        ],
    ],

];
