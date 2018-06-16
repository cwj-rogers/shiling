<?php
return [
    //测试配置
    'WECHAT' => [
        'app_id' => 'wx91cdd81c0e09d59b',
        'secret' => '1012d434044fa51321e3c02afe85a619',
        'token' => 'hjzhome888',
        'response_type' => 'array',
        'log' => [
            'level' => 'debug',
            'file' => __DIR__.'/easywechat.log',
        ],
        /**
         * OAuth 配置
         *
         * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
         * callback：OAuth授权完成后的回调页地址
         */
        'oauth' => [
            'scopes'   => ['snsapi_userinfo'],
            'callback' => '/index',
        ],
    ]
];
