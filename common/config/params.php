<?php
return [
    'adminEmail' => 'superboss01@163.com',
    'supportEmail' => 'superboss01@163.com',
    'user.passwordResetTokenExpire' => 3600,
    'appVersion' => '2.0.0',
    'appName' => '<b>Yii2</b>Boot',
    'homePage' => 'https://github.com/FanRongZhang/',

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
