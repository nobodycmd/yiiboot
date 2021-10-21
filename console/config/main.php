<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                '@console/migrations',
                '@yii/log/migrations',//log表1张
                '@yii/rbac/migrations',//迁移角色和路由等4个表
                '@mdm/admin/migrations',//迁移菜单和后台用户2个表
            ],
        ],

        //https://gitee.com/jianglibin/yii2-crontab
        'crontab' => [
            'class' => 'CrontabConsole\controllers\CrontabController',
            'defaultScript' => 'yii',
            'driver' => [
                'class' => 'CrontabConsole\drivers\File',
                'tasks' => [
                    //['crontab_str' => '* * * * *', 'route' => 'example/minute'],
                    //['crontab_str' => '0 */1 * * *', 'route' => 'example/hours'],
                ]
                // 'class' => 'CrontabConsole\drivers\Mysql',
                // 'dsn' => 'mysql:host=localhost;dbname=test',
                // 'username' => 'root',
                // 'password' => 'root',
                // 'charset' => 'utf8',
            ],
        ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
