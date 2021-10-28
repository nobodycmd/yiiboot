<?php
return [
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'bootstrap' => [
        'log',
        'common\\components\\LoadModule',
        'common\\components\\LoadPlugin',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',

    'modules' => [
        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute
            'displaySettings' => [
                'date' => 'Y-m-d',
                'time' => 'H:i:s',
                'datetime' => 'Y-m-d H:i:s',
            ],

            // format settings for saving each date attribute
            'saveSettings' => [
                'date' => 'Y-m-d',
                'time' => 'H:i:s',
                'datetime' => 'Y-m-d H:i:s',
            ],

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,
        ]
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'dateFormat' => 'yyyy-MM-dd',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm',
            'timeFormat' => 'HH:mm',
            'decimalSeparator' => '.',
            'thousandSeparator' => ',',
            'currencyCode' => 'CNY',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=test',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8mb4',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // uncomment if you want to cache RBAC items hierarchy
            // 'cache' => 'cache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    //'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logVars' => ['_SERVER','_GET','_POST'],
                    'prefix' => function ($message) {
                        $user = Yii::$app->has('user', true) ? Yii::$app->get('user') : null;
                        $userID = $user ? $user->getId(false) : '-';
                        if(\Yii::$app->getRequest() instanceof \yii\web\Request)
                            return "[userID:$userID][ip:".Yii::$app->getRequest()->getUserIP()."]";
                        else
                            return "[userID:$userID][ip:console]";
                    }
                ],
            ],
        ],
        'queue' => [
            'class' => 'yii\queue\db\Queue',
            'db' => 'db', // DB 连接组件或它的配置
            'tableName' => '{{%queue}}', // 表名
            'channel' => 'default', // Queue channel key
            'mutex' => 'yii\mutex\MysqlMutex', // Mutex that used to sync queries
            'as log' => 'yii\queue\LogBehavior',// 日志
        ],

        // setup Krajee Pdf component
        //https://demos.krajee.com/mpdf
        'pdf' => [
            'class' => 'kartik\mpdf\Pdf',
            'format' => 'A4',
            'orientation' => 'P',
            'destination' => 'I',
            // refer settings section for all configuration options
        ],


        /** ------ 服务层 ------ **/
        'services' => [
            'class' => 'services\Application',
        ],
        /** ------ redis配置 ------ **/
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 0,
        ],
        /** ------ websocket redis配置 ------ **/
        'websocketRedis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 1,
        ],
        /** ------ 配置信息管理 ------ **/
        'debris' => [
            'class' => 'common\components\Debris',
        ],
        /** ------ 访问设备信息 ------ **/
        'mobileDetect' => [
            'class' => 'Detection\MobileDetect',
        ],
        /** ------ 公用支付 ------ **/
        'pay' => [
            'class' => 'common\components\Pay',
        ],
        /** ------ 上传组件 ------ **/
        'uploadDrive' => [
            'class' => 'common\components\UploadDrive',
        ],
        /** ------ 快递查询 ------ **/
        'logistics' => [
            'class' => 'common\components\Logistics',
        ],

        /** ------ 微信SDK ------ **/
        'wechat' => [
            'class' => 'common\components\Wechat',
            'userOptions' => [],  // 用户身份类参数
            'sessionParam' => 'wechatUser', // 微信用户信息将存储在会话在这个密钥
            'returnUrlParam' => '_wechatReturnUrl', // returnUrl 存储在会话中
            'rebinds' => [
                'cache' => 'common\components\WechatCache',
            ]
        ],

    ],
    'as notify' => \common\behaviors\OrderStatusNotifyBehavior::className(),
    
];
