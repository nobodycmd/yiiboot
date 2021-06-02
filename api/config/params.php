<?php
return [
    'adminEmail' => 'admin@example.com',

    //https://easywechat.com/docs/3.x/configuration
    'WECHAT' => [ // wechat options here
        /**
         * Debug 模式，bool 值：true/false
         *
         * 当值为 false 时，所有的日志都不会记录
         */
        'debug'  => true,

        'app_id'  => 'wx432364eadc1afff9',         // AppID
        'secret'  => '5497e1c493ef9d3cadc7aa08d3852f8f',     // AppSecret
        'token'   => 'abcd',          // Token
        'aes_key' => 'EGXn9DW81g3LR2BG4Ehc7BkxyrLxC0SgzDwHanELKDx',                    // EncodingAESKey，安全模式与兼容模式下请一定要填写！！！
        /**
         * 日志配置
         *
         * level: 日志级别, 可选为：
         *         debug/info/notice/warning/error/critical/alert/emergency
         * permission：日志文件权限(可选)，默认为null（若为null值,monolog会取0644）
         * file：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log' => [
            'level'      => 'debug',
            'permission' => 0777,
            'file'       => \Yii::getAlias( '@api/runtime/logs/easywechat.log'),
        ],
    ],
];
