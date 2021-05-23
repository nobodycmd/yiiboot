<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'appVersion' => '2.0.0',
    'appName' => '<b>Yii</b>Boot',
    'homePage' => 'http://git.oschina.net/penngo/chadmin',


    //配置rabc表名称
    'mdm.admin.configs' => [
        //'db' => 'customDb',
        'userTable' => '{{%admin_user}}',
        'menuTable' => '{{%admin_menu}}',
//          'cache' => [
//              'class' => 'yii\caching\DbCache',
//              'db' => ['dsn' => 'sqlite:@runtime/admin-cache.db'],
//          ],
    ],
];
