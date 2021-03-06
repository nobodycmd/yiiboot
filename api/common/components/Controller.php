<?php

namespace api\common\components;

use yii\filters\auth\HttpHeaderAuth;
use yii\filters\Cors;

class Controller extends \yii\rest\Controller
{

    public function behaviors()
    {
        $behaviors = [];
        $behaviors['cors'] = [
            'class' => Cors::className(),
        ];
        $behaviors = array_merge($behaviors, parent::behaviors());
        unset($behaviors['contentNegotiator']);
        $behaviors['authenticator']['authMethods'] = [
            [
                'class' => Auth::className(),
            ]
        ];
        $behaviors['authenticator']['optional'] = $this->authOptional();

        return $behaviors;
    }

    public $aryParam = [];

    public $user_access_token;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        $this->aryParam = array_merge(\Yii::$app->getRequest()->get(),\Yii::$app->getRequest()->post());

        if(isset($this->aryParam['token'])){
            $this->user_access_token = $this->aryParam['token'];
        }
    }

    public function getParam($name = null){
        if($name && isset($this->aryParam[$name])){
            return $this->aryParam[$name];
        }
        return false;
    }

    protected function authOptional()
    {
        return [];
    }



    public function returnNeedLogin(){
        $this->response->setStatusCode(401);
        return 'need to login';
    }



    public function returnTipMsg($msg=''){
        //随便一个code，不等于401就行
        $this->response->setStatusCode(500);
        return $msg;
    }



    public function isWeChatBrowser()
    {
        if(isset($_SERVER['HTTP_USER_AGENT'])) {
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            return strpos($user_agent, 'MicroMessenger') !== false;
        }
        return false;
    }


}