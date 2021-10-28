<?php

namespace common\apimodule;

/**
 * api 多版本基类
 * 服务于api主体文件夹和模块里面的api多版本
 * @package common\apimodule
 */
class BaseModule extends \yii\base\Module
{
    public $defaultRoute = 'site';

    public function init()
    {
        parent::init();
        \Yii::$app->set('response', [
            'class' => 'yii\web\Response',
            'format' => 'json',
            'on afterSend' => function ($event) {},
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
                            'message' => '需要登录的code',
                            'data' => null,
                        ];
                    }else {//这个是直接给app等客户端一个业务或消息提示
                        $response->data = [
                            'code' => 200,
                            'message' => is_string($result) ? $result : json_encode($result),
                            'data' => null,
                        ];
                    }
                    //恢复statuscode正常 返回语意
                    $response->statusCode = 200;
                } else {
                    $result = $response->data;
                    $response->data = [
                        'code' => 0,
                        'message' => 'ok',
                        'data' => $result,
                    ];

                }

            }
        ]);
    }

}