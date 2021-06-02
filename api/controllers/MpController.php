<?php
namespace api\controllers;


/**
 * https://easywechat.com/docs/3.x/overview
 * maxwen\easywechat 依赖 3.x 版本
 * @package api\controllers
 */
class MpController extends BaseController
{
    public function authOptional()
    {
        return ['*'];
    }

    public function actionServer(){
        /* @var $wechat \maxwen\easywechat\Wechat */
        $wechat = \Yii::$app->wechat;
        /* @var $server \EasyWeChat\Server\Guard */
        $server = $wechat->server;

        $server->setMessageHandler(function ($message) {
            // $message->FromUserName // 用户的 openid
            // $message->MsgType // 消息类型：event, text....
            return "您好！欢迎关注我!";
        });

        return $server->serve()->send();
    }

    public function actionLogin()
    {
        /* @var $wechat \maxwen\easywechat\Wechat */
        $wechat = \Yii::$app->wechat;

        if (!$wechat->isAuthorized())
            return $wechat->authorizeRequired();
        $openid = $wechat->getUser()->getOpenId();
        return $this->redirect('http://baidu.com?openid=' . $openid);
    }

}
