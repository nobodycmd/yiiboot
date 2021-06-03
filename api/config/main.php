<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);


return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '7EmI1aODEGmCo7LwyKBilJ3WKe45oMsv',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'text/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'format' => 'json',
            'on afterSend' => function ($event) {
                /* @var $response \yii\web\Response */
                $response = $event->sender;
            },
            'on beforeSend' => function($event) {
                /* @var $response \yii\web\Response */
                $response = $event->sender;

                if($response->data instanceof \yii\web\Response){
                    $response->format = 'html';
                    return $response;
                }
                if(
                    class_exists('\Symfony\Component\HttpFoundation\Response') &&
                    (
                        $response->data instanceof Symfony\Component\HttpFoundation\Response
                    )
                ){
                    $response->format = 'html';
                    return $response;
                }

                $response->format = 'json';
                if(isset($_GET['xml'])){
                    $response->format = 'xml';
                }
                if ($response->statusCode != 200) {
                    $result = $response->data;
                    if ($response->statusCode == 401) {//这个状态是需要登录专用
                        $response->data = [
                            'code' => $response->statusCode,
                            'msg' => '需要登录的code',
                            'data' => null,
                        ];
                    }else {//这个是直接给app等客户端一个业务或消息提示
                        $response->data = [
                            'code' => 200,
                            'msg' => is_string($result) ? $result : json_encode($result),
                            'data' => null,
                        ];
                    }
                    //恢复statuscode正常 返回语意
                    $response->statusCode = 200;
                } else {
                    $result = $response->data;
                    $response->data = [
                        'code' => 0,
                        'msg' => 'ok',
                        'data' => $result,
                    ];

                }
            }
        ],
        'user' => [
            'identityClass' => 'api\models\User',
            'enableAutoLogin' => false,

        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'wechat' => [
            'class' => 'maxwen\easywechat\Wechat',
            // 'userOptions' => []  # user identity class params
            // 'sessionParam' => '' # wechat user info will be stored in session under this key
            // 'returnUrlParam' => '' # returnUrl param stored in session
        ],
    ],

    'modules' => [
        'v1' => [
            'class' => '\api\modules\v1\Module'
        ],
        'v2' => [
            'class' => '\api\modules\v2\Module'
        ],
    ],

    'params' => $params,
];
