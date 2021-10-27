<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

$config = [
    'id' => 'backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
//    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
             'controllerMap' => [
                  'assignment' => [
                      'class' => 'mdm\admin\controllers\AssignmentController',
                      'userClassName' => 'backend\models\AdminUser',
                      'idField' => 'id'
                 ]
              ],
        ],
        'gridview' => [
            'class' => 'kartik\grid\Module',
        ],
    ],
    'defaultRoute'=>'index',
    'components' => [
        'user' => [
            'identityClass' => 'backend\models\AdminUser',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => ['site/login'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
            'maxSourceLines'=>'20'
        ],
        'urlManager' => [
            //用于表明urlManager是否启用URL美化功能，在Yii1.1中称为path格式URL，
            // Yii2.0中改称美化。
            // 默认不启用。但实际使用中，特别是产品环境，一般都会启用。
            "enablePrettyUrl" => true,
            // 是否启用严格解析，如启用严格解析，要求当前请求应至少匹配1个路由规则，
            // 否则认为是无效路由。
            // 这个选项仅在 enablePrettyUrl 启用后才有效。
            "enableStrictParsing" => false,
            // 是否在URL中显示入口脚本。是对美化功能的进一步补充。
            "showScriptName" => false,
            // 指定续接在URL后面的一个后缀，如 .html 之类的。仅在 enablePrettyUrl 启用时有效。
            "suffix" => "",
            "rules" => [
                "<controller:\w+>/<id:\d+>"=>"<controller>/view",
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>"
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            //TODO !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    /*
                     *  "skin-blue",
"skin-black",
"skin-red",
"skin-yellow",
"skin-purple",
"skin-green",
"skin-blue-light",
"skin-black-light",
"skin-red-light",
"skin-yellow-light",
"skin-purple-light",
"skin-green-light"
                     */
                    'skin' => 'skin-blue',
                ],
            ],
        ],
//        'authManager' => [
//            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
//        ]
    ],
    'as adminLog' => 'backend\\behaviors\\AdminLogBehavior',
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
            'some-controller/some-action',
            '*',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
    'params' => $params,
    'controllerMap' => [
        'ckeditor' => [
            'class'    => 'maxwen\ckeditor\controllers\EditorController',
            'viewPath' => '@vendor/maxwen/yii2-ckeditor-widget/views/editor'
        ]
    ]
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];


    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [ // here
            'crud' => [
                'class' => 'warrence\kartikgii\crud\Generator',
                'templates' => [ // setting for our templates
                    'myself' => '@backend/gii-templates/myself/crud/default',
                ]
            ],
//            'crud' => [
//                'class' => 'warrence\kartikgii\crud\Generator',
//                'templates' => [ // setting for our templates
//                    'kartikgii' => '@backend/gii-templates/yii2-kartikgii/crud/default',
//                ]
//            ],
//            'crud' => [ // generator name
//                'class' => 'yii\gii\generators\crud\Generator', // generator class
//                'templates' => [ // setting for our templates
//                    'customize' => '@backend/gii-templates/adminlte2',
//                ]
//            ],
        ]
    ];
}

return $config;
