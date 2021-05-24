<?php

namespace api\modules;


class BaseModule extends \yii\base\Module
{
    public $defaultRoute = 'site';

    public function init()
    {
        parent::init();
//        \Yii::$app->set('response', [
//            'class' => 'yii\web\Response',
//            'format' => 'json',
//            'on afterSend' => function ($event) {},
//            'on beforeSend' => function($event) {
//            /* @var $response \yii\web\Response */
//                $response = $event->sender;
//                if ($response->data !== null) {
//
//                    if ($response->statusCode != 200) {
//                        $result = $response->data;
//                        if ($response->statusCode == 401) {//这个状态是需要登录专用
//                            $response->data = [
//                                'code' => $response->statusCode,
//                                'msg' => '需要登录的code',
//                                'data' => null,
//                            ];
//                        }else {//这个是直接给app等客户端一个业务或消息提示
//                            $response->data = [
//                                'code' => 200,
//                                'msg' => is_string($result) ? $result : json_encode($result),
//                                'data' => null,
//                            ];
//                        }
//                        //恢复statuscode正常 返回语意
//                        $response->statusCode = 200;
//                    } else {
//                        $result = $response->data;
//                        $response->data = [
//                            'code' => 0,
//                            'msg' => 'ok',
//                            'data' => $result,
//                        ];
//
//                    }
//                }
//            }
//        ]);
    }

}