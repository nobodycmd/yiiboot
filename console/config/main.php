<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'controllerMap' => [
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
